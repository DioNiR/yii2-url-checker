<?php

namespace backend\controllers;

use frontend\models\Url;
use Yii;

/**
 * Class UrlController
 */
class UrlController extends \yii\web\Controller
{
    /**
     * @param $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id): string
    {
        $searchModel = new \backend\models\search\UrlChecksSearch(['urlId' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id): \yii\web\Response
    {
        $url = $this->findModel($id);
        $url->delete();
        return $this->goBack();
    }

    /**
     * @throws \yii\web\NotFoundHttpException
     */
    private function findModel($id): Url
    {
        $url = Url::findOne($id);
        if (empty($url)) {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }

        return $url;
    }
}