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
			$table->foreignId('child_category_id')->nullable()->constrained('child_categories');
			$table->foreignId('brand_id')->constrained('brands');
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('link')->nullable();
			$table->string('code')->nullable()->unique();
			$table->bigInteger('price');
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
			$table->enum('type_of_quality',['copy','highCopy','genuine','original']);
			$table->dateTime('published_at')->nullable();
			$table->boolean('is_published')->default(0);
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
