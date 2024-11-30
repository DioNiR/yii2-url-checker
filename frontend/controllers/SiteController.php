<?php

namespace frontend\controllers;

use common\helpers\FlashTrait;
use frontend\models\forms\CheckUrlForm;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    use FlashTrait;

    /**
     * {@inheritdoc}
     */
    public function actions(): array
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
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $model = new CheckUrlForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->add();

            return $this->flash('success', 'Url added')->redirect(['site/index']);
        }

        return $this->render('index', ['model' => $model]);
    }
}
