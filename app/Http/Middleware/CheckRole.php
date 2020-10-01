<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->path() == 'login' || $request->path() == 'loginadmin'){
            return $next($request);
        }

        //Mendapat Nama Controller yang Diakses
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        
        $role = $request->user()->role;
        if($role == "0"){ //admin
            return $next($request);
        }
        else if($role == "1"){ //student
            if(strcmp($controller,"AdminController") != 0){
                return $next($request);
            }
            return response("Hak Akses Anda Ditolak");
        }
    }
}
