<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suscriptor;
use Illuminate\Http\Request;

// Admin\SuscriptorController - v1.0 (30/10/2026): lista de suscriptores del boletin y exportacion a CSV.
// Acceso: usuarios con el permiso admin.users.index (ver routes/admin.php).
class SuscriptorController extends Controller
{
    public function index(Request $request)
    {
        $estado = $request->query('estado', 'todos');
        $consulta = Suscriptor::query()->latest('id');

        match ($estado) {
            'confirmados' => $consulta->whereNotNull('confirmado_en')->whereNull('baja_en'),
            'pendientes' => $consulta->whereNull('confirmado_en')->whereNull('baja_en'),
            'bajas' => $consulta->whereNotNull('baja_en'),
            default => $estado = 'todos',
        };

        $suscriptores = $consulta->paginate(50)->withQueryString();
        $totales = [
            'confirmados' => Suscriptor::whereNotNull('confirmado_en')->whereNull('baja_en')->count(),
            'pendientes' => Suscriptor::whereNull('confirmado_en')->whereNull('baja_en')->count(),
            'bajas' => Suscriptor::whereNotNull('baja_en')->count(),
        ];

        return view('admin.suscriptores.index', compact('suscriptores', 'totales', 'estado'));
    }

    // CSV (abre bien en Excel) con las suscripciones activas
    public function exportar()
    {
        $nombre = 'suscriptores_' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $salida = fopen('php://output', 'w');
            fwrite($salida, "\xEF\xBB\xBF"); // BOM para que Excel lea bien los acentos
            fputcsv($salida, ['correo', 'confirmado_en'], ';');
            Suscriptor::whereNotNull('confirmado_en')->whereNull('baja_en')->orderBy('id')
                ->chunkById(500, function ($filas) use ($salida) {
                    foreach ($filas as $fila) {
                        $correo = $fila->email;
                        // evita que Excel interprete el correo como formula
                        if (preg_match('/^[=+\-@]/', $correo)) {
                            $correo = "'" . $correo;
                        }
                        fputcsv($salida, [$correo, $fila->confirmado_en?->format('Y-m-d H:i')], ';');
                    }
                });
            fclose($salida);
        }, $nombre, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
