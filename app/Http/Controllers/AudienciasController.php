<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Expediente;
use App\Model\Audiencia;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;

use DB;
use Session;


class AudienciasController extends Controller
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


        $orders = Audiencia::Join('expedientes', function($f) use($search)
                    {
                        $f->on('expedientes.id','=','audiencias.idexpediente');
                    
                    })->orWhere('audiencias.fecha','LIKE','%'.$search.'%')
                      ->orWhere('audiencias.hora','LIKE','%'.$search.'%')
                      ->orWhere('audiencias.localidad','LIKE','%'.$search.'%')
                      ->orWhere('audiencias.demandado','LIKE','%'.$search.'%')
                      ->orWhere('expedientes.numero','LIKE','%'.$search.'%')
                      ->orderBy('audiencias.id','DESC')
                      ->select('audiencias.*')
                      ->paginate(25);

        return view('audiencia.listado', compact('orders'));
        //return $orders;
  




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

        return view('audiencia.crear',compact('user2','tipo','expedientes'));
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


            $user = Audiencia::firstOrCreate([
              		'idexpediente' => $request->expediente,
                    'senalamiento' => $request->description,
                    'actor'        => $request->actor,
                    'fecha'        => $request->fecha,
                    'hora'         => $request->hora,
                    'demandado'    => $request->demandado,
                    'localidad'    => $request->localidad,
                    'documentos'   => $images,
                    'notificar'    => 1,

            ]);



            $user->save();

            session::flash('message','La Audiencia Fue Creada Correctamente');
            return redirect(route('audiencias.index')); 


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



                        $user = Audiencia::find($request->id);


                        $document_new = $images.$user->documentos;
                       


                        $user->fill([
                         
                         'idexpediente' => $request->expediente,
	                     'senalamiento' => $request->description,
	                     'actor'        => $request->actor,
	                     'fecha'        => $request->fecha,
	                     'hora'         => $request->hora,
	                     'demandado'    => $request->demandado,
	                     'localidad'    => $request->localidad,
                         'documentos'   => $document_new,


                        ]);



                        $user->save();

                        session::flash('message','La Audiencia Fue Actualizada Correctamente');
                        return redirect(route('audiencias.index')); 



            }else{


                        $user = Audiencia::find($request->id);


                        $user->fill([
                         
                        'idexpediente' => $request->expediente,
	                    'senalamiento' => $request->description,
	                    'actor'        => $request->actor,
	                    'fecha'        => $request->fecha,
	                    'hora'         => $request->hora,
	                    'demandado'    => $request->demandado,
	                    'localidad'    => $request->localidad,
                        'notificar'    => $request->notificar,


                        ]);



                        $user->save();

                        session::flash('message','La Audiencia Fue Actualizada Correctamente');
                        return redirect(route('audiencias.index')); 



            }


        }

   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notificar($id)
    {
        
        $audiencia =  Audiencia::with(['expediente'])->where('id',$id)->first();

        $audiencia->fill([
            'notificar'    => 0,
		]);

        $audiencia->save();

        return view('audiencia.detalle', compact('audiencia'));
    }


     public function show($id)
    {
        
        $audiencia =  Audiencia::with(['expediente'])->where('id',$id)->first();
        return view('audiencia.detalle', compact('audiencia'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $user2 = Audiencia::find($id);
        $ruta = $request->root();

        $expedientes = Expediente::where('estado','!=',"Terminado")->where('estado','!=',"Rechazado")->get();

        $tipo = "editar";

        return view('audiencia.editar', compact('user2','tipo','expedientes','ruta'));


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

        $Audiencia = Audiencia::find($id);
        $periodo = explode(",", $Audiencia->documentos);


        for ($i=0; $i < count($periodo); $i++) { 

        	$ruta = $ruta = public_path().'/'.$periodo[$i];
		    File::delete($ruta);
        }

        Audiencia::destroy($id);
        session::flash('message','La Audiencia Fue Eliminada Correctamente');
        return redirect(route('audiencias.index')); 



    }


    public function pdf($id)
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
       

       // return $ytd;

        //$audiencia = Audiencia::find($id);

        $audiencia =  Audiencia::with(['expediente'])->where('id',$id)->first();

        $pdf = PDF::loadView('pdf.audiencia', compact('audiencia'));

        return $pdf->download('Audiencia.pdf');
    }


        public function word($id)
    {        

    	
      
        $Audiencia = Audiencia::where('id', $id)->with('expediente')->first();


		$headers = array(
    		'Content-type'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    		'Content-Disposition'=>'attachment;Filename=PLANTILLA_AUDIENCIAS.doc'
    	);


    	$datos= '<p><b> Expediente:</b> '.$Audiencia->expediente->numero.'</p>
    	         <p><b> Actor:</b> '.$Audiencia->actor.'</p>
    	         <p><b> Demandado:</b> '.$Audiencia->demandado.'</p>
    	         <p><b> Proceso:</b> '.$Audiencia->proceso.'</p>
    	         <p><b> Localidad:</b> '.$Audiencia->localidad.'</p>
    	         <p><b> Fecha:</b> '.$Audiencia->fecha.'</p>
    	         <p><b> Hora:</b> '.$Audiencia->hora.'</p>';


    	$content = '<html>
					<head><meta charset="utf-8"></head>
				
					<body>
                        <p> '.$datos.' </p>
                        <p> '.$Audiencia->senalamiento.' </p>
					</body>
				    </html>';


        return \Response::make($content,200,$headers);

     
        
    }




    
}
