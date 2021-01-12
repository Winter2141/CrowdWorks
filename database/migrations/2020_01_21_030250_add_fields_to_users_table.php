<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_kanji', 50)->comment('氏名漢字');
            $table->tinyInteger('publish_name_kanji')->default(0)->comment('氏名漢字公開有無 0：非公開, 1：公開');
            $table->string('name_kana', 50)->comment('氏名カナ');
            $table->tinyInteger('publish_name_kana')->default(0)->comment('氏名カナ公開有無 0：非公開, 1：公開');
            $table->string('company', 100)->comment('会社名・屋号等');
            $table->tinyInteger('publish_company')->default(0)->comment('会社名・屋号等公開有無 0：非公開, 1：公開');
            $table->string('post_first', 5)->comment('郵便番号（前）');
            $table->string('post_second', 6)->comment('郵便番号（後）');
            $table->tinyInteger('publish_post')->default(0)->comment('郵便番号公開有無 0：非公開, 1：公開');
            $table->string('address', 100)->comment('住所');
            $table->tinyInteger('publish_address')->default(0)->comment('住所公開有無 0：非公開, 1：公開');
            $table->string('tel', 12)->comment('電話番号');
            $table->tinyInteger('publish_tel')->default(0)->comment('電話番号公開有無 0：非公開, 1：公開');
            $table->string('fax', 12)->comment('FAX番号');
            $table->tinyInteger('publish_fax')->default(0)->comment('FAX番号公開有無 0：非公開, 1：公開');
            $table->integer('station')->comment('最寄り駅');
            $table->tinyInteger('publish_station')->default(0)->comment('最寄り駅公開有無 0：非公開, 1：公開');
            $table->string('picture', 128)->comment('顔写真');
            $table->tinyInteger('publish_picture')->default(0)->comment('顔写真公開有無 0：非公開, 1：公開');
            $table->dateTime('birthday')->comment('生年月日');
            $table->tinyInteger('publish_birthday')->default(0)->comment('生年月日公開有無 0：非公開, 1：公開');
            $table->string('site', 256)->comment('サイトURL');
            $table->tinyInteger('publish_site')->default(0)->comment('サイトURL公開有無 0：非公開, 1：公開');
            $table->text('profile')->comment('プロフィール');
            $table->text('note')->comment('備考');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
