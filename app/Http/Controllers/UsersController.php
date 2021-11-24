<?php

namespace App\Http\Controllers;


use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class UsersController extends Controller
{
    public function index(Request $request){

        $alert = $request->created;

        $showUsers = DB::table('users')
        ->selectRaw('count(idUser) as count')
        ->get();

        $totalUsers = $showUsers[0]->count;

        if ($totalUsers >= 5) {

            $userWinner = DB::table('users')
            ->select('nombre','apellido','cedula','celular','correo',
            'dep.nombres as depNombre','ciu.nombres as ciuNombre')
            ->join('departamentos as dep','dep.idDep','users.departamento')
            ->join('ciudades as ciu','ciu.idCiudad','users.ciudad')
            ->orderByRaw('rand()')
            ->limit(1)
            ->get();

        }else{
            $userWinner = DB::table('users')->get();
        }

        $departamentos = DB::table('departamentos')->get();

        return view("landing", compact('alert','totalUsers','userWinner','departamentos','showUsers'));
    }

    public function create(Request $request){

        $validacion = DB::table('users')
        ->where('cedula',$request->cedula)
        ->orWhere('correo', $request->correo)
        ->first();


        if ($validacion != null) {
            $created = 2;
        }else{

            $createUser = DB::table('users')->insert([
                'nombre'=> $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'departamento' => $request->departamentos,
                'ciudad' => $request->ciudades,
                'celular' => $request->celular,
                'correo' => $request->correo,
                'fechaHora' => date('Y-m-d H:i:s')
            ]);

            $created = 1;
        }

        return redirect()->route('index',compact('created'));

    }

    public function excel(){

        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function showCiudades(Request $request){

        $option = '<option disabled value="" selected>Seleccione...</option>';

        $ciudades = DB::table('ciudades')
        ->where('idDep',$request->idDep)
        ->get();

        foreach ($ciudades as $value) {
            $option.= '<option value="'.$value->idCiudad.'">'.$value->nombres.'</option>';
        }

        return $option;
    }
}
