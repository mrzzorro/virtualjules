<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoDetailsToVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->string('cta_label')->nullable()->after('country');
            $table->string('cta_url')->nullable()->after('cta_label');
            $table->boolean('is_approved')->default(false)->after('status');
            $table->string('video_type')->default('url')->after('url'); // 'url' or 'upload'
            $table->string('thumbnail_url')->nullable()->after('video_type');
            $table->string('file_path')->nullable()->after('thumbnail_url'); // For manual uploads
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('cta_label');
            $table->dropColumn('cta_url');
            $table->dropColumn('is_approved');
            $table->dropColumn('video_type');
            $table->dropColumn('thumbnail_url');
            $table->dropColumn('file_path');
        });
    }
}