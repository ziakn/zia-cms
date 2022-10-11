<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id');
            $table->integer('user_id');
            $table->integer('aproved')->default(0);

            $table->string('residential_commercial');
            $table->string('rent_sale');
            
            $table->string('title');
            $table->text('description');

            $table->integer('cover_id');
            $table->integer('category_id');
            $table->integer('size');
            $table->string('room')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('toilet')->nullable();
            $table->integer('parking_space')->nullable();
            $table->string('furnish_type')->nullable();
            $table->string('developer')->nullable();
            $table->string('tenure')->nullable();
            $table->integer('year')->nullable();
            $table->integer('plot_size')->nullable();
            $table->integer('plot_number')->nullable();
            $table->string('buildup_area')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('floor_number')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('property_status')->nullable();
            $table->string('renovation')->nullable();

            $table->integer('price');
            $table->string('price_rent_type')->nullable();
            $table->string('from_owner_commission')->nullable();
            $table->string('from_tenant_commission')->nullable();
            $table->string('total_commission')->nullable();
            $table->integer('service_charges')->nullable();
            $table->integer('cheque')->nullable();
            $table->string('financial_status')->nullable();

            $table->string('availability')->nullable();
            $table->date('availability_date')->nullable();

            $table->string('video')->nullable();
            $table->string('three_sixty')->nullable();

            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_no')->nullable();
            $table->string('unit_no')->nullable();
            
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('contact_click')->default(0);
            $table->string('email_click')->default(0);
            $table->string('visits')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->default(1);

            $table->softDeletes();
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
        Schema::dropIfExists('property');
    }
}
