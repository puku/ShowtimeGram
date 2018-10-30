<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Photo */
/* @var $form ActiveForm */

?>

<div class="site-_form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uploadedFile')->fileInput() ?>
    <?= $form->field($model, 'caption') ?>
    <?= $form->field($model, 'author') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
