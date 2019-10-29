<?php
namespace app\helpers\validators;

/**
 * Class ValidatorNoRecordExists
 * @package app\helpers\validators
 */
class ValidatorNoRecordExists extends ValidatorDBData
{
    /** @var ValidatorRecordExists $validatorRecordExists */
	private $validatorRecordExists;

    /**
     * ValidatorNoRecordExists constructor.
     * @param string $table
     * @param string $column
     * @throws \ReflectionException
     */
	public function __construct(string $table, string $column)
    {
	    parent::__construct($table);

		$this->validatorRecordExists = new ValidatorRecordExists($table, $column);
	}

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
	public function validate($value): bool
    {
		if ($this->validatorRecordExists->validate($value)) {
			//$this->initError();
            $this->setChainError();

			return false;
		}

		return parent::validate($value);
	}
 }