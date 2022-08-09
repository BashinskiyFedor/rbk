<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Services\Parser\ParserService;
use App\Services\Parser\Storages\NewsStorage;

class RbkParserController extends BaseController
{
    public function index(Request $request, ParserService $parserService)
    {
        $news = $parserService->site("rbk")
                              ->count(15)
                              ->fromRss()
                              ->save()
                              ->getResult();
        return $news;
    }
}
