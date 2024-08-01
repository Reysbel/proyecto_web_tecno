<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\LCliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CarritoAController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('id_categoria')->get();
        $productosPorCategoria = $productos->groupBy('id_categoria');
        $categorias = Categoria::all();
        $lclientes = LCliente::all();
        $carrito = Session::get('carrito', []);

        foreach ($carrito as &$detalle) {
            if (!isset($detalle['total'])) {
                $detalle['total'] = $detalle['cantidad'] * $detalle['producto']->total_venta;
            }
        }
        unset($detalle);

        $total_carrito = array_sum(array_column($carrito, 'total'));
        
        

        return view('admin.carrito.index', compact('productos', 'productosPorCategoria', 'categorias', 'lclientes', 'carrito', 'total_carrito'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto]['cantidad']++;
        } else {
            $carrito[$id_producto] = [
                'producto' => $producto,
                'cantidad' => 1,
            ];
        }

        $carrito[$id_producto]['total'] = $carrito[$id_producto]['cantidad'] * $producto->total_venta;

        Session::put('carrito', $carrito);

        return redirect()->route('admin.carrito.index');
    }

    public function actualizarCantidad(Request $request, $id_producto)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            $producto = $carrito[$id_producto]['producto'];
            $cantidad = (int)$request->input('cantidad');

            if ($cantidad > 0) {
                $carrito[$id_producto]['cantidad'] = $cantidad;
                $carrito[$id_producto]['total'] = $cantidad * $producto->total_venta;
                Session::put('carrito', $carrito);
            } else {
                return redirect()->back()->with('error', 'La cantidad debe ser mayor que cero.');
            }
        }

        return redirect()->route('admin.carrito.index');
    }

    public function eliminarDelCarrito($id_producto)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            unset($carrito[$id_producto]);
        }

        Session::put('carrito', $carrito);

        return redirect()->route('admin.carrito.index');
    }

    public function cancelarCompra()
    {
        Session::forget('carrito');

        return redirect()->route('admin.carrito.index');
    }

    public function realizarPedido(Request $request)
    {
        // Imprimir valores recibidos del request
        // dd($request->all());
        $request->validate([
            'nombre' => 'nullable|string|max:255',
            'celular' => 'nullable|digits_between:7,10',
            'correo' => 'nullable|email|max:255',
            'nit' => 'nullable|string|max:20',
            'metodo_pago' => 'required|string',
        ]);

        

        $carrito = Session::get('carrito', []);

        foreach ($carrito as &$detalle) {
            if (!isset($detalle['total'])) {
                $detalle['total'] = $detalle['cantidad'] * $detalle['producto']->total_venta;
            }
        }
        unset($detalle);

        $sub_total = array_sum(array_column($carrito, 'total'));
        $descuento = $request->input('descuento', 0);
        $total_factura = $sub_total - ($sub_total * $descuento / 100);

        $user_id = Auth::id();

        DB::beginTransaction();

        try {
            $lcliente = new LCliente();
            $lcliente->nombre = $request->input('nombre');
            if ($request->input('metodo_pago') !== 'efectivo') {
                $lcliente->celular = $request->input('celular');
                $lcliente->correo = $request->input('correo');
            }
            $lcliente->save();

            $factura = new Factura();
            $factura->fecha = now();
            $factura->hora = now();
            $factura->sub_total = $sub_total;
            $factura->descuento = $descuento;
            $factura->total_factura = $total_factura;
            $factura->nit = $request->input('nit');
            $factura->user_id = $user_id;
            $factura->estado_factura = 'pendiente';
            $factura->metodo_pago = $request->input('metodo_pago');
            $factura->id_lcliente = $lcliente->id_lcliente;
            $factura->save();

            foreach ($carrito as $id_producto => $detalle) {
                $detallefactura = new DetalleFactura();
                $detallefactura->id_factura = $factura->id_factura;
                $detallefactura->id_producto = $id_producto;
                $detallefactura->cantidad = $detalle['cantidad'];
                $detallefactura->total = $detalle['total'];
                $detallefactura->save();
            }

            DB::commit();

            Session::forget('carrito');
            Session::put('factura', $factura);
            Session::put('detalle_factura', $carrito);

            return redirect()->route('admin.carrito.show');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al procesar el pedido: ' . $e->getMessage()]);
        }

        try {
            $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda = 2;
            $lnTelefono = $lcliente->celular;
            $lcNombreUsuario = $lcliente->nombre;
            $lnCiNit = $factura->nit;
            $lcNroPago = "UAGRM-SC-GRUPO1-1";
            $lnMontoClienteEmpresa = $factura->total_factura;
            $lcCorreo = $lcliente->correo;
            $lcUrlCallBack = "http://localhost:8000/";
            $lcUrlReturn = "http://localhost:8000/";
            $laPedidoDetalle = collect($carrito)->map(function ($detalle) {
                return (object) [
                    "Serial" => $detalle['producto']->id_producto,
                    "Producto" => $detalle['producto']->nombre,
                    "Cantidad" => $detalle['cantidad'],
                    "Precio" => $detalle['producto']->precio,
                    "Descuento" => $detalle['producto']->descuento,
                    "Total" => $detalle['total']
                ];
            })->toArray();

            $lcUrl = "";

            $loClient = new Client();

            if ($request->tnTipoServicio == 1) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
            } elseif ($request->tnTipoServicio == 2) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
            }

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody = [
                "tcCommerceID" => $lcComerceID,
                "tnMoneda" => $lnMoneda,
                "tnTelefono" => $lnTelefono,
                'tcNombreUsuario' => $lcNombreUsuario,
                'tnCiNit' => $lnCiNit,
                'tcNroPago' => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo" => $lcCorreo,
                'tcUrlCallBack' => $lcUrlCallBack,
                "tcUrlReturn" => $lcUrlReturn,
                'taPedidoDetalle' => array_values($laPedidoDetalle)
            ];

            // Imprimir valores enviados a la API externa
          // dd($laBody);

          

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());

            if ($request->tnTipoServicio == 1) {
                $laValues = explode(";", $laResult->values)[1];
                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tnTipoServicio == 2) {
                $csrfToken = csrf_token();

                echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">' . $laResult->values . '</p><br>';
                echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                echo '<script>
                        $(document).ready(function() {
                            function hacerSolicitudAjax(numero) {
                                var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };
                                
                                $.ajax({
                                    url: \'/consultar\',
                                    type: \'POST\',
                                    data: data,
                                    success: function(response) {
                                        var iframe = document.getElementsByName(\'QrImage\')[0];
                                        iframe.contentDocument.open();
                                        iframe.contentDocument.write(response.message);
                                        iframe.contentDocument.close();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            }
    
                            setInterval(function() {
                                hacerSolicitudAjax(' . $laResult->values . ');
                            }, 7000);
                        });
                    </script>';
            }
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
    }


    public function resumenPedido()
    {
        $factura = Session::get('factura');
        if ($factura) {
            $factura->lcliente = LCliente::find($factura->id_lcliente);
        }
        $detalle_factura = Session::get('detalle_factura');

        return view('admin.carrito.show', compact('factura', 'detalle_factura'));
    }

    public function nuevoPedido()
    {
        Session::forget('carrito');
        return redirect()->route('admin.carrito.index');
    }

    public function consultarEstado(Request $request)
    {
        $lnTransaccion = $request->tnTransaccion;

        $loClientEstado = new Client();

        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        try {
            $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
                'headers' => $laHeaderEstadoTransaccion,
                'json' => $laBodyEstadoTransaccion
            ]);

            $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());

            $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';

            return response()->json(['message' => $texto]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al consultar el estado de la transacción: ' . $e->getMessage()]);
        }
    }

    public function urlCallback(Request $request)
    {
        // Verificar la firma del callback para asegurarse de que es una llamada legítima
        $signature = $request->header('Signature');
        if (!$this->verifySignature($request->all(), $signature)) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // Obtener los datos del callback
        $status = $request->input('status');
        $id_factura = $request->input('tnCiNit');
        $transaction_id = $request->input('transaction_id');

        // Buscar la factura correspondiente
        $factura = Factura::find($id_factura);

        if (!$factura) {
            return response()->json(['error' => 'Factura no encontrada'], 404);
        }

        // Actualizar el estado de la factura basado en el estado recibido en el callback
        if ($status == 'success') {
            $factura->estado_factura = 'pagada';
            $factura->transaction_id = $transaction_id;
            $factura->save();
        } else if ($status == 'failed') {
            $factura->estado_factura = 'fallida';
            $factura->transaction_id = $transaction_id;
            $factura->save();
        } else {
            return response()->json(['error' => 'Estado de pago desconocido'], 400);
        }

        return response()->json(['message' => 'Callback procesado con éxito'], 200);
    }

    // Función para verificar la firma del callback
    private function verifySignature($data, $signature)
    {
        $secret = env('YOUR_SECRET_KEY');
        $computedSignature = hash_hmac('sha256', json_encode($data), $secret);
        return hash_equals($computedSignature, $signature);
    }
}
