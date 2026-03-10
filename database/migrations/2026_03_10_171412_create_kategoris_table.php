public function up(): void
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->timestamps();
    });
}