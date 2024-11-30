<?php

namespace backend\models\search;

use frontend\models\Url;
use frontend\models\UrlCheck;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UrlChecksSearch extends Model
{
    public $urlId;

    /**
     * @param $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $this->load($params);

        $query = UrlCheck::find();
        $query->andFilterWhere(['=', 'url_id', $this->urlId]);

        // Return dateprovider
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
            ],
        ]);



        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}