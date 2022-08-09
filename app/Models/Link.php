<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        "link",
        "model_id",
        "model_type"
    ];

    /**
     * Модель для которой сформирована ссылка
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model() : MorphTo
    {
        return $this->morphTo();
    }
}
