<?php
namespace app\helpers\validators;

use app\components\FlashMessage;

class ValidatorLink
{
    public static $linkStructure = [
        'id',
        'token',
        'tstamp',
    ];

    public static $validatorsOrder = [
        'recordExists',
        'hashVerification',
        'max',
    ];

    public const ERRORS = [
        'recordExists' => 'Your account activation link is not valid.',
        'hashVerification' => 'Your account activation link is not valid.',
        'max' => 'Account activation timed out. Sign Up.',
    ];

    public static function validate(array $values)
    {
        $parameters = self::init(array_combine(self::$linkStructure, $values));
        $validators = self::loadValidators(self::$validatorsOrder, $parameters);

        self::setErrors(array_combine(self::$validatorsOrder, $validators));

        foreach ($values as $index => $value) {
            if ($validators[$index]->validate($value))
                continue;
            FlashMessage::error($validators[$index]->getError());
            return false;
        }
        return true;
    }

    private static function loadValidators(array $validators, array $parameters = null): array
    {
        $validators = array_map(function ($validator) use ($parameters) {
            return Validator::load($validator, $parameters[$validator] ?? []);
        }, $validators);

        return $validators;
    }

    public static function  init(array $values)
    {
        return [
            'recordExists' => [
                'Users',
                'id'
            ],
            'hashVerification' => [
                'Users',
                'auth_token',
                [
                    'id' => $values['id']
                ]
            ],
            'max' => [
                $_SERVER["REQUEST_TIME"]
            ]
        ];
    }

    public static function setErrors($validators)
    {
        foreach ($validators as $validator => $obj) {
            $obj->setError(self::ERRORS[$validator]);
        }
    }
}