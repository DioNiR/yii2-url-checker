<?php

/** @var yii\web\View $this */


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
    <div class="body-content">

        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'url')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Add', ['class' => 'btn btn-primary',]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>