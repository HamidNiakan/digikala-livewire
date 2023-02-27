<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
			$table->id();
			$table->string('title')->unique();
			$table->string('slug')->unique();
			$table->foreignId('category_id')->constrained('categories');
			$table->boolean('is_published')->default(0);
			$table->text('description')->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
