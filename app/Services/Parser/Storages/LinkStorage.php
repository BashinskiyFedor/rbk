<?php

namespace App\Services\Parser\Storages;
use App\Models\Link;
use App\Services\Parser\DataTransfer\LinkDto;

class LinkStorage extends Storage
{
    /**
     * Сохранение ссылки
     *
     * @return LinkDto
     * @throws Exception
     */
    protected static function saveDto($dto) : LinkDto
    {
        if ($dto instanceof LinkDto) {
            return static::saveLink($dto);
        }
    }

    /**
     * Сохранение ссылки
     *
     * @return LinkDto
     * @throws Exception
     */
    private static function saveLink(LinkDto $dto) : LinkDto
    {
        $link = Link::updateOrCreate(
            [
                'link' => $dto->link,
                'model_id' => $dto->model_id,
                'model_type' => $dto->model_type,
            ],[]
        );
        $dto->id = $link->id;
        return $dto;
    }
}
