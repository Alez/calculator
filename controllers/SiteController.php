<?php

namespace app\controllers;

use app\models\Solver;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCalculator($expression, $callback = '')
    {
        try {
            $result = (new Solver())->solve($expression);
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        if ($callback) {
            Yii::$app->response->format = Response::FORMAT_JSONP;
            return [
                'data' => [
                    'result' => $result,
                ],
                'callback' => $callback,
            ];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'result' => $result,
        ];
    }
}
