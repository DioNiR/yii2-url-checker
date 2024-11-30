<?php

/** @var \frontend\models\Url $model */


use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'url',
        'test_frequency_minutes',
        'test_error_repeats',
        'delay_minutes',
        'created_at',
    ],
]); ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'status_code',
            'label' => 'status code',
            'format' => 'html',
            'value' => function (\frontend\models\UrlCheck $model) {
                return $model->status_code ?? "";
            }
        ],
        [
            'attribute' => 'created_at',
            'label' => 'created at',
            'format' => 'html',
            'value' => function (\frontend\models\UrlCheck $model) {
                return Yii::$app->formatter->asDatetime($model->created_at);
            }
        ]
    ]
]); ?>


