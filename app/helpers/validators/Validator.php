<?php
namespace app\helpers\validators;

use app\helpers\ClassHelper;
use app\helpers\handlers\ErrorHandler;
use app\traits\IdentifierTrait;

class Validator implements ValidatorInterface
{
    private const NAMESPACE = '\app\helpers\validators\\';

    private const IDENTIFIER_PATTERN = "/^Validator([A-Z][a-zA-Z]+)$/";
//    /**
//     * Static property for saving an error of concrete chain object
//     * that is especially actual for validators chain,
//     * not for separate using any validator
//     *
//     * @var string $error
//     */
//    private static $error;

//    /**
//     * @var string $error
//     */
//    private $error;

    /**
     * @var ErrorHandler $errorHandler
     */
    private static $errorHandler;

    /**
     * @var string $chainError
     */
    protected static $chainError;

    /**
     * @var ValidatorInterface $next
     */
    private $next;

    /** @var string $identifier */
    private $identifier;

//    /**
//     * Property which sets for the correct error handler
//     *
//     * @var bool $chainMode
//     */
//    private static $chainMode = false;

    use IdentifierTrait { getIdentifier as private; }

    /**
     * ValidatorBase constructor.
     * @throws \ReflectionException
     */
    protected function __construct()
    {
        $this->identifier = $this->getIdentifier();
    }

    /**
     * @param ValidatorInterface $next
     * @return ValidatorInterface
     */
    public function setNext(ValidatorInterface $next): ValidatorInterface
    {
        $this->next = $next;

        return $next;
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate($value): bool
    {
        if ($this->next) {
            return $this->next->validate($value);
        }

        return true;
    }
//
//    /**
//     * @return string
//     */
//    public function getError(): string
//    {
//        //TODO
//        $error = self::$error;
//        $this->setError();
//
//        return $error;
//    }
//
//    /**
//     * @param string|null $error
//     */
//    public function setError(string $error = null): void
//    {
//        self::$error = $error;
//    }


//    /**
//     * @return string
//     */
//    public function getError(): string
//    {
//        //TODO
//        return $this->error;
//    }
//
//    /**
//     * @param string $error
//     */
//    public function setError(string $error): void
//    {
//        $this->error = $error;
//    }

    /**
     * @param ValidatorInterface $head
     * @param ValidatorInterface[] $links
     * @return ValidatorInterface
     */
    public static function createChain(ValidatorInterface $head, array $links): ValidatorInterface
    {
        $temp = $head;

        foreach ($links as $link) {
            $temp = $temp->setNext($link);
        }

        return $head;
    }

    /**
     * @param string $name
     * @param array $parameters
     * @return ValidatorInterface
     */
    public static function load(string $name, array $parameters = []): ValidatorInterface
    {
        $name = self::NAMESPACE . 'Validator' . ucfirst($name);

        return ClassHelper::createInstance($name, $parameters);
    }

//    /**
//     * @param bool $chainMode
//     */
//    public function setChainMode(bool $chainMode): void
//    {
//        self::$chainMode = $chainMode;
//    }

    /**
     * @param string|null $handler
     * @throws \ReflectionException
     */
    public function setChainError(string $handler = null)
    {
        self::$chainError = self::$errorHandler->getErrorMessage($this->identifier);
    }

    public function getChainError()
    {
        return self::$chainError;
    }

    /**
     * @param ErrorHandler $errorHandler
     */
    public function setErrorHandler(ErrorHandler $errorHandler)
    {
        self::$errorHandler = $errorHandler;
    }
}