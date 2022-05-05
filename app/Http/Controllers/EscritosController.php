<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Expediente;
use App\Model\Escrito;
use Illuminate\Support\Facades\File;

use DB;
use Session;


class EscritosController extends Controller
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


        $orders = Escrito::Join('expedientes', function($f) use($search)
                    {
                        $f->on('expedientes.id','=','escritos.idexpediente');
                    
                    })->orWhere('escritos.proceso','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.numero','LIKE','%'.$search.'%')
                      ->orderBy('escritos.id','DESC')
                      ->select('escritos.*')
                      ->paginate(25);

        return view('escrito.listado', compact('orders'));
  




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

        return view('escrito.crear',compact('user2','tipo','expedientes'));
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
                                $src =  $this->photos_path.'/'.$save_name;

                                $images = $src.','.$images;

                            }

            }




            $user = Escrito::firstOrCreate([
              		'idexpediente' => $request->expediente,
                    'descripcion'  => $request->description,
                    'proceso'      => $request->proceso,
                    'documentos'   => $images

            ]);



            $user->save();

            session::flash('message','El Escrito Fue Creado Correctamente');
            return redirect(route('escritos.index')); 


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



                        $user = Escrito::find($request->id);

                        $document_new = $images.$user->documentos;



                        $user->fill([
                         
                         'idexpediente' => $request->expediente,
                    	 'descripcion'  => $request->description,
                         'proceso'      => $request->proceso,
                         'documentos'   => $document_new

                        ]);



                        $user->save();

                        session::flash('message','El Escrito Fue Actualizado Correctamente');
                        return redirect(route('escritos.index')); 



            }else{


                        $user = Escrito::find($request->id);



                        $user->fill([
                         
                         'idexpediente' => $request->expediente,
                    	 'descripcion'  => $request->description,
                         'proceso'      => $request->proceso,

                        ]);



                        $user->save();

                        session::flash('message','El Escrito Fue Actualizado Correctamente');
                        return redirect(route('escritos.index')); 



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


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $user2 = Escrito::find($id);
        $ruta = $request->root();
        $expedientes = Expediente::where('estado','!=',"Terminado")->where('estado','!=',"Rechazado")->get();
        
        $tipo = "editar";

        return view('escrito.editar', compact('user2','tipo','expedientes','ruta'));


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
       

        $escrito = Escrito::find($id);
        $periodo = explode(",", $escrito->documentos);


        for ($i=0; $i < count($periodo); $i++) { 

        	$ruta = $ruta = public_path().'/'.$periodo[$i];
		    File::delete($ruta);
        }

        Escrito::destroy($id);
        session::flash('message','El Escrito Fue Eliminado Correctamente');
        return redirect(route('escritos.index'));


    }


    public function word($id)
    {        

    	
      
        $escrito = Escrito::where('id', $id)->with('expediente')->first();

    		//"Content-type"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
         
    		//"Content-type"=>"application/octet-stream",


		$headers = array(
    		"Content-type"=>"application/vnd.msword",
    		"Content-Disposition"=>"attachment;Filename=PLANTILLA_ESCRITOS.doc",
    		"Cache-Control"=>"private,max-age0,must-revalidate"
    	);


    	$datos= '<p><b> Expediente:</b> '.$escrito->expediente->numero.'</p>
    	         <p><b> Proceso:</b> '.$escrito->proceso.'</p>';


    	$content = '<html>
					<head>
					<meta http-equiv="Content-Type" content="text/doc" charset="utf-8">
					</head>
				
					<body>
                        <p> '.$datos.' </p>
                        <p> '.$escrito->descripcion.' </p>
					</body>
				    </html>';

				    //$content = "hola bebe";





        return \Response::make($content,200,$headers);
        
    }






    
}
