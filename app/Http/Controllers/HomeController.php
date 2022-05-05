<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\Model\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        date_default_timezone_set("America/Chicago");

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $date = $date->format('Y-m-d');


        return view('dashboard.index');

    }

    public function logout()
    {
      Auth::logout();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {


        return redirect(route('home'));

    }

    public function cambiarPassword(Request $request)
    {

        $email = Auth::user()->email;
        $change=false;
        $errorr="false";
        return view('auth.passwords.password', compact('change','email','errorr'));

    }


    public function resetPass(Request $request)
    {


        $email = Auth::user()->email;
        $change=false;
        $errorr="false";


        $user = User::find(Auth::user()->id);

        if (!$request->password || !$request->confirmation || $request->password !== $request->confirmation) {
            $errorr = "true";

            return view('auth.passwords.password', compact('change','email','errorr'));

        }

        // update password
        //$fields = array_merge(['password' => bcrypt($request->password)]);


        $user->fill([
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        //$user->update($fields);
        $change=true;




        return view('auth.passwords.password', compact('change','email','errorr'));
    }



}
