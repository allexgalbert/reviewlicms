<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cache extends Migration {

  private $table = 'cache';

  public function up() {
    Schema::create($this->table, function (Blueprint $table) {
      $table->string('key')->unique();
      $table->mediumText('value');
      $table->integer('expiration');
    });
  }

  public function down() {
    Schema::dropIfExists($this->table);
  }
}
