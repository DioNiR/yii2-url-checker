<?php

namespace common\jobs;

use CheckUrlException;
use yii\base\BaseObject;

class CheckUrlJob extends BaseObject implements \yii\queue\JobInterface
{
    public int $attempts = 0;

    public string $url;
    public int $testFrequencyMinutes;
    public int $testErrorRepeats;
    public int $delayMinutes;

    /**
     * @param $queue
     */
    public function execute($queue): void
    {
        $client = \Yii::$app->client;
        try {
            // Отправляем GET-запрос
            $response = $client->get($this->url)->send();

            // Если ответ получен успешно, добавляем задачу в очередь
            if ($response->getStatusCode() === 200) {
                // Если ответ получен успешно, добавляем задачу в очередь для новых проверок
                $this->attempts = 0;
                $queue->push(new self(['delay' => $this->testFrequencyMinutes]));
            }

            throw new CheckUrlException('Response status code is not 200');
        } catch (\Exception $e) {
            $this->attempts++;

            // Логируем ошибку и количество попыток
            \Yii::error("Ошибка в CheckUrlJob: " . $e->getMessage() . " (Попытка: {$this->attempts})");

            // Если количество попыток не превышено, добавляем задачу в очередь
            if ($this->attempts < $this->testErrorRepeats) {
                $queue->push(new self(['delay' => $this->delayMinutes * 1000, 'attempts' => $this->attempts])); // Задержка в миллисекундах
            }
            else {
                // Если количество попыток превышено, добавляем задачу в очередь для новых проверок
                $queue->push(new self(['delay' => $this->testFrequencyMinutes]));
            }
        }
    }
}