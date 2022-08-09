<?php

namespace App\Services\Parser\Handlers;
use App\Services\Parser\Handlers\BaseHandler;
use App\Services\Parser\Storages\NewsStorage;
use App\Services\Parser\DataTransfer\Factory\NewsDtoFactory;
use App\Services\Parser\DataTransfer\Factory\NewsRssDtoFactory;
use App\Services\Parser\DataTransfer\NewsDto;
use App\Services\Parser\DataTransfer\NewsRssDto;

class RbkHandler extends BaseHandler
{
    /**
     * @var $url get-запрос к ресурсу todo: можно вынести в конфиги или хранить в бд так как может измениться
     */
    protected $url = "https://www.rbc.ru/v8/ajax/getnewsfeed/region/world/";
    /**
     * @var $rssUrl запрос к rss ресурсу todo: можно вынести в конфиги или хранить в бд так как может измениться
     */
    protected $rssUrl = "https://rssexport.rbc.ru/rbcnews/news/30/full.rss";

    /**
     * Сохранение загруженных данных
     *
     * @return RbkHandler
     * @throws Exception
     */
    public function save() : RbkHandler
    {
        $this->result = NewsStorage::saveAll($this->result);
        return $this;
    }

    /**
     * Создание newsDto
     *
     * @return NewsDto
     * @throws Exception
     */
    protected function createDto($item) : NewsDto
    {
        return NewsDtoFactory::create($item);
    }

    /**
     * Создание newsRssDto
     *
     * @return NewsRssDto
     * @throws Exception
     */
    protected function createRssDto($item) : NewsRssDto
    {
        return NewsRssDtoFactory::create($item);
    }
}
