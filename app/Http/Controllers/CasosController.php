<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Caso;
use App\Model\Expediente;
use Illuminate\Support\Facades\File;

use DB;
use Session;


class CasosController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */


    private   $photos_path = "documentos";
     


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


        $orders = Caso::Join('expedientes', function($f) use($search)
                    {
                        $f->on('expedientes.id','=','casos.idexpediente');
                    
                    })->orWhere('casos.proceso','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.numero','LIKE','%'.$search.'%')
                      ->orderBy('casos.id','DESC')
                      ->select('casos.*')
                      ->paginate(25);

        return view('caso.listado', compact('orders'));
  




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
        $expedientes = Expediente::where('estado','!=',"Terminado")->where('estado','!=',"Rechazado")->get();

        return view('caso.crear',compact('user2','tipo','expedientes'));
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


        $images =  '';

        if($request->tipo === "guardar"){


        	if ($request->file('images')) {


                            $photos = $request->file('images');

                            if (!is_array($photos)) {
                                $photos = [$photos];
                            }

                            if (!is_dir($this->photos_path)) {
                                mkdir($this->photos_path, 0777);
                            }


                            for ($i = 0; $i < count($photos); $i++) {

                                $photo = $photos[$i];
                                $name = sha1(date('YmdHis') . str_random(30));
                                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                                $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

                                $photo->move($this->photos_path, $save_name);
                            
                               
                                //$src = url("/{$this->photos_path}/{$save_name}");
                                //$ruta = $request->root();
                                $src = $this->photos_path.'/'.$save_name;

                                $images = $src.','.$images;

                            }

            }




            $user = Caso::firstOrCreate([
              		'idexpediente' => $request->expediente,
                    'descripcion'  => $request->description,
                    'proceso'      => $request->proceso,
                    'documentos'   => $images

            ]);



            $user->save();

            session::flash('message','El Caso Fue Creado Correctamente');
            return redirect(route('casos.index')); 


        }  


        if($request->tipo === "editar"){ 



        	if ($request->file('images')) {


                        $photos = $request->file('images');

                        if (!is_array($photos)) {
                            $photos = [$photos];
                        }

                        if (!is_dir($this->photos_path)) {
                            mkdir($this->photos_path, 0777);
                        }


                        for ($i = 0; $i < count($photos); $i++) {

                            $photo = $photos[$i];
                            $name = sha1(date('YmdHis') . str_random(30));
                            $save_name = $name . '.' . $photo->getClientOriginalExtension();
                            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

                            $photo->move($this->photos_path, $save_name);
                            
                               
                            //$src = url("/{$this->photos_path}/{$save_name}");

                            //$ruta = $request->root();
                            $src = $this->photos_path.'/'.$save_name;

                            $images = $src.','.$images;

                        }



                        $user = Caso::find($request->id);

                        $document_new = $images.$user->documentos;



                        $user->fill([
                         
                         'idexpediente' => $request->expediente,
                    	 'descripcion'  => $request->description,
                         'proceso'      => $request->proceso,
                         'documentos'   => $document_new

                        ]);



                        $user->save();

                        session::flash('message','El Caso Fue Actualizado Correctamente');
                        return redirect(route('casos.index')); 



            }else{


                        $user = Caso::find($request->id);



                        $user->fill([
                         
                         'idexpediente' => $request->expediente,
                    	 'descripcion'  => $request->description,
                         'proceso'      => $request->proceso,

                        ]);



                        $user->save();

                        session::flash('message','El Caso Fue Actualizado Correctamente');
                        return redirect(route('casos.index')); 



            }


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




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $user2 = Caso::find($id);
        $ruta = $request->root();

        $expedientes = Expediente::where('estado','!=',"Terminado")->where('estado','!=',"Rechazado")->get();
        $tipo = "editar";

        return view('caso.editar', compact('user2','tipo','expedientes','ruta'));


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
        
    	$Caso = Caso::find($id);
        $periodo = explode(",", $Caso->documentos);


        for ($i=0; $i < count($periodo); $i++) { 

        	$ruta = $ruta = public_path().'/'.$periodo[$i];
		    File::delete($ruta);
        }

        Caso::destroy($id);
        session::flash('message','El Caso Fue Eliminado Correctamente');
        return redirect(route('casos.index')); 

    }

    public function word($id)
    {        

    	
      
        $caso = Caso::where('id', $id)->with('expediente')->first();


		$headers = array(
    		"Content-type"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    		"Content-Disposition"=>"attachment;Filename=PLANTILLA_CASOS.doc"
    	);


    	$datos= '<p><b> Expediente:</b> '.$caso->expediente->numero.'</p>
    	         <p><b> Proceso:</b> '.$caso->proceso.'</p>';


    	$content = '<html>
					<head><meta charset="utf-8"></head>
				
					<body>
                        <p> '.$datos.' </p>
                        <p> '.$caso->descripcion.' </p>
					</body>
				    </html>';


        return \Response::make($content,200,$headers);
        
    }



    
}
