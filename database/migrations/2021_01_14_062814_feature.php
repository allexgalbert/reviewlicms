<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Feature extends Migration {

  private $table = 'features';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('name')->nullable()->comment('название');
      $table->boolean('footer')->default(0)->comment('футер');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "особенности" ');
  }

  public function down() {
    Schema::dropIfExists($this->table);
  }
}
