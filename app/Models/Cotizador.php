<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Cotizador extends Model
{
    /**
     * Obtener el token de autenticación desde la API.
     *
     * @return string|null
     */
    private static function getToken()
    {
        $authResponse = Http::post('https://mexlv.epresis.com/api/v1/getDataUser.json', [
            "tipo_tienda" => "vtex"
        ]);

        if ($authResponse->successful()) {
            $authData = $authResponse->json('data');
            return $authData[0]['token'];
        } else {
            return null;
        }
    }

    /**
     * Obtener la cotización del envío desde la API.
     *
     * @param int $cp_origen
     * @param int $cp_destino
     * @param int $kilos
     * @return object|null
     */
    public static function getCotizacion($cp_origen, $cp_destino, $kilos)
    {
        $authToken = self::getToken();

        if ($authToken) {
            $body = [
                "api_token" => $authToken,
                "codigo_servicio" => "007",
                "cp_origen" => $cp_origen,
                "cp_destino" => $cp_destino,
                "is_urgente" => false,
                "valor_declarado" => 0,
                "productos" => [
                    [
                        "bultos" => 1,
                        "peso" => $kilos,
                        "descripcion" => "",
                        "dimensiones" => [
                            "alto" => 0,
                            "largo" => 0,
                            "profundidad" => 0
                        ]
                    ]
                ]
            ];

            $cotizacionResponse = Http::withToken($authToken)->post('https://mexlv.epresis.com/api/v2/cotizador.json', $body);

            if ($cotizacionResponse->successful()) {
                return $cotizacionResponse->object();
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Obtener el nombre de la localidad basado en el código postal.
     *
     * @param int $cp
     * @return string|null
     */
    public static function getNombreLocalidad($cp)
    {
        $authToken = self::getToken();

        if ($authToken) {
            $localidadesResponse = Http::withToken($authToken)->post('https://mexlv.epresis.com/api/v2/localidades.json');

            if ($localidadesResponse->successful()) {
                $localidadesArray = $localidadesResponse->json();

                $filteredArray = array_filter($localidadesArray, function ($item) use ($cp) {
                    return $item['cp'] === $cp;
                });
                $filteredArray = reset($filteredArray);

                if ($filteredArray) {
                    return $filteredArray['nombre'];
                } else {
                    return 'CP' . $cp;
                }
            } else {
                return 'CP' . $cp;
            }
        } else {
            return null;
        }
    }
}
