<?php
use app\components\FlashMessage;

if (FlashMessage::hasMessage()) {
    $alert = require PATH_VIEWS . 'alert.php';
}
/*  @var mixed $buffer */
return <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h2 class="mb-0 text-center">Sign Up</h2>
                    </div>
                    $alert
                    <div class="card-body">
                        $buffer
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
