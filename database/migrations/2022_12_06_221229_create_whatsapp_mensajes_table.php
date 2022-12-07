<?php

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
        Schema::create('whatsapp_mensajes', function (Blueprint $table) {
            $table->id();
            $table->integer('token_id'); //identificador del token sactum
            $table->integer('configwhatsapps_id'); //identificador de configuracion
            $table->foreignId('user_id') // UNSIGNED BIG INT
                    ->nullable() // <-- IMPORTANTE: LA COLUMNA DEBE ACEPTAR NULL COMO VALOR VALIDO
                    ->constrained()  // <-- DEFINE LA RESTRICCION DE LLAVE FORANEA
                    ->onDelete('SET NULL')
                    ->onUpdate('cascade');
            
            $table->string('id_mensaje')->nullable();
            $table->string('status')->nullable();
            $table->string('linea_temporal')->nullable();
            $table->string('recipient')->nullable();
            $table->string('id_wha_buss')->nullable(); // Identificador de la cuenta de WhatsApp Business
            $table->string('id_tlf_buss')->nullable(); // Identificador de número de teléfono
            $table->string('display_phone_number')->nullable(); // número de teléfono


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
        Schema::dropIfExists('whatsapp_mensajes');
    }
};
