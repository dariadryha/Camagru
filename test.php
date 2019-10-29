<?php

class Auto
{
    public $a;

    public function setProperty(string $name, $value)
    {
        $this->{$name} = $value;
    }

    public function setUnique($value)
    {
        $this->setProperty(static::UNIQUE, $value);
    }

    public function setPrimary($value)
    {
        if (defined('PRIMARY'))
            $this->setProperty(static::PRIMARY, $value);
        else
            echo "mne";
    }
}

class Merc extends Auto
{
    const UNIQUE = 'a';
}

$test = new Merc();
$test->setPrimary(10);
echo $test->a;
var_dump(get_object_vars($test));