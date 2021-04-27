<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Site extends Migration {

  private $table = 'sites';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('name')->nullable()->comment('название');
      $table->text('desc')->nullable()->comment('описание');
      $table->string('url')->nullable()->comment('урл');
      $table->string('file')->nullable()->comment('файл');

      //seo теги
      $table->string('meta_title')->nullable()->comment('meta_title');
      $table->string('meta_description')->nullable()->comment('meta_description');
      $table->string('meta_keywords')->nullable()->comment('meta_keywords');

      $table
        ->foreignId('category_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "сайты" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
