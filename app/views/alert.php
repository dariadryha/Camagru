<?php
use app\components\FlashMessage;
/**
 * @var string $type
 * @var string $message
 */
extract(FlashMessage::getMessage());
return <<<HTML
    <div class="text-center rounded-0 alert alert-$type mb-0">
        $message
    </div>
HTML;
