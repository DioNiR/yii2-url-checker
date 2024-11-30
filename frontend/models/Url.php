<?php
namespace frontend\models;

use yii\behaviors\TimestampBehavior;

/**
 * Class Url
 * Properties:
 * @property int $id
 * @property string $url
 * @property int $test_frequency_minutes
 * @property int $test_error_repeats
 * @property int $delay_minutes
 * @property int $created_at
 *
 * Relations:
 * @property UrlCheck[] $urlChecks
 */
class Url extends \yii\db\ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%urls}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrlChecks(): \yii\db\ActiveQuery
    {
        return $this->hasMany(UrlCheck::class, ['url_id' => 'id']);
    }
}