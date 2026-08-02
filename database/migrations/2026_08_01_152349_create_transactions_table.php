<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void 
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('type', [
                'income',
                'expense',
                'transfer'
            ]);

            // Untuk income & expense
            $table->foreignId('account_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Khusus transfer
            $table->foreignId('from_account_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();

            $table->foreignId('to_account_id')
                ->nullable()
                ->constrained('accounts')
                ->nullOnDelete();

            $table->decimal('amount', 15, 2);

            $table->decimal('admin_fee', 15, 2)
                ->default(0);

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->text('description')
                ->nullable();

            $table->date('transaction_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
