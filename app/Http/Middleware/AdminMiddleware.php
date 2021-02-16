<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Verificamos que el usuario haya iniciado sesion. Son metodos por defecto de Laravel
        /* Ya no validamos el inicio de sesion, sino que lo hacemos por medio del Middleware que trae Laravel
        if (!auth()->check()){
            //Lo redirigimos al Login
            return redirect('/login');
        }*/
    
        //Comprobamos el tipo de usuario. Si no es administrador
        //2 formas de hacerlo
        //Comprobante el ID del ROL por medio de la funcion de Eloquen que me permite acceder a los roles gracias a la
        //relacion entre modelos que se hizo entre ROL y USUARIO a traves del metodo ROL
        if (auth()->user()->rol->id != 1){
            return redirect('/');
        }

        //Comprobante el campo rol_id dentro del usuario
        /*if (auth()->user()->rol_id != 1){
            return redirect('/');
        }*/

        return $next($request);
    }
}
