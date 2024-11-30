<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'rowOptions' => function (\frontend\models\Url $model) {
        return [];
    },
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'url',
            'label' => 'url',
            'format' => 'html',
            'value' => function (\frontend\models\Url $model) {
                return $model->url ?? "";
            }
        ],
        [
            'attribute' => 'last_status_code',
            'label' => 'last status code',
            'format' => 'html',
            'value' => function (\frontend\models\Url $model) {
                return $model->lastUrlCheck->status_code ?? "";
            }
        ],
        [
            'attribute' => 'last_checked_at',
            'label' => 'last checked at',
            'format' => 'html',
            'value' => function (\frontend\models\Url $model) {
                return Yii::$app->formatter->asDatetime($model->lastUrlCheck->created_at ?? 0);
            }
        ],
        'created_at:datetime',
        [
            'class' => ActionColumn::class,
            'contentOptions' => [
                'class' => 'text-right nowrap',
            ],
            'buttonOptions' => [
                'class' => 'btn btn-primary ',
            ],
            'template' => '{view} {delete}',
            'buttons' => [
                'view' => function ($url, \frontend\models\Url $model) {
                    return Html::a(
                        'View',
                        Url::to(['url/view', 'id' => $model->id]),
                        [
                            'title' => 'View',
                            'class' => 'btn btn-warning',
                        ]
                    );
                },
                'delete' => function ($url, \frontend\models\Url $model) {
                    return Html::a(
                        'Delete',
                        Url::to(['url/delete', 'id' => $model->id]),
                        [
                            'title' => 'Delete',
                            'class' => 'btn btn-danger',
                            'data-confirm' => 'Are you sure you want to delete this item?', 'data-method' => 'POST'
                        ]
                    );
                },
            ],
        ],
    ],
]) ?>