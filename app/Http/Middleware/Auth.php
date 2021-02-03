<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class Auth
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

        if(!$request->session()->has("activeUser")){

            $request->session()->flash("error","Please login first");
            return redirect("/admin");
        }else{
          $activeUser = $request->session()->get("activeUser");
          $countUser =  DB::table("sp_users")->where("username",$activeUser->username)->where("pass",$activeUser->pass)->count();
          if($countUser <= 0){
              return redirect("admin/logout");
          }
        }

        return $next($request);
    }
}
