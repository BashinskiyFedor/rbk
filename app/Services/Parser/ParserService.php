<?php

namespace App\Services\Parser;
use App\Services\Parser\Handlers\RbkHandler;

class ParserService
{
    public $site;

    public static function site($site)
    {
        switch ($site) {
            case 'rbk':
                return (new RbkHandler());
                break;
            default:
                // todo
                break;
        }
    }
}
