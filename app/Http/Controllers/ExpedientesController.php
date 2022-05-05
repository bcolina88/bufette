<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Expediente;
use DB;
use Session;


class ExpedientesController extends Controller
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


        $orders = Expediente::orWhere('expedientes.numero','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.estado','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.fecha_entrada','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.fecha_estado','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.proceso','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.estado','LIKE','%'.$search.'%')
                      ->orderBy('expedientes.id','DESC')
                      ->select('expedientes.*')
                      ->paginate(25);

        return view('expediente.listado', compact('orders'));
  




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $user2 = [];
        $tipo = "guardar";
        return view('expediente.crear',compact('user2','tipo'));
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
            'numero' => 'min:4|max:255|required',
        ]);



        if($request->tipo === "guardar"){



            $user = Expediente::firstOrCreate([
             'numero'          => $request->numero,
             'estado'          => "Iniciado",
             'fecha_entrada'   => $request->fecha_entrada,
             'fecha_estado'    => $request->fecha_estado,
             'proceso'         => $request->proceso,

            ]);



            $user->save();

             return json_encode('creado');


        }  


        if($request->tipo === "editar"){ 



            $user = Expediente::find($request->id);



                    $user->fill([
                         'numero'          => $request->numero,
			             'estado'          => $request->estado,
			             'fecha_entrada'   => $request->fecha_entrada,
			             'fecha_estado'    => $request->fecha_estado,
			             'proceso'         => $request->proceso,
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


        $expediente = Expediente::find($id);


       /* $movements = Historical::with(['empleado', 'transcriptor'])
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
        $ssn = $seguro_social[2];*/
      



        //return $movements[1];

        return view('expediente.detalle', compact('expediente'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user2 = Expediente::find($id);
        $tipo = "editar";

        return view('expediente.editar', compact('user2','tipo'));


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
        Expediente::destroy($id);
        session::flash('message','El Expediente Fue Eliminado Correctamente');
        return redirect(route('expedientes.index')); 
    }



    
}
