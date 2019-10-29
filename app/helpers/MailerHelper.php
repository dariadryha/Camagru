<?php
namespace app\helpers;

class MailerHelper
{
    public static function generateLink()
    {
        return "http://{$_SERVER['HTTP_HOST']}/signup/verify/" . 'token=' . $this->user->getToken() . '/' . 'user=' . $this->user->getId();
    }
}