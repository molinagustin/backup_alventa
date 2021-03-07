<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\Contact;
use App\User;
use Mail;

class InfoController extends Controller
{
    public function contact()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return view('info.contact')->with(compact('user'));
        }
        return view('info.contact');
    }

    public function sendEmail(Request $request)
    {
        $this->valid($request);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $admins = User::whereIn('rol_id', [1, 2])->get();
        Mail::to($admins)->send(new Contact($name, $email, $subject, $message));        
        
        //Por medio de una variable de sesion flash enviamos una notificacion
        $notification = 'Tu mensaje fue enviado correctamente.';
        return back()->with(compact('notification'));
    }

    public function valid(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre de usuario es requerido.',
            'name.min' => 'El nombre de usuario debe contener al menos 5 carateres.',
            'name.regex' => 'El nombre de usuario solo admite caracteres alfabeticos y espacios.',

            'email.required' => 'Es necesario la dirección de correo electrónico.',
            'email.email' => 'El correo electrónico debe contener el siguiente formato: "correo@example.com".',

            'message.required' => 'Es necesario redactar un mensaje.',
            'message.max' => 'El mensaje no puede superar los 400 caracteres.',
        ];

        $rules = [
            'name' => 'required|min:5|regex:/^[a-zA-Z\s]+$/u',
            'email' => 'required|email',
            'message' => 'required|max:400',
        ];

        $this->validate($request, $rules, $messages);
    }
}
