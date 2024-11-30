<?php

namespace common\jobs;

use common\exceptions\CheckUrlException;
use frontend\models\UrlCheck;
use Yii;
use yii\base\BaseObject;
use yii\helpers\Json;

class CheckUrlJob extends BaseObject implements \yii\queue\JobInterface
{
    public int $urlId;

    public string $url;

    public int $delay;
    public int $attempts = 0;
    public int $tryDelay;
    public int $maxTries;

    public bool $debug = false;

    /**
     * @param $queue
     * @return void
     * @throws \yii\db\Exception
     */
    public function execute($queue)
    {
        $this->debug('Start job');
        try {
            $this->debug('Request sent');
            $client = \Yii::$app->client;
            // Отправляем GET-запрос
            $response = $client->get($this->url)->send();

            $this->debug('Response received');
            $urlCheck = new UrlCheck();
            $urlCheck->url_id = $this->urlId;
            $urlCheck->status_code = $response->getStatusCode();
            $urlCheck->response = Json::encode(['headers' => $response->getHeaders(), 'body' => $response->getContent()]);
            $urlCheck->try_number = $this->attempts;
            $urlCheck->save();

            $this->debug('UrlCheck saved');

            // Если ответ получен успешно, добавляем задачу в очередь
            if ($response->getStatusCode() === 200) {
                // Если ответ получен успешно, добавляем задачу в очередь для новых проверок
                $this->attempts = 0;
                Yii::$app->queue->delay($this->delay)->push(new self($this->getJobData()));
                return;
            } else {
                throw new CheckUrlException('Response status code is not 200');
            }
        } catch (CheckUrlException $e) {
            $this->debug('CheckUrlException');
            $this->attempts++;
            \Yii::error("Ошибка в CheckUrlJob: " . $e->getMessage() . " (Попытка: {$this->attempts})");
        } catch (\Exception $e) {
            $this->debug('Exception');
            $this->attempts++;
            // Логируем ошибку и количество попыток
            \Yii::error($e->getMessage() . $e->getTraceAsString());
        } finally {
            $this->debug('End job');
            try {
                if ($this->attempts > 0) {
                    // Если количество попыток не превышено, добавляем задачу в очередь
                    if ($this->attempts <= $this->maxTries) {
                        $this->debug('Try again');
                        Yii::$app->queue->delay($this->tryDelay)->push(new self($this->getJobData()));
                    } else {
                        $this->debug('Max tries, add to queue');
                        $this->attempts = 0;
                        // Если количество попыток превышено, добавляем задачу в очередь для новых проверок
                        Yii::$app->queue->delay($this->delay)->push(new self($this->getJobData()));
                    }
                }
            } catch (\Exception $e) {
                \Yii::error($e->getMessage() . $e->getTraceAsString());
            }
        }
    }

    private function debug($data)
    {
        if ($this->debug) {
            var_dump($data);
        }
    }

    /**
     * @return array
     */
    protected function getJobData(): array
    {
        return [
            'urlId'      => $this->urlId,
            'url'        => $this->url,
            'delay'      => $this->delay,
            'attempts'   => $this->attempts,
            'tryDelay'   => $this->tryDelay,
            'maxTries'   => $this->maxTries,
        ];
    }
}