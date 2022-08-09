<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "link",
        "pub_date",
        "description",
        "category",
        "author",
        "guid",
        "pda_link",
        "full_text",
        "anons",
        "news_id",
        "type",
        "newsline",
        "newsdate_timestamp",
        "news_modif_date",
        "enclosure",
        "image",
        "rbk_date",
        "rbk_time",
    ];

    /**
     * Ccылки в новости на фотографии видео и др материалы
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function links(): MorphMany
    {
        return $this->morphMany(Links::class, 'model_type');
    }
}
