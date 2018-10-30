<?php

use kartik\growl\Growl;
use yii\helpers\Html;

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    Growl::widget([
        'type' => $message['type'] ?? 'danger',
        'title' => !empty($message['title']) ? Html::encode($message['title']) : null,
        'icon' => $message['icon'] ?? null,
        'body' => $message['message'] ?? 'Message Not Set!',
        'showSeparator' => false,
        'delay' => 1,
        'pluginOptions' => [
            'delay' => $message['duration'] ?? 4000,
            'placement' => [
                'from' => $message['positionY'] ?? 'top',
                'align' => $message['positionX'] ?? 'center',
            ]
        ]
    ]);
}