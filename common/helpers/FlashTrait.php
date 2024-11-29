<?php

namespace common\helpers;

use Yii;

/**
 * FlashTrait
 */
trait FlashTrait
{
    /**
     * @param string $message
     * @return $this
     */
    protected function success(string $message): self
    {
        return $this->flash('success', $message);
    }

    /**
     * @param string $message
     * @return $this
     */
    protected function info(string $message): self
    {
        return $this->flash('info', $message);
    }

    /**
     * @param string $message
     * @return $this
     */
    protected function warning(string $message): self
    {
        return $this->flash('warning', $message);
    }

    /**
     * @param string $message
     * @return $this
     */
    protected function error(string $message): self
    {
        return $this->flash('error', $message);
    }

    /**
     * @param string $type
     * @param string $message
     * @return $this
     */
    protected function flash(string $type, string $message): self
    {
        $data = Yii::$app->session->getFlash($type) ?? [];
        if (is_array($data)) {
            $data[] = $message;
        }
        Yii::$app->session->setFlash($type, $data);
        return $this;
    }
}
