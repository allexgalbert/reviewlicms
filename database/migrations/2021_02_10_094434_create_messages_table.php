<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration {

  private $table = 'messages';

  public function up() {
    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->id();

      $table
        ->foreignId('user_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table
        ->foreignId('admin_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->text('message')->nullable()->comment('сообщение');

      $table->boolean('direction')->nullable()->comment('-1-юзеру, 1-админу');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "сообщения" ');
  }

  public function down() {
    Schema::dropIfExists($this->table);
  }
}
