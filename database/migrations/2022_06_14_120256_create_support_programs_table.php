<?php

use App\Models\Branch;
use App\Models\SupportProgramType;
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
        Schema::create('support_programs', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->text('description');
            $table->string('instructor');
            $table->date('begin_date');
            $table->string('url_to_contact');
            $table->boolean('is_available')->default(0);

            ######## Foreign keys  ########

            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SupportProgramType::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('support_programs');
    }
};
