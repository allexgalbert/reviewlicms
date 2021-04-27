<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sitephoto extends Migration {

  private $table = 'sitephotos';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('file')->nullable()->comment('файл');

      $table
        ->foreignId('site_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "фотки сайтов" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
