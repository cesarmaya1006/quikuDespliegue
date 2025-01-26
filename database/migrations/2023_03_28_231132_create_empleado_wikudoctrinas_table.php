<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoWikudoctrinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_wikudoctrinas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('wikudoctrina_id')->nullable();
            $table->foreign('wikudoctrina_id', 'fk_wikudoctrina_wikudoctrinas_usu')->references('id')->on('wikudoctrinas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'fk_empleado_wikudoctrinas_usu')->references('id')->on('empleados')->onDelete('restrict')->onUpdate('restrict');
            $table->string('tipo', 255);
            $table->string('titulo', 255);
            $table->longText('descripcion')->nullable();
            $table->integer('anno')->nullable();
            $table->integer('mes')->nullable();
            $table->integer('dia')->nullable();
            $table->string('ciudad', 255)->nullable();
            $table->string('editorial', 255)->nullable();
            $table->string('revista', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('archivo', 255)->nullable();
            $table->unsignedBigInteger('wikuautorinstitu_id')->nullable();
            $table->foreign('wikuautorinstitu_id', 'fk_usu_doctrina_wikuautorinstitu')->references('id')->on('wikuautorinstitu')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('wikuautores_id')->nullable();
            $table->foreign('wikuautores_id', 'fk_usu_doctrina_wikuautores')->references('id')->on('wikuautores')->onDelete('restrict')->onUpdate('restrict');
            $table->longText('texto');
            $table->string('paginas', 255)->nullable();
            $table->unsignedBigInteger('wikutemaespecifico_id')->nullable();
            $table->foreign('wikutemaespecifico_id', 'fk_usu_temaespecifico_doctrina')->references('id')->on('wikutemaespecifico')->onDelete('restrict')->onUpdate('restrict');
            $table->bigInteger('destacado')->default(0);
            $table->bigInteger('estado')->default(1);
            $table->text('observacion');
            $table->text('respuesta');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_wikudoctrinas');
    }
}
