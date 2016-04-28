<?php

namespace app\controllers;

use app\models\Solver;
use Yii;
use yii\web\Controller;
use yii\base\InvalidParamException;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCalculator($expression)
    {
        try {
            $result = (new Solver())->solve($expression);
        } catch (InvalidParamException $e) {
            $result = $e->getMessage();
        }

        Yii::$app->response->format = 'json';

        return [
            'result' => $result,
        ];
    }
}
