<?php

namespace App\Services\Parser\DataTransfer\Factory;

abstract class DtoFactory
{
    /**
     * Метод хелпер, вытягивает данные из html
     *
     * @param string $html
     * @param array $tags
     * @return array
     * @throws Exception
     */
    protected static function htmlDecode($html, $tags)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_use_internal_errors(false);
        $xpath = new \DOMXPath($dom);
        $result = [];
        foreach ($tags as $tag) {
            $content = $xpath->query($tag->query, $dom)->item(0);
            $result[$tag->name] = $content ? preg_replace('/[ \n] +/', '' ,preg_replace('/[ \t]+/', ' ',  $content->textContent)) : "";
        }

        return $result;
    }
}
