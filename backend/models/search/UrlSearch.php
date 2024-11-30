<?php

namespace backend\models\search;

use frontend\models\Url;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class UrlSearch
 */
class UrlSearch extends \yii\base\Model
{
    public $url;

    public function rules()
    {
        return [
            [['url'], 'string'],
        ];
    }

    /**
     * @param $params
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $this->load($params);

        $query = Url::find();
        $query->andFilterWhere(['like', 'url', $this->url]);

        // Return dateprovider

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}