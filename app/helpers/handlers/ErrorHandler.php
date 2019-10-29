<?php
namespace app\helpers\handlers;

interface ErrorHandler
{
    /**
     * @param string $validator
     * @return mixed
     */
    public function getErrorMessage(string $validator);
}