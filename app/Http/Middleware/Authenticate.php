<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Model\Maestro;
use App\Model\Permiso;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('login'));
            }
        }

        $user = Auth::user()->active;

        if($user){


            //return $next($request);


            $route = Route::currentRouteName();
            $ee = explode(".", $route);
            $rr= $ee[0];

            $Action = Route::currentRouteAction();
            $maestro =  Maestro::where('ruta',$rr)->first();
            $tipo= "";


            

            if ($maestro) {

             
              

              $permissions = Permiso::where('idrol', Auth::user()->idrole)->where('idmaestro',$maestro->id)->first();
              $e = explode("@", $Action);
              $tipo= $e[1];


            }




            if($tipo =="create"){
            
                if ($permissions->agregar == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            if($tipo =="index"){
            
                if ($permissions->ver == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            if($tipo == "edit"){
            
                if ($permissions->editar == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            if($tipo =="inhabilitar"){
            
                if ($permissions->inhabilitar == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }

            if($tipo =="destroy"){
            
                if ($permissions->borrar == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }

            if($tipo =="show"){
            
                if ($permissions->ver == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            if($tipo =="cambiarPassword"){
            
                if ($permissions->ver == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            if($tipo =="profile"){
            
                if ($permissions->ver == 1) {
                   return $next($request);
                }else{
                   return redirect()->guest(route('home'));
                }

            }


            return $next($request);






        }else{
            Auth::logout();
            return redirect()->guest(route('login'));
        }

    }
}
