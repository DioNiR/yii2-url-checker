<?php

namespace models;

/**
 * Class UrlCheck
 * Properties:
 * @property int $id
 * @property int $url_id
 * @property int $status_code
 * @property string $response
 * @property int $try_number
 * @property int $created_at
 *
 * Relations:
 * @property Url $url
 */
class UrlCheck extends \yii\db\ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%url_checks}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrl(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Url::class, ['id' => 'url_id']);
    }
}