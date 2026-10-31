<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// agregar_indice_a_visitas - v1.0 (30/10/2026)
// La portada y las publicaciones ejecutan en cada carga:
//   UPDATE visitas SET num = num + 1 WHERE fecha = ? AND pagina = ?
// Sin indice, MySQL recorre toda la tabla en cada visita (3-4 s en el servidor).
// El indice usa un prefijo de 100 caracteres de "pagina" para que funcione igual en InnoDB y MyISAM.
// Es seguro repetirla: si el indice ya existe, no hace nada.
return new class extends Migration
{
    private const INDICE = 'visitas_fecha_pagina_idx';

    public function up(): void
    {
        $existe = DB::select('SHOW INDEX FROM visitas WHERE Key_name = ?', [self::INDICE]);
        if (!$existe) {
            DB::statement('CREATE INDEX ' . self::INDICE . ' ON visitas (fecha, pagina(100))');
        }
    }

    public function down(): void
    {
        $existe = DB::select('SHOW INDEX FROM visitas WHERE Key_name = ?', [self::INDICE]);
        if ($existe) {
            DB::statement('DROP INDEX ' . self::INDICE . ' ON visitas');
        }
    }
};
