<?php

namespace App\Services\Parser\Handlers\Loader;

/**
 * Class RssLoader
 * @package App\Services\Parser\Handlers\Loader
 *
 */
class RssLoader
{
    /**
     * @var $result результат загрузки
     */
    public $result;

    /**
     * Загружает rss ресурс
     *
     * @param string $url
     * @return array
     * @throws Exception
     */
    public function load($url)
    {
        /** @var string $content загружаем xml в виде строки */
        $content = file_get_contents($url);
        /** @var \SimpleXMLElement $feed приводим к xml формату */
        $feed = simplexml_load_string($content);
        /** @var array $namespaces список всех пространств имен в xml */
        $namespaces = $feed->getNameSpaces(true);

        /** @var array $result массив объектов с которыми проще работать */
        $result = [];
        foreach($feed->channel->item as $item) {
            $value = (object)[];
            foreach ($namespaces as $key => $namespace) {
                $value->{$key} = $item->children($namespace);
            }
            $value = (object)[...(array)json_decode(json_encode($item)), ...(array)json_decode(json_encode(($value)))];

            array_push($result, $value);

        }

        return $result;
    }
}
