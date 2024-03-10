<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalcialDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('finalcial_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc_type')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('status')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('subtotal', 15, 2)->nullable();
            $table->decimal('total_taxes', 15, 2)->nullable();
            $table->decimal('total_discounts', 15, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('security_code')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
