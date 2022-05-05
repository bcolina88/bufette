<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Role;
use App\Model\Historical;
use DB;
use Session;


class UsersController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */


    private   $photos_path = "documentos";

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


        $users = User::Join('roles', function($f) use($search)
                    {
                        $f->on('roles.id','=','users.idrole');
                    
                    })->orWhere('users.nombre','LIKE','%'.$search.'%')
                      ->orWhere('users.apellido','LIKE','%'.$search.'%')
                      ->orWhere('users.email','LIKE','%'.$search.'%')
                      ->orWhere('roles.tipo','LIKE','%'.$search.'%')
                      ->orderBy('users.id','DESC')
                      ->select('users.*')
                      ->paginate(25);

        return view('usuario.listado', compact('users'));




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $user2 = [];
        $roles = Role::all();
        $tipo = "guardar";
        return view('usuario.crearusuario',compact('roles','user2','tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data= request()->validate([
            'nombre' => 'min:4|max:255|required',
            'apellido' => 'min:4|max:255|required',
            'email' => 'min:4|max:255|required|email|unique:users,email,',
            'idrole' => 'required|integer:1,2,3,|not_in:0',
            'password' => 'min:6|max:255|required',
        

        ]);


        $images =  '';



        if ($request->declaracion ==="on") {
          $declaracion = true;
        }else{
          $declaracion = false;
        }



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

                                $ruta = $request->root();
                                $src = $ruta.'/'.$this->photos_path.'/'.$save_name;

                                $images = $src.','.$images;

                            }

            }


            $user = User::firstOrCreate([
             'nombre'          => $request->nombre,
             'apellido'        => $request->apellido,
             'email'           => $request->email, 
             'idrole'          => $request->idrole,
             'password'        => bcrypt($request->password),
             'active'          => 1,
             'domicilio'       => $request->domicilio,
             'departamento'    => $request->departamento,
             'ciudad'          => $request->ciudad,
             'estado'          => $request->estado,
             'codigo_postal'   => $request->codigo_postal,
             'fecha_nacimiento'=> $request->fecha_nacimiento,
             'seguro_social'   => $request->seguro_social,
             'contacto_emergencia' => $request->contacto_emergencia,
             'images'          => $images,
             'telefono'        => $request->telefono,

            ]);



            $user->save();

            session::flash('message','El usuario Fue Creado Correctamente');
            return redirect(route('usuarios.index')); 

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
                            $ruta = $request->root();
                            $src = $ruta.'/'.$this->photos_path.'/'.$save_name;

                            $images = $src.','.$images;

                        }





                        if($request->password != null){
         
                        } else {
                         unset($request->password);
                        }

                        $user = User::with(['role'])->find($request->id);



                        $user->fill([
                         'nombre'          => $request->nombre,
                         'apellido'        => $request->apellido,
                         'email'           => $request->email, 
                         'idrole'          => $request->idrole,
                         'password'        => bcrypt($request->password),
                         'domicilio'       => $request->domicilio,
                         'departamento'    => $request->departamento,
                         'ciudad'          => $request->ciudad,
                         'estado'          => $request->estado,
                         'codigo_postal'   => $request->codigo_postal,
                         'fecha_nacimiento'=> $request->fecha_nacimiento,
                         'seguro_social'   => $request->seguro_social,
                         'contacto_emergencia' => $request->contacto_emergencia,
                         'images'          => $images,
                         'active'          => $request->estado,
                         'telefono'        => $request->telefono,


                        ]);



                        $user->save();

                        session::flash('message','El usuario Fue Actualizado Correctamente');
                        return redirect(route('usuarios.index')); 



            }else{



                        if($request->password != null){
         
                        } else {
                         unset($request->password);
                        }

                        $user = User::with(['role'])->find($request->id);



                        $user->fill([
                         'nombre'          => $request->nombre,
                         'apellido'        => $request->apellido,
                         'email'           => $request->email, 
                         'idrole'          => $request->idrole,
                         'password'        => bcrypt($request->password),
                         'domicilio'       => $request->domicilio,
                         'departamento'    => $request->departamento,
                         'ciudad'          => $request->ciudad,
                         'estado'          => $request->estado,
                         'codigo_postal'   => $request->codigo_postal,
                         'fecha_nacimiento'=> $request->fecha_nacimiento,
                         'seguro_social'   => $request->seguro_social,
                         'contacto_emergencia' => $request->contacto_emergencia,
                         'active'          => $request->estado,
                         'telefono'        => $request->telefono,

                         

                        ]);



                        $user->save();

                        session::flash('message','El usuario Fue Actualizado Correctamente');
                        return redirect(route('usuarios.index')); 



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


        $users = User::with(['role'])->find($id);

        //return $movements[1];

        return view('usuario.detalle', compact('users'));
    }


    public function profile($id)
    {


        $users = User::with(['role'])->find($id);

        return view('usuario.detalle', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user2 = User::with(['role'])->find($id);
        $roles = Role::all();
        $tipo = "editar";

        return view('usuario.editar', compact('user2','roles','tipo'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data= request()->validate([
            'nombre' => 'min:4|max:255|required',
            'apellido' => 'min:4|max:255|required',
            'email' => 'min:4|max:255|required|email|unique:users,email,'.$id,
            'idrole' => 'required|integer:1,2,3,|not_in:0',
            'password' => ''

        ]);


        $images =  '';



        if ($request->declaracion ==="on") {
          $declaracion = true;
        }else{
          $declaracion = false;
        }



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

                                $ruta = $request->root();
                                $src = $ruta.'/'.$this->photos_path.'/'.$save_name;

                                $images = $src.','.$images;

                            }

            }


            $user = User::firstOrCreate([
             'nombre'          => $request->nombre,
             'apellido'        => $request->apellido,
             'email'           => $request->email, 
             'idrole'          => $request->idrole,
             'password'        => bcrypt($request->password),
             'active'          => 1,
             'domicilio'       => $request->domicilio,
             'departamento'    => $request->departamento,
             'ciudad'          => $request->ciudad,
             'estado'          => $request->estado,
             'codigo_postal'   => $request->codigo_postal,
             'fecha_nacimiento'=> $request->fecha_nacimiento,
             'seguro_social'   => $request->seguro_social,
             'contacto_emergencia' => $request->contacto_emergencia,
             'images'          => $images,
             'telefono'        => $request->telefono,


            ]);



            $user->save();

            session::flash('message','El usuario Fue Creado Correctamente');
            return redirect(route('usuarios.index')); 

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
                            $ruta = $request->root();
                            $src = $ruta.'/'.$this->photos_path.'/'.$save_name;

                            $images = $src.','.$images;

                        }




                        if($request->password != null){
                            $pass = bcrypt($request->password);


                            $user = User::with(['role'])->find($id);


                            $user->fill([
                             'nombre'          => $request->nombre,
                             'apellido'        => $request->apellido,
                             'idrole'          => $request->idrole,
                             'password'        => $pass,
                             'domicilio'       => $request->domicilio,
                             'departamento'    => $request->departamento,
                             'ciudad'          => $request->ciudad,
                             'estado'          => $request->estado,
                             'codigo_postal'   => $request->codigo_postal,
                             'fecha_nacimiento'=> $request->fecha_nacimiento,
                             'seguro_social'   => $request->seguro_social,
                             'contacto_emergencia' => $request->contacto_emergencia,
                             'images'          => $images,
                             'active'          => $request->estado,
                             'telefono'        => $request->telefono,


                            ]);

                            $user->save();

                            session::flash('message','El usuario Fue Actualizado Correctamente');
                            return redirect(route('usuarios.index')); 



         
                        } else {


                            $user = User::with(['role'])->find($id);


                            $user->fill([
                             'nombre'          => $request->nombre,
                             'apellido'        => $request->apellido,
                             'idrole'          => $request->idrole,
                             'domicilio'       => $request->domicilio,
                             'departamento'    => $request->departamento,
                             'ciudad'          => $request->ciudad,
                             'estado'          => $request->estado,
                             'codigo_postal'   => $request->codigo_postal,
                             'fecha_nacimiento'=> $request->fecha_nacimiento,
                             'seguro_social'   => $request->seguro_social,
                             'contacto_emergencia' => $request->contacto_emergencia,
                             'images'          => $images,
                             'active'          => $request->estado,
                             'telefono'        => $request->telefono,


                            ]);

                            $user->save();

                            session::flash('message','El usuario Fue Actualizado Correctamente');
                            return redirect(route('usuarios.index')); 
                           
                        }



                        


            }else{

                        
                        
                        if($request->password  != null){

                            $pass = bcrypt($request->password);
                            $user = User::with(['role'])->find($id);

                            $user->fill([
                             'nombre'          => $request->nombre,
                             'apellido'        => $request->apellido,
                             'idrole'          => $request->idrole,
                             'password'        => $pass,
                             'domicilio'       => $request->domicilio,
                             'departamento'    => $request->departamento,
                             'ciudad'          => $request->ciudad,
                             'estado'          => $request->estado,
                             'codigo_postal'   => $request->codigo_postal,
                             'fecha_nacimiento'=> $request->fecha_nacimiento,
                             'seguro_social'   => $request->seguro_social,
                             'contacto_emergencia' => $request->contacto_emergencia,
                             'active'          => $request->estado,
                             'telefono'        => $request->telefono,

                             

                            ]);


                            $user->save();

                            session::flash('message','El usuario Fue Actualizado Correctamente');
                            return redirect(route('usuarios.index')); 


         
                        } else {

                            $user = User::with(['role'])->find($id);

                            $user->fill([
                             'nombre'          => $request->nombre,
                             'apellido'        => $request->apellido,
                             'idrole'          => $request->idrole,
                             'domicilio'       => $request->domicilio,
                             'departamento'    => $request->departamento,
                             'ciudad'          => $request->ciudad,
                             'estado'          => $request->estado,
                             'codigo_postal'   => $request->codigo_postal,
                             'fecha_nacimiento'=> $request->fecha_nacimiento,
                             'seguro_social'   => $request->seguro_social,
                             'contacto_emergencia' => $request->contacto_emergencia,
                             'active'          => $request->estado,
                             'telefono'        => $request->telefono,

                             

                            ]);


                            $user->save();

                            session::flash('message','El usuario Fue Actualizado Correctamente');
                            return redirect(route('usuarios.index')); 
                           
                        }


            }


        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        session::flash('message','El usuario Fue Eliminado Correctamente');
        return redirect(route('usuarios.index')); 
    }



    
}
