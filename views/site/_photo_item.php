<?php

/* @var $model \app\models\PhotoSearch */

use app\models\Photo;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;

$deleteUrl = Url::to(['site/delete-photo', 'id' => $model->id]);
?>


<div class="card-container">
    <div class="card-image">
        <?= EasyThumbnailImage::thumbnailImg($model->getFullSrc(), Photo::MAX_WIDTH, Photo::MAX_HEIGHT) ?>
    </div>
    <hr>
    <div class="card-author">By: <?= $model->author ?></div>

    <div class="row">
        <div class="col-md-10 card-caption">
            <?= $model->caption ?>
        </div>
        <div class="col-md-2">
            <a class="btn btn-danger btn-sm pull-right"
               data-confirm="Are you sure you want delete this item?"
               data-method="post" href="<?= $deleteUrl ?>">
                Delete
            </a>
        </div>
    </div>
</div>
