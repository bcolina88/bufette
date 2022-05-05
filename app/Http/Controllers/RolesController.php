<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Permiso;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
     
        $roles = Role::search($request->get('search'))->orderBy('id','DESC')->paginate(25);

      
        return view('roles.listado', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
        $permissions = Permiso::where('idrol', 1)->with('maestro')->get();
        $role='';

        $tipo="crear";


        return view('roles.crear',compact('role','tipo','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->tipo==="crear") {
          
    


                $data = [
                    'tipo'     => $request->name,
                ];

                $role = Role::create($data);


                $permissions = $request->permissions;



                foreach ($permissions as $key => $item) {

                    $permisoItems = new Permiso;
                  
                    $permisoItems->idrol      = $role->id;
                    $permisoItems->idmaestro  = $item['maestro']['id'];
                    $permisoItems->agregar     = $item['agregar'];
                    $permisoItems->editar      = $item['editar'];
                    $permisoItems->ver         = $item['ver'];
                    $permisoItems->inhabilitar = $item['inhabilitar'];
                    $permisoItems->borrar      = $item['borrar'];
                    $permisoItems->save();
                  
                }


                return json_encode('creado');


        }else{



            $permissions =  $request->permissions;

            foreach ($permissions as $key => $item){
               $pp = $item['idrol'];
            }
            


            $role = Role::where('id', $pp)->first();
            $role->tipo = $request->name;
            $role->save();


           


            $permisoRole = Permiso::where('idrol','=', $pp)->get();


            foreach ($permisoRole as $key => $item) {
                Permiso::destroy($item['id']);
            }


            foreach ($permissions as $key => $item) {

                $permisoItems = new Permiso;
              
                $permisoItems->idrol     = $role->id;
                $permisoItems->idmaestro  = $item['maestro']['id'];
                $permisoItems->agregar     = $item['agregar'];
                $permisoItems->editar      = $item['editar'];
                $permisoItems->ver         = $item['ver'];
                $permisoItems->inhabilitar = $item['inhabilitar'];
                $permisoItems->borrar      = $item['borrar'];
                $permisoItems->save();
            
            }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
      
        $role = Role::find($id);


        $tipo="editar";


      
        return view('roles.editar', compact('tipo','role'));
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
      

        $data = request()->validate([
            
            'tipo' => '',
            
        ]);

        $role = Role::find($id);
        $role->update($data);


        session::flash('message','El Rol Fue actualizado Correctamente');

        //$boxes = boxe::find($id);

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Role::destroy($id);


        if( $role = Role::findOrFail($id) ) {
            
            $permisos = Permiso::where('idrol',$id)->get();

            foreach ($permisos as $key => $item) {

                Permiso::destroy($item['id']);  
            }

            Role::destroy($id);
            session::flash('message','El Rol Fue Eliminado Correctamente');
            return redirect(route('roles.index')); 
 

        }

        return null;
       
    }


    static function ver($id)
    {
        
        $Permiso = Permiso::where('idmaestro', $id)->where('idrol', Auth::user()->idrole)->first();

        if ($Permiso->ver === 1) {
            return true;
        }else{
            return false;
        }

    }


    static function agregar($id)
    {
        
        $Permiso = Permiso::where('idmaestro', $id)->where('idrol', Auth::user()->idrole)->first();

        if ($Permiso->agregar === 1) {
            return true;
        }else{
            return false;
        }

    }


    static function editar($id)
    {
        
        $Permiso = Permiso::where('idmaestro', $id)->where('idrol', Auth::user()->idrole)->first();

        if ($Permiso->editar === 1) {
            return true;
        }else{
            return false;
        }

    }


    static function borrar($id)
    {
        
        $Permiso = Permiso::where('idmaestro', $id)->where('idrol', Auth::user()->idrole)->first();

        if ($Permiso->borrar === 1) {
            return true;
        }else{
            return false;
        }

    }



}
