<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration {

  private $table = 'users';

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
      $table->boolean('disablereviews')->default(0)->comment('запретить оставлять отзывы');
      $table->integer('cautions')->default(0)->comment('предупреждения перед баном');

      $table->integer('unreadmessages_touser')->default(0)->comment('колво непрочитанных сообщений у юзера');
      $table->integer('unreadmessages_toadmin')->default(0)->comment('колво непрочитанных сообщений у админа');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "юзеры" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
