public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->integer('qty');
        $table->decimal('price', 10, 2);
        $table->timestamps();
    });
}