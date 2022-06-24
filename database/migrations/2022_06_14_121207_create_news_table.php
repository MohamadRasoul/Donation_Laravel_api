<?php

use App\Models\Branch;
use App\Models\DonationPost;
use App\Models\SupportProgram;
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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');

            ######## Foreign keys  ########

            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(DonationPost::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SupportProgram::class)->nullable()->constrained()->cascadeOnDelete();
            
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
        Schema::dropIfExists('news');
    }
};
