<?php

namespace backend\controllers;

use backend\models\search\UrlSearch;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $urlSearchModel = new UrlSearch();
        $dataProvider = $urlSearchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'model' => $urlSearchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
