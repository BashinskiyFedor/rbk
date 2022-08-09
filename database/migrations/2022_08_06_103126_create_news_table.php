<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment('Заголовок новости');
            $table->string("link")->comment('Ссылка на новость');
            $table->dateTime("pub_date")->nullable()->comment('Дата публикации на новостном ресурсе');
            $table->string("description")->nullable()->comment('Описание новости');
            $table->string("category")->nullable()->comment('Категория'); // можно вынести в отдельную таблицу категорий
            $table->string("author")->nullable()->comment('Автор новости');
            $table->string("guid")->nullable()->comment('Идентификатор на новостном ресурсе');
            // $table->string("enclosure");
            $table->string("pda_link")->nullable()->comment('Тот-же link');
            $table->string("full_text", 250)->comment('Полный текст новости (по условиям задачи нужно было ограничить кол-во символов)');
            $table->string("anons")->nullable()->comment('Тот-же description');
            $table->string("news_id")->nullable()->comment('id на новостном ресурсе');
            $table->string("type")->nullable()->comment('Тип новости');
            $table->string("newsline")->nullable()->comment('Новостной раздел');
            $table->string("newsdate_timestamp")->nullable();
            $table->dateTime("news_modif_date")->nullable()->comment('Дата редактирования новости');
            $table->string("rbk_date")->nullable()->comment('Дата');
            $table->string("rbc_time")->nullable()->comment('Время');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
