<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //tabla 1
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        //tabla 2
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 255)->nullable();
            $table->integer('stock')->default(0);
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->onDelete('set null');
            $table->timestamps();
        });

        //tabla 3
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('codigo_postal', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('rol', 50)->default('Cliente');
            $table->timestamps();
        });

        //tabla 4
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('estado', 50)->default('pendiente');
            $table->timestamps();
        });

        //tabla 5
        Schema::create('carrito_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrito_id')->constrained('carritos')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });

        //tabla 6
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->string('estado', 50)->default('pendiente');
            $table->text('direccion_envio')->nullable();
            $table->timestamps();
        });

        //tabla 7
        Schema::create('orden_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->timestamps();
        });

        //tabla 8
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->decimal('descuento', 10, 2);
            $table->string('tipo', 50); // 'porcentaje' o 'monto_fijo'
            $table->date('fecha_expiracion')->nullable();
            $table->integer('usos_restantes')->default(1);
            $table->timestamps();
        });

        //tabla 9
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->string('metodo_pago', 50); // 'tarjeta_credito', 'paypal', etc.
            $table->string('referencia', 100)->nullable();
            $table->string('estado', 50)->default('completado');
            $table->timestamps();
        });

        //tabla 10
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
            $table->string('estado', 50)->default('pendiente');
            $table->date('fecha_envio')->nullable();
            $table->date('fecha_entrega_estimada')->nullable();
            $table->date('fecha_entrega_real')->nullable();
            $table->decimal('costo_envio', 10, 2)->nullable();
            $table->string('tracking_number', 100)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('carritos');
        Schema::dropIfExists('carrito_productos');
        Schema::dropIfExists('ordenes');
        Schema::dropIfExists('orden_productos');
        Schema::dropIfExists('cupones');
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('envios');
    }

    
};
