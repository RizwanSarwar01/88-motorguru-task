<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\MigrationHelper;

return new class extends Migration
{
    use MigrationHelper;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->safeCreateTable('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_country_code', 5)->default('+971');
            $table->string('mobile_number');
            $table->string('alternate_mobile_country_code', 5)->nullable();
            $table->string('alternate_mobile_number')->nullable();
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('set null');
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->safeDropTable('employees');
    }
};
