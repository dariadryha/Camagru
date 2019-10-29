<?php
namespace app\traits;

use app\helpers\Email;
use app\models\db_models\UserModel;

trait EmailSendingTrait
{
    /**
     * @param array $linkStructure
     * @return string
     */
    public function generateLink(array $linkStructure): string
    {
        return "http://{$_SERVER['HTTP_HOST']}/" . implode('/', $linkStructure);
    }

    /**
     * @param array $form
     * @return bool
     */
    public function sendEmail(array $form): bool
    {
        /**
         * @var string $subject
         * @var string $body
         * @var UserModel $user
         * @var array $additionalParameters
         */
        extract($form);

        extract($additionalParameters);

        $username = $user->getUsername();
        $email = $user->getEmail();

        $body = require PATH_EMAILS_CONTENT . "{$body}.php";

        return (new Email())
            ->setTo($email)
            ->setBody(require PATH_EMAILS_CONTENT . "template.php")
            ->setSubject($subject)
            ->sendEmail();
    }
}