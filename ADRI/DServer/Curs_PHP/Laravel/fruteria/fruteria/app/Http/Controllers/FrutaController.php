<?php

namespace App\Http\Controllers;

use App\Models\Fruta;
use App\Models\Temporada;
use App\Models\Origen;
use Illuminate\Http\Request;

class FrutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function __construct()
    //  {
    //      $this->middleware('auth')->except(['index','show','masCara','masBarata']);
    //  }
    public function index(Request $request)
    {
        $filtroTemp = $request->get('temporada_id');
        $filtroOrig = $request->get('origen_id');
    
        if($filtroOrig && $filtroTemp){
            $frutas= Fruta::where('temporada_id', $filtroTemp)
                            ->where('origen_id', $filtroOrig)
                            ->paginate(5);

        }elseif($filtroOrig){
            $frutas = Fruta::where('origen_id',$filtroOrig)
                            ->paginate(5);
        }elseif($filtroTemp){
            $frutas = Fruta::where('temporada_id',$filtroTemp)
                            ->paginate(5);
        }else{
            $frutas= Fruta::paginate(5);
        }

        $temporadas = Temporada::all();
        $origenes = Origen::all();
        
    return view('frutas.index',compact('frutas','temporadas','origenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temporadas = Temporada::all();
        $origenes = Origen::all();
        return view('frutas.create',compact('temporadas','origenes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:2',
            'precio' => 'required|numeric|min:0',
            'temporada_id' => 'required',
        ]);


        if($request->filled('nuevo_origen')){
            $origen = Origen::create([
                'origen' => $request->get('nuevo_origen')
            ]);
            $origen_id = $origen->id;
        } else {
            $origen_id = $request->get('origen_id');
        }

        Fruta::create([
            'nombre' => $request->get('nombre'),
            'precio' => $request->get('precio'),
            'temporada_id' => $request->get('temporada_id'),
            'origen_id' => $origen_id
        ]);

        return redirect()->route('frutas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id=0)
    {
        $fruta = Fruta::findOrFail($id);
        return view('frutas.show',compact('fruta'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fruta = Fruta::findOrFail($id);
        $temporadas = Temporada::all();
        $origenes = Origen::all();
        return view('frutas.edit', compact('fruta','temporadas','origenes'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:2',
            'precio' => 'required|numeric|min:0'
        ]);

        $fruta = Fruta::findOrFail($id);

        // Reasignar datos
        $fruta->nombre = $request->get('nombre');
        $fruta->precio = $request->get('precio');
        $fruta->temporada_id = $request->get('temporada_id');

        // Comprobar origen
        if($request->filled('nuevo_origen')){
            $origen = Origen::create([
                'origen' => $request->get('nuevo_origen')
            ]);
            $fruta->origen_id = $origen->id;
        } else {
            $fruta->origen_id = $request->get('origen_id');
        }
        
        $fruta->save();

        return redirect()->route('frutas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruta $fruta)
    {
        $fruta = Fruta::findOrFail($id);
        $fruta->delete();
        return redirect()->route('frutas.index');
    }
    // Extras: Fruta más cara
    public function masCara()
    {
        $fruta = Fruta::orderBy('precio','DESC')->first();
        return view('frutas.show', compact('fruta'));
    }

    // Extras: Fruta más barata
    public function masBarata()
    {
        $fruta = Fruta::orderBy('precio','ASC')->first();
        return view('frutas.show', compact('fruta'));
    }

        // Extras: Listar origenes
    public function listarOrigenes(){
        $origenes = Origen::all();
        return view('origenes.index',compact('origenes'));
    }
}
