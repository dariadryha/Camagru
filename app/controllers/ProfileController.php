<?php
namespace app\controllers;

use app\core\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndex()
    {
        echo "profile index";
    }
}