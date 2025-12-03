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
        Schema::table('industries', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('description');
            $table->string('detail_title')->nullable()->after('subtitle');
            $table->text('detail_description')->nullable()->after('detail_title');
            $table->string('detail_image')->nullable()->after('detail_description');
            $table->longText('content')->nullable()->after('detail_image'); // Full HTML content for detail page
            $table->string('breadcrumb_title')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'detail_title', 'detail_description', 'detail_image', 'content', 'breadcrumb_title']);
        });
    }
};
