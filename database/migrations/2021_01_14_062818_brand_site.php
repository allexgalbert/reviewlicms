<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BrandSite extends Migration {

  private $table = 'brand_site';

  public function up() {

    Schema::create($this->table, function (Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';

      $table->primary(['brand_id', 'site_id']);

      $table
        ->foreignId('brand_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table
        ->foreignId('site_id')
        ->constrained()
        ->onDelete('cascade')
        ->onUpdate('cascade');


      $table->timestamps();
    });

    DB::statement('ALTER TABLE `' . $this->table . '` comment "бренды-сайты" ');
  }

  public function down() {
    Schema::dropIfExists($this->table);
  }
}
