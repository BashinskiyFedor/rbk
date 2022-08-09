<?php

namespace App\Services\Parser\Storages;

abstract class Storage
{
    /**
     * Сохранение
     *
     * @return mixed
     * @throws Exception
     */
    public static function save($dto)
    {
        $news = static::saveDto($dto);
        $dto->id = $news->id;
        return $dto;
    }

    /**
     * Сохранить массив
     *
     * @return mixed
     * @throws Exception
     */
    public static function saveAll($items)
    {
        $result = [];
        foreach ($items as $item) {
            array_push($result, static::save($item));
        }

        return $result;
    }

    /**
     * Сохранить dto
     *
     * @return mixed
     * @throws Exception
     */
    abstract protected static function saveDto($dto);
}
