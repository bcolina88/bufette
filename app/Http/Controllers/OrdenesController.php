<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Historical;
use App\Model\Order;
use DB;
use Session;


class OrdenesController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */


    //private   $photos_path = "documentos";

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        

        $search = $request->get('search');


        $orders = Order::Join('users', function($f) use($search)
                    {
                        $f->on('users.id','=','orders.idatendidopor');
                    
                    })->orWhere('orders.nombre','LIKE','%'.$search.'%')
                      ->orWhere('orders.apellido','LIKE','%'.$search.'%')
                      ->orWhere('orders.email','LIKE','%'.$search.'%')
                      ->orWhere('users.nombre','LIKE','%'.$search.'%')
                      ->orWhere('users.apellido','LIKE','%'.$search.'%')
                      ->orderBy('orders.id','DESC')
                      ->select('orders.*')
                      ->paginate(25);

        return view('orden.listado', compact('orders'));
  




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $user2 = [];
        $roles = User::where('idrole',3)->get();
        $tipo = "guardar";
        return view('orden.crear',compact('roles','user2','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $date = $date->format('Y-m-d');


        $data= request()->validate([
            'nombre' => 'min:4|max:255|required',
            'apellido' => 'min:4|max:255|required',
        ]);



        if($request->tipo === "guardar"){



            $user = Order::firstOrCreate([
             'nombre'          => $request->nombre,
             'numero'          => "",
             'apellido'        => $request->apellido,
             'telefono'        => $request->telefono,
             'email'           => $request->email, 
             'idatendidopor'   => $request->empleado,
             'marca'           => $request->marca,
             'modelo'          => $request->modelo,
             'serie'           => $request->serie,
             'clavebloqueo'    => $request->clave_bloqueo,
             'diagnostico'     => $request->diagnostico,
             'estado'          => "Sin revisar",
             'detalle'         => $request->reparacion,
             'fechacreacion'   => $date,
             'bateria'         => $request->bateria,
             'tapa'            => $request->tapa,
             'memoria'         => $request->memoria,
             'lapiz'           => $request->lapiz,
             'sim'             => $request->sin_card,
             'valor'           => $request->valor,
            ]);



            $user->save();

             return json_encode('creado');


        }  


        if($request->tipo === "editar"){ 



            $user = Order::find($request->id);



                    $user->fill([
                         'nombre'          => $request->nombre,
			             'apellido'        => $request->apellido,
			             'telefono'        => $request->telefono,
			             'email'           => $request->email, 
			             'idatendidopor'   => $request->empleado,
			             'marca'           => $request->marca,
			             'modelo'          => $request->modelo,
			             'serie'           => $request->serie,
			             'clavebloqueo'    => $request->clave_bloqueo,
			             'diagnostico'     => $request->diagnostico,
			             'detalle'         => $request->reparacion,
			             'bateria'         => $request->bateria,
			             'tapa'            => $request->tapa,
			             'memoria'         => $request->memoria,
			             'lapiz'           => $request->lapiz,
			             'sim'             => $request->sin_card,
			             'valor'           => $request->valor,
                    ]);



                    $user->save();



             return json_encode('editar');

         }

   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $users = Order::find($id);


        $movements = Historical::with(['empleado', 'transcriptor'])
                      ->where("historicals.idempleado", $id)
                      ->orderBy('historicals.id','DESC')       
                      ->select('historicals.*')
                      ->get();

        if(count($movements)>0){
            $ultimo_pay = $movements[0];
        }else{
            $ultimo_pay = [];
        }


        $seguro_social = explode("-", $users->seguro_social);
        $ssn = $seguro_social[2];
      



        //return $movements[1];

        return view('ordenes.detalle', compact('users','movements','ultimo_pay','ssn'));
    }


    public function profile($id)
    {


        $users = User::with(['role'])->find($id);


        $movements = Historical::with(['empleado', 'transcriptor'])
                      ->where("historicals.idempleado", $id)
                      ->orderBy('historicals.id','DESC')       
                      ->select('historicals.*')
                      ->get();

        if(count($movements)>0){
            $ultimo_pay = $movements[0];
        }else{
            $ultimo_pay = [];
        }


        $seguro_social = explode("-", $users->seguro_social);
        $ssn = $seguro_social[2];
      



        //return $movements[1];

        return view('usuario.detalle', compact('users','movements','ultimo_pay','ssn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user2 = Order::find($id);
        $roles = User::where('idrole',3)->get();
        $tipo = "editar";

        return view('orden.editar', compact('user2','roles','tipo'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        session::flash('message','La Orden Fue Eliminada Correctamente');
        return redirect(route('ordenes.index')); 
    }



    
}
