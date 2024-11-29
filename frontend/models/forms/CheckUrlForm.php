<?php

namespace frontend\models\forms;

class CheckUrlForm extends \yii\base\Model
{
    /** @var string */
    public string $url;

    /** @var int  */
    public int $test_frequency_minutes;

    /** @var int  */
    public int $test_error_repeats;

    /** @var int  */
    public int $delay_minutes;


    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['test_frequency_minutes', 'integer'],
            ['test_error_repeats', 'integer'],
            ['delay_minutes', 'integer'],
        ];
    }

    public function add()
    {

    }
}