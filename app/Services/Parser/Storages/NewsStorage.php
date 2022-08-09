<?php

namespace App\Services\Parser\Storages;
use App\Models\News;
use App\Services\Parser\Storages\Storage;
use App\Services\Parser\DataTransfer\NewsDto;
use App\Services\Parser\DataTransfer\NewsRssDto;

class NewsStorage extends Storage
{
    protected static function saveDto($dto)
    {
        switch (true) {
            case $dto instanceof NewsRssDto:
                return static::saveRssNews($dto);
                break;
            case $dto instanceof NewsDto:
                return static::saveNews($dto);
                break;
        }
    }
    /**
     * Сохранение новости
     *
     * @return NewsDto
     * @throws Exception
     */
    private static function saveNews(NewsDto $dto) : NewsDto
    {
        $news = News::updateOrCreate(
            [
                'remote_id' => (string)$dto->remote_id
            ],
            [
                'remote_time' => $dto->remote_time,
                'remote_time_t' => $dto->remote_time_t,
                'link' => $dto->link,
                'title' => $dto->title,
                'date_text' => $dto->date_text,
                'modif_date' => $dto->modif_date,
                'text' => $dto->text
            ]
        );
        $dto->id = $news->id;
        return $dto;
    }

    /**
     * Сохранение новости из Rss
     *
     * @return NewsRssDto
     * @throws Exception
     */
    private static function saveRssNews(NewsRssDto $dto) : NewsRssDto
    {
        $news = News::updateOrCreate(
            [
                "news_id" => $dto->news_id
            ],
            [
                "title" => $dto->title,
                "link" => $dto->link,
                "pub_date" => $dto->pub_date,
                "description" => $dto->description,
                "category" => $dto->category,
                "author" => $dto->author,
                "guid" => $dto->guid,
                "pda_link" => $dto->pda_link,
                "full_text" => $dto->full_text,
                "anons" => $dto->anons,
                "type" => $dto->type,
                "newsline" => $dto->newsline,
                "news_date_timestamp" => $dto->news_date_timestamp,
                "news_modif_date" => $dto->news_modif_date,
                // "enclosure" => $dto->enclosure,
                // "image" => $dto->image,
                "rbc_date" => $dto->rbc_date,
                "rbc_time" => $dto->rbc_time,
            ]
        );

        if (count($dto->image)) {
            foreach ($dto->image as $imageDto) {
                $imageDto->setModel($news);
            }
            LinkStorage::saveAll($dto->image);
        }

        $dto->id = $news->id;
        return $dto;
    }
}
