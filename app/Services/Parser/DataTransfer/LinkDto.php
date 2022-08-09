<?php

namespace App\Services\Parser\DataTransfer;

class LinkDto
{
    public $id;
    public $model_type;
    public $model_id;
    public $link;

    /**
     * создание dto из возвращенных данных rss
     *
     * @param mixed $item #модель для которой создаем ссылку
     * @return void
     * @throws Exception
     */
    public function setModel($model)
    {
        $this->model_type = get_class($model);
        $this->model_id = $model->id;
    }
}
