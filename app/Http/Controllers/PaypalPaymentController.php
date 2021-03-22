<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPalHttp\HttpException;
use App\Cart;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PaypalPaymentController extends Controller
{
    private $client;
    private $approvedOrderId;

    public function __construct()
    {
        //Obtengo los valores de configuracion del archivo paypal.php de config
        $payPalConfig = Config::get('paypal');
        //Guardo las credenciales del usuario que recibira el dinero
        $environment = new sandboxEnvironment($payPalConfig['client_id'], $payPalConfig['secret']);
        //Creo el usuario al que sera depositada la transaccion y lo dejo como global para no tener q crearlo constantemente
        $this->client = new PayPalHttpClient($environment);
    }

    public function pay()
    {
        //Obtengo el carro del usuario activo que va a realizar el pago
        $cart = Cart::where('user_id', Auth()->user()->id)->where('status_id', '1')->get();
        //dd($cart[0]->total);

        //Creo un nuevo objeto request
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => ($cart[0]->total), //Conversion aproximada a USD
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);
            /*for ($i = 0 ; $i < count($response)-1 ; $i++) {
                $collection = json_decode($response[$i], true);
            }
            dd($collection);*/
            //$this->approvedOrderId = $response;
            //dd($response);


            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            /*print "Status Code: {$response->statusCode}\n";
            print "Status: {$response->result->status}\n";
            print "Order ID: {$response->result->id}\n";
            print "Intent: {$response->result->intent}\n";
            print "Links:\n";
            foreach ($response->result->links as $link) {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            */
            print_r($response);
            
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }

        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request2 = new OrdersCaptureRequest($this->approvedOrderId);
        $request2->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request2);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    public function status()
    {
    }
}
