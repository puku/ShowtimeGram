<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class PhotoSearch
 *
 * @package app\models
 */
class PhotoSearch extends Photo
{
    /**
     * @return ActiveDataProvider
     */
    public function search(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => self::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);
    }
}
