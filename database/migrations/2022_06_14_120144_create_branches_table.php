<?php

use App\Models\Charitablefoundation;
use App\Models\City;
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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->double('amount_delivery')->default(0);

            $table->text('address');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();

            ######## Foreign keys  ########

            $table->foreignIdFor(Charitablefoundation::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('branches');
    }
};
