<?php

namespace App\Services\Parser\Handlers;
use App\Services\Parser\Handlers\Loader\CurlLoader;
use App\Services\Parser\Handlers\Loader\RssLoader;

/**
 * Class BaseHandler
 * @package App\Services\Parser\Handlers
 *
 */
abstract class BaseHandler
{
    protected $url;
    protected $rssUrl;
    private $count = 15;
    protected $result;

    /**
     * Установка кол-ва элементов которые нужно спарсить
     *
     * @param int $count
     * @param string $referer
     * @return mixed
     * @throws Exception
     */
    public function count($count) {
        $this->count = $count;
        return $this;
    }

    /**
     * Загрузка данных по api ресурса
     *
     * @return mixed
     * @throws Exception
     */
    public function fromApi()
    {
        $loader = new CurlLoader();
        $load = $loader->load($this->url);

        $news_block = json_decode($load->result);

        $result = [];
        foreach ($news_block->items as $index => $item) {
            if ($index == $this->count) {
                break;
            }
            array_push($result, $this->createDto($item));
        }
        $this->result = $result;
        return $this;
    }

    /**
     * Загрузка данных по rss ресурса
     *
     * @return mixed
     * @throws Exception
     */
    public function fromRss()
    {
        $loader = new RssLoader();
        $news_block = $loader->load($this->rssUrl);

        $result = [];
        foreach ($news_block as $index => $item) {
            if ($index == $this->count) {
                break;
            }
            array_push($result, $this->createRssDto($item));
        }

        $this->result = $result;
        return $this;
    }

    /**
     * Получить результаты
     *
     * @return arrray
     * @throws Exception
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Создание dto
     *
     * @return mixed
     * @throws Exception
     */
    protected abstract function createDto($item);

    /**
     * Создание dto
     *
     * @return mixed
     * @throws Exception
     */
    protected abstract function createRssDto($item);

    /**
     * Сохранение полученных данных
     *
     * @return mixed
     * @throws Exception
     */
    public abstract function save();
}
