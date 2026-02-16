<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // ex. "Aide post-amputation Rivo - Pied diabétique"
            $table->text('description');  // histoire patient, consentement mentionné
            $table->decimal('goal', 12, 2);  // objectif en MGA
            $table->decimal('current_amount', 12, 2)->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // créateur (admin)
            $table->string('status')->default('pending');  // pending/active/completed
            $table->string('main_image')->nullable();  // photo patient (avec consent)
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
        Schema::dropIfExists('campaigns');
    }
}
