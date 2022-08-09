<?php

namespace App\Services\Parser\DataTransfer;

class NewsRssDto
{
    public int $id;
    public string $title;
    public string $link;
    public $pub_date;
    public string $description;
    public string $category;
    public string $author;
    public string $guid;
    public string $pda_link;
    public string $full_text;
    public string $anons;
    public string $news_id;
    // public TagDto $tags;
    public string $type;
    public string $newsline;
    public string $news_date_timestamp;
    public $news_modif_date;
    // public $enclosure;
    public $image;
    // public RelatedLinksDto $relatedLinks;
    public $rbc_date;
    public $rbc_time;
}
