<?php
namespace app\helpers\validators;
use app\helpers\ArrayHelper;
use app\helpers\handlers\InputErrorHandler;
use app\models\db_models\UserModel;
use app\models\forms\Form;

/**
 * Class ValidatorForm
 * @package app\helpers\validators
 */
class ValidatorForm
{
    /** @var array $inputPatterns */
    private static $inputPatterns = [
        'username' => [
            'characterSet' => '/^[a-z0-9-_.]+$/',
            'firstCharacter' => '/^[a-z]/',
            'lastCharacter' => '/[a-z0-9]$/'
        ],
        'password' => [
            'characterSet' => '/^[a-z0-9\!@#\$%\^&\*\(\)\-_\+\=\[\]\{\}\|]+$/i',
            'letters' => '/[a-z]+/i',
            'digits' => '/[0-9]+/',
            'nonAlphanumeric' => '/[\!@#\$%\^&\*\(\)\-_\+\=\[\]\{\}\|]+/'
        ]
    ];

    /**
     * @param Form $form
     * @return bool
     */
    public static function validate(Form $form): bool
    {
        foreach ($form->getInputs() as $column => $input) {
            if ($input->getNeedValidate() === false) {
                continue;
            }

            $parameters = self::init($column, $form);

            /** @var Validator[] $validators */
            $validators = self::loadValidators($input->getValidators(), $parameters);

            /** @var Validator $chain */
            $chain = Validator::createChain($validators[0], array_slice($validators, 1));

            $chain->setErrorHandler(new InputErrorHandler($column, $input));

            if ($chain->validate($input->getValue()))
                continue;

            $input
                ->setError($chain->getChainError())
                ->setState(false);

            $form->setState(false);
        }

        return $form->getState();
    }

    /**
     * @param array $validators
     * @param array|null $parameters
     * @return array
     */
    private static function loadValidators(array $validators, array $parameters = null): array
    {
        $validators = array_map(function ($validator) use ($parameters) {
            return Validator::load($validator, $parameters[$validator] ?? []);
        }, $validators);

        return $validators;
    }

    /**
     * @param string $name
     * @param Form $form
     * @return array
     */
    protected static function init(string $name, Form $form)
    {
        return [
            'patternHandlers' => [ArrayHelper::getValue(self::$inputPatterns, $name)],
            'strLength' => ArrayHelper::getValue(Form::INPUT_LENGTH, $name) ? array_values(Form::INPUT_LENGTH[$name]) : null,
            'noRecordExists' => [
                'Users',
                $name
            ],
            'recordExists' => [
                'Users',
                $name
            ],
            'identical' => [$form->getInputValue('password')],
            'dbHashVerification' => [
                'Users',
                'password',
                [
                    'username' => $form->getInputValue('username') ?? ArrayHelper::getValue($_SESSION, 'username')
                ]
            ]
        ];
    }
}
