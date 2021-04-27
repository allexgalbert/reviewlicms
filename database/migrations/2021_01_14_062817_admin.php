<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration {

  private $table = 'admins';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();
      $table->string('name')->nullable()->comment('название');

      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();

      $table->boolean('ban')->default(0)->comment('бан');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "админы" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
