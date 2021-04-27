<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Review extends Migration {

  private $table = 'reviews';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();

      $table
        ->foreignId('site_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table
        ->foreignId('user_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->text('comment')->nullable()->comment('отзыв');
      $table->tinyInteger('rating')->default(0)->comment('рейтинг');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "отзывы" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
