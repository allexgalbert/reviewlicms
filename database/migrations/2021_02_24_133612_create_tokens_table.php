<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration {

  private $table = 'tokens';

  public function up() {
    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('api_token')->unique()->nullable()->comment('токен');
      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "токены для Api" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
