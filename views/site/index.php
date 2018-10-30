<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $model \app\models\Photo */

use yii\bootstrap\Modal;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;

echo Dialog::widget(['overrideYiiConfirm' => true]);

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-8">
            <h1>
                <?= $this->title ?>
            </h1>
        </div>
        <div class="col-md-4">
            <?php
            Modal::begin([
                'header' => '<h2>Post photo</h2>',
                'toggleButton' => [
                    'id' => 'add-photo',
                    'label' => 'Post photo',
                    'class' => 'btn btn-default pull-right',
                ],
            ]);

            echo $this->render('_form', [
                'model' => $model,
            ]);

            Modal::end();
            ?>
        </div>
    </div>

    <div class="body-content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_photo_item',
            'layout' => "{items}\n{pager}",
        ]) ?>
    </div>
</div>
