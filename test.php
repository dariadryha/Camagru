<?php
class foo {
    public $value = 42;

    public function &getValue() {
        return $this->value;
    }
}

class bar {
    public $value = 22;

    public function setValue(&$value) {
        return $this->value = &$value;
    }
}

$obj = new foo;
$bar = new bar;
echo $bar->value;
$bar->setValue($obj->getValue()); // $myValue указывает на $obj->value, равное 42.
//$bar->value = &$obj->getValue(); // $myValue указывает на $obj->value, равное 42.
echo $bar->value;
$obj->value = 2;
echo $bar->value;
//echo $myValue;                // отобразит новое значение $obj->value, то есть 2.

