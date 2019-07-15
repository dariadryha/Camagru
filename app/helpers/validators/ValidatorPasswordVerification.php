<?php
namespace app\helpers\validators;

class ValidatorPasswordVerification extends ValidatorForm {
    private $value;

	public function __construct($table, $where) {
	    parent::__construct($table, $where['column']);
        $this->value = $where['value'];
	}

	public function validate($password)
    {
        $query = $this
                ->db
                ->query()
                ->buildWhere([$this->column])
                ->buildSelect($this->table, ['password'])
                ->getQuery();
        $hash = $this->db->getRecord($query, array($this->value));
        if (password_verify($password, $hash)) {
            return parent::validate($password);
        }
        $this->setError();
        return false;
    }
}