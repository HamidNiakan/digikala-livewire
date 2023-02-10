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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->foreignId('category_id')->constrained('categories');
			$table->foreignId('sub_category_id')->constrained('sub_categories');
			$table->foreignId('child_category_id')->constrained('child_categories');
			$table->string('title');
			$table->string('title_en')->nullable();
			$table->string('slug')->unique();
			$table->string('link')->nullable();
			$table->bigInteger('code')->unique();
			$table->bigInteger('price')->nullable();
			$table->integer('discount')->nullable();
			$table->integer('weight')->nullable();
			$table->integer('stock')->nullable();
			$table->text('description')->nullable();
			$table->text('short_description')->nullable();
			$table->unsignedBigInteger('sell')->default(0);
			$table->unsignedBigInteger('view')->default(0);
			$table->unsignedBigInteger('gift')->default(0);
			$table->unsignedBigInteger('order_count')->default(0);
			$table->boolean('special')->default(false);
			$table->boolean('publish')->default(false);
			$table->enum('status',['active','deActive'])->default('deActive');
			$table->enum('type_of_quality',['copy','highCopy','genuine','original']);
			$table->dateTime('published_at');
			$table->softDeletes();
            $table->timestamps();
			$table->index(['slug','code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
