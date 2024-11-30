<?php

namespace frontend\models\forms;


use common\services\AddUrlToQueueService;
use frontend\models\Url;

/**
 * Class CheckUrlForm
 */
class CheckUrlForm extends Url
{
    /** @var string */
    public string $url = "";

    /** @var int  */
    public int $test_frequency_minutes = 0;

    /** @var int  */
    public int $test_error_repeats = 0;

    /** @var int  */
    public int $delay_minutes = 0;

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'url' => 'Url',
            'test_frequency_minutes' => 'Test frequency minutes',
            'test_error_repeats' => 'Test error repeats',
            'delay_minutes' => 'Delay minutes',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'url',
            'test_frequency_minutes',
            'test_error_repeats',
            'delay_minutes',
        ];
    }


    public function rules(): array
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'unique', 'targetAttribute' => ['url']],
            ['test_frequency_minutes', 'integer'],
            ['test_error_repeats', 'integer'],
            ['delay_minutes', 'integer'],
        ];
    }

    /**
     * @throws \yii\db\Exception
     */
    public function add(): void
    {
        $url = new Url();
        $url->url = $this->url;
        $url->test_frequency_minutes = $this->test_frequency_minutes;
        $url->test_error_repeats = $this->test_error_repeats;
        $url->delay_minutes = $this->delay_minutes;
        $url->save();

        $addUrlToQueueService = new AddUrlToQueueService($url);
        $id = $addUrlToQueueService->execute();
    }

    /**
     * @return string[]
     */
    public function getFrequenciesMinutes(): array
    {
        return [
            '5' => '5 minutes',
            '10' => '10 minutes',
            '15' => '15 minutes',
        ];
    }
}