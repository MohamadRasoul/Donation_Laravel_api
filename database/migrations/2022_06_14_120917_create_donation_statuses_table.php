<?php

use App\Models\DonationPost;
use App\Models\StatusType;
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
        Schema::create('donation_statuses', function (Blueprint $table) {
            $table->id();

            ######## Foreign keys  ########

            $table->foreignIdFor(DonationPost::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(StatusType::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('donation_statuses');
    }
};
