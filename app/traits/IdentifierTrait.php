<?php
namespace app\traits;

use app\helpers\ClassHelper;

trait IdentifierTrait
{
    public function getIdentifier(): string
    {
        $identifier =  preg_replace(self::IDENTIFIER_PATTERN, "$1", ClassHelper::getShortName($this));

        return lcfirst($identifier);
    }
}