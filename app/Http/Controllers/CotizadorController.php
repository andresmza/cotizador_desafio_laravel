<?php

namespace App\Http\Controllers;

use App\Models\Cotizador;
use Illuminate\Http\Request;

class CotizadorController extends Controller
{
    protected $cotizador;

    /**
     * Constructor de la clase CotizadorController.
     *
     * @param \App\Models\Cotizador $cotizador
     */
    public function __construct(Cotizador $cotizador)
    {
        $this->cotizador = $cotizador;
    }

    /**
     * Mostrar la vista de bienvenida.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('cotizador');
    }

    /**
     * Calcular el costo del envío.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cotizar(Request $request)
    {
        $request->validate([
            'cp_origen' => 'required|numeric|min:1',
            'cp_destino' => 'required|numeric|min:1',
            'kilos' => 'required|numeric|min:1',
        ]);

        $cp_origen = $request->cp_origen;
        $cp_destino = $request->cp_destino;
        $kilos = $request->kilos;

        $cotizacion = $this->cotizador->getCotizacion($cp_origen, $cp_destino, $kilos);

        if ($cotizacion) {
            $origen = $this->cotizador->getNombreLocalidad($cp_origen);
            $destino = $this->cotizador->getNombreLocalidad($cp_destino);

            $data = [
                'total' => $cotizacion->importe_total_flete,
                'peso' => $cotizacion->retiro_peso,
                'origen' => $origen,
                'destino' => $destino,
            ];

            return response()->json($data, 200);
        } else {
            return response()->json(['error' => 'Error en la cotización'], 500);
        }
    }
}
