<?php

namespace App\Services\Parser\DataTransfer\Factory;
use App\Services\Parser\DataTransfer\Factory\DtoFactory;
use App\Services\Parser\DataTransfer\NewsDto;

class NewsDtoFactory extends DtoFactory
{
    /**
     * создание dto из возвращенных данных api
     *
     * @param object $item
     * @return NewsDto
     * @throws Exception
     */
    public static function create($item) : NewsDto {
        $html = self::htmlDecode($item->html, [
            (object)[
                "name" => "title",
                "query" => '//*[@class="news-feed__item__title"]'
            ],
            (object)[
                "name" => "date_text",
                "query" => '//*[@class="news-feed__item__date-text"]'
            ],
            (object)[
                "name" => "link",
                "query" => '//*[@class="news-feed__item chrome js-yandex-counter"]/@href'
            ]
        ]);

        $dto = new NewsDto();
        $dto->remote_id = $item->id;
        $dto->remote_time = $item->time;
        $dto->remote_time_t = $item->time_t;
        $dto->modif_date = $item->modif_date;
        $dto->title = $html['title'];
        $dto->date_text = $html['date_text'];
        $dto->link = $html['link'];

        return $dto;
    }
}
