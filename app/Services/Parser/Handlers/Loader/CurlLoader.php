<?php

namespace App\Services\Parser\Handlers\Loader;

/**
 * Class CurlLoader
 * @package App\Services\Parser\Handlers\Loader
 *
 */
class CurlLoader
{
    /**
     * @var string $useragent браузер с которого якобы заходим на сайт
     */
    private static $useragent = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0";

    /**
     * @var array $header заголовки для корректного обращения к api ресурса
     */
    private static $header = array(
        'X-NewRelic-ID'=>"VQUFVVRACQEEUlBS",
        'X-Requested-With'=>"XMLHttpRequest"
    );

    /**
     * @var string $result результат загрузки
     */
    public $result;

    /**
     * Загружает веб страницу
     *
     * @param string $url
     * @param string $referer
     * @return CurlLoader
     * @throws Exception
     */
    public function load($url, $referer = "")
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, self::$useragent);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::$header);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $this->result = $result;
        return $this;
    }
}
