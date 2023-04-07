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
        Schema::table('user_subscription', function (Blueprint $table) {
            $table->unique(['user_subscriber_id', 'user_subscribed_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscription', function (Blueprint $table) {
            $table->dropUnique('user_subscriber_id_user_subscribed_id_unique');
        });
    }
};
