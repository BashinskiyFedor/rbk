<?php

namespace App\Services\Parser\DataTransfer\Factory;
use App\Services\Parser\DataTransfer\Factory\DtoFactory;
use App\Services\Parser\DataTransfer\LinkDto;

class LinkDtoFactory extends DtoFactory
{

    /**
     * создание dto ccылок
     *
     * @param object $item
     * @return LinkDto
     * @throws Exception
     */
    public static function create(object $item) : LinkDto {
        $dto = new LinkDto();
        $dto->link = $item->url;
        return $dto;
    }
}
