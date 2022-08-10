<?php

namespace App\Services\Parser\DataTransfer\Factory;
use App\Services\Parser\DataTransfer\Factory\DtoFactory;
use App\Services\Parser\DataTransfer\NewsRssDto;
use Carbon\Carbon;
use App\Services\Parser\DataTransfer\Factory\LinkDtoFactory;

class NewsRssDtoFactory extends DtoFactory
{
    /**
     * создание dto из возвращенных данных rss
     *
     * @param $item
     * @return NewsRssDto
     * @throws Exception
     */
    public static function create($item) : NewsRssDto {
        $dto = new NewsRssDto();
        $dto->title = $item->title;
        $dto->link = $item->link;
        $dto->pub_date = Carbon::createFromTimeString($item->pubDate);
        try {
            $dto->description = mb_substr($item->description, 0, 200);
        } catch (\Exception $error) {
            $dto->description = "Нет описания";
        }

        $dto->category = $item->category;
        $dto->author = $item->author ?? "";
        $dto->guid = $item->guid;
        //$dto->enclosure = $item->enclosure ?? "";
        $dto->pda_link = $item->rbc_news->pdalink ?? "";

        $dto->full_text = gettype($item->rbc_news->{"full-text"}) === "object" ? "Не было передано из новостного ресурса" : mb_substr($item->rbc_news->{"full-text"}, 0, 250) ;

        $dto->anons = mb_substr($item->rbc_news->anons, 0, 200) ?? "";
        $dto->news_id = $item->rbc_news->news_id ?? "";
        // public TagDto $tags;
        $dto->type = $item->rbc_news->type ?? "";
        $dto->newsline = $item->rbc_news->newsline ?? "";
        $dto->news_date_timestamp = $item->rbc_news->newsDate_timestamp ?? "";
        $dto->news_modif_date = Carbon::createFromTimeString($item->rbc_news->newsModifDate);
        // public RelatedLinksDto $relatedLinks;
        $dto->rbc_date = $item->rbc_news->date ?? "";
        $dto->rbc_time = $item->rbc_news->time ?? "";

        if (isset($item->rbc_news->image) && is_array($item->rbc_news->image)) {
            $result = [];
            foreach ($item->rbc_news->image as $image) {
                array_push($result, LinkDtoFactory::create($image));
            }
            $dto->image = $result;
        } else {
            $dto->image = [];
        }

        return $dto;
    }
}
