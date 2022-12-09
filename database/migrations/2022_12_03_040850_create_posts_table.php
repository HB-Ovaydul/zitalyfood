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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admin_id')->default();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->text('feature')->nullable();
            $table->longText('gallery')->nullable();
            $table->longText('quote')->nullable();
            $table->longText('head1')->nullable();
            $table->longText('head2')->nullable();
            $table->longText('head3')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->default(true);
            $table->string('trash')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
