<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeatureSite extends Migration {

  private $table = 'feature_site';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->primary(['site_id', 'feature_id']);

      $table
        ->foreignId('site_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table
        ->foreignId('feature_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "сайты-особенности" ');
  }


  public function down() {
    Schema::dropIfExists($this->table);
  }
}
