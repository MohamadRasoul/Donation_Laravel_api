<?php

use App\Models\DonationPost;
use App\Models\User;
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
        Schema::create('sponsor_ships', function (Blueprint $table) {
            $table->id();

            $table->double('amount');
            $table->boolean('take_automatic');
            $table->string('month_day_to_pay');
            $table->integer('month_count_keep_paying');

            ######## Foreign keys  ########

            $table->foreignIdFor(DonationPost::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('sponsor_ships');
    }
};
