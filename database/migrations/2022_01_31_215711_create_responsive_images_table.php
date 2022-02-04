<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsiveImagesTable extends Migration
{
    public function up()
    {
        Schema::create('responsive_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')
                ->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responsive_images');
    }
}
