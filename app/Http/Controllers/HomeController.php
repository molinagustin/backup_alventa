<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Nullable;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Variable que contiene los carros que esten en otro estado distinto a Active o Cancelled
        $carts = Auth::user()->carts->whereNotIn('status_id', ['1']);
        $carts = $carts->sortByDesc('order_date');
        //dd($carts);

        //Cuento la totalidad de ordenes realizadas por un usuario (Que el carro no este Active o Cancelled)
        $totalOrders = Auth::user()->carts->whereNotIn('status_id', ['1', '4'])->count();

        //Cuento el dinero gastado en los pedidos realizados
        $moneySpent = 0;
        foreach ($carts as $cart) {
            $moneySpent += $cart->total;
        }
        return view('home')->with(compact('carts', 'totalOrders', 'moneySpent'));
    }

    public function update(Request $request)
    {
        //Valido los controles de la solicitud
        $this->valid($request);

        //Verifico que la contraseña del usuario actual coincida con la ingresada en el formulario
        if (Hash::check($request->input('password'), Auth()->user()->password)) {
            if (auth()->user()->email_verified_at) {
                $user = User::find(Auth()->user()->id);
                $user->name = $request->input('username');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->address = $request->input('address');

                //Si se detecta un cambio de contraseña, se la asigno a los valores encriptandola
                if ($request->input('new-password') != null)
                    $user->password = Hash::make($request->input('new-password'));

                $save = $user->save();

                if ($save) {
                    $updateUserData = 'Datos modificados correctamente';
                    return back()->with(compact('updateUserData'));
                }
                $error = 'El registro no pudo ser actualizado.';
                return back()->with(compact('error'));
            }
            else
                return back()->withErrors('Debe verificar su correo electrónico antes de realizar cualquier cambio.');
        } else {
            return back();
        }
    }

    public function valid(Request $request)
    {
        $messages = [
            'username.required' => 'El nombre de usuario es requerido.',
            'username.min' => 'El nombre de usuario debe contener al menos 5 carateres.',
            'username.regex' => 'El nombre de usuario solo admite caracteres alfabeticos y espacios.',

            'password.required' => 'Se requiere ingresar la contraseña actual.',
            'password.password' => 'La contraseña ingresada no coincide con la del usuario actual.',

            'email.required' => 'Es necesario la dirección de correo electrónico.',
            'email.email' => 'El correo electrónico debe contener el siguiente formato: "correo@example.com".',

            'new-password.min' => 'La nueva contraseña debe contener un largo de 8 caracteres minimos.',
            'new-password.confirmed' => 'No se pudo confirmar la nueva contraseña.',

            'new-password_confirmation.required_with' => 'Es necesario confirmar la nueva contraseña.',
            'new-password_confirmation.same' => 'La nueva contraseña no coincide con su confirmación.',

            'phone.numeric' => 'El numero de teléfono debe ser numerico solamente y sin espacios.',

            'address.max' => 'La dirección no puede exceder los 50 caracteres.',
        ];

        $rules = [
            'username' => 'required|min:5|regex:/^[a-zA-Z\s]+$/u',
            'password' => 'required|password|bail',
            'email' => 'required|email',
            'new-password' => 'nullable|min:8|confirmed',
            'new-password_confirmation' => 'required_with:new-password|same:new-password',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|max:50',
        ];

        $this->validate($request, $rules, $messages);
    }
}
