<?php

use App\Models\Branch;
use App\Models\Charitablefoundation;
use App\Models\City;
use App\Models\PostType;
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
        Schema::create('donation_posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('amount_required');
            $table->double('amount_donated')->default(0);

            ######## Foreign keys  ########

            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PostType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Charitablefoundation::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('donation_posts');
    }
};
