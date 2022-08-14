<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastMessageIdToThreadsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('threads', function (Blueprint $table) {
      $table->foreignId('last_message_id')->nullable()->constrained('messages')->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('threads', function (Blueprint $table) {
      $table->dropForeign('threads_last_message_id_foreign');
      $table->dropColumn('last_message_id');
    });
  }
}
