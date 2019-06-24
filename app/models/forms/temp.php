public function handleEmptyField($field) {
return "{$this->labels[$field]} is a required field.";
}

public function handlePatternError($field, $handler) {
return self::$patternErrors[$field][$handler];
}

public function handleInputLength($field, $min, $max) {
return "{$this->labels[$field]} must be between $min and $max characters.";
}

public function handleEmailError($field) {
return "{$this->labels[$field]} is not valid.";
}

public function handlePasswordsMismatch() {
return "* Passwords don't match.";
}

public function handleErrors() {
foreach ($this->errors as $field => $error) {
$this->errors[$field] = call_user_func_array(array($this, $this->errorHandlers[$error['validator']]), array_merge([$field], $error['parameters']));
}
}

public function handleNotUniqueValue() {
return 'Username already exists.';
}