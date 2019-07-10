<?php
namespace app\helpers\validators;

class ValidatorPasswordVerification extends ValidatorForm {
    private $row;

	public function __construct($table, $where) {
        $this->table = $table;
        $this->column = $where['column'];
        $this->row = $where['row'];
	}

	public function validate($password)
    {
        $query = $this
                ->db
                ->query()
                ->buildWhere([$this->column])
                ->buildSelect($this->table, ['password'])
                ->getQuery();
        $hash = $this->db->getRecord($query, array($this->row));
        if (password_verify($password, $hash)) {
            return parent::validate($password);
        }
        $this->setError();
        return false;
    }
}
