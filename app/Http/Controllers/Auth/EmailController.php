<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function confirm(Request $request)
    {
        $param1 = $request->input('param1');
        $param2 = $request->input('param2');

        $user = User::find($param1);
        if ($user->password === $param2) {
            $user->email_verified_at = now();
            $user->save();
            $updateUserData = 'Dirección de correo electrónico verificada correctamente.';
            return redirect(route('settings'))->with(compact('updateUserData'));
        }

        $error = 'La dirección de correo electrónico no pudo ser confirmada, por favor solicite un nuevo enlance y verifique los datos del usuario.';
        return redirect(route('settings'))->with(compact('error'));
    }
}
