<?php
namespace app\helpers\validators;

/**
 * Interface ValidatorInterface
 * @package app\helpers\validators
 */
interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool;

    /**
     * @param ValidatorInterface $next
     * @return ValidatorInterface
     */
    public function setNext(ValidatorInterface $next): ValidatorInterface;
}