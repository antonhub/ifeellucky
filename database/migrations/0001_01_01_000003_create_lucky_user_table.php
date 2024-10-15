<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lucky_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('phone')->unique();
            $table->string('link_hash')->unique()->index();
            $table->boolean('is_link_active')->default(true);
            $table->timestamp('link_expires_at');
            $table->timestamps();
        });

        Schema::create('lucky_history', function (Blueprint $table) {
            $table->id();
            $table->string('link_hash')->index();
            $table->boolean('is_win')->default(false);
            $table->tinyInteger('won_amount')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lucky_user');
        Schema::dropIfExists('lucky_history');
    }
};
