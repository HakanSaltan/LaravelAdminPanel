<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GorevResource;

use App\Gorevler;

class GorevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gorevler = Gorevler::orderBy('sira','asc')->orderBy('updated_at','desc')->paginate(10);

        foreach ($gorevler as $key=>$gorev){
            $gorev->sira = $key+1;
            $gorev->save();
        }
        $gorevler = Gorevler::orderBy('sira','asc')->orderBy('updated_at','desc')->paginate(10);

        return response($gorevler);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $gelenVeri = $request->all();
        $gorev = new Gorevler;
        $gorev->sira = $gelenVeri["sira"];
        $gorev->baslik = $gelenVeri["baslik"];
        $gorev->aciklama = $gelenVeri["aciklama"];
        $gorev->olusturan_id = $gelenVeri["olusturan_id"];
        $gorev->save();
        return response(["error" => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gorevler = new GorevResource(Gorevler::find($id)->get());
        return response($gorevler);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gorev)
    {
        $data = $request->all();
        $gorev = Gorevler::find($data["id"]);
        $gorev->sira = $data["sira"];
        $gorev->baslik = $data["baslik"];
        $gorev->aciklama = $data["aciklama"];
        $gorev->olusturan_id = $data["olusturan_id"];
        $gorev->durum = $data["durum"];
        $gorev->tamam = $data["tamam"];
        $gorev->save();
        return response(["error" => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gorev = Gorevler::find($id);
        $gorev->delete();
        return response(["error" => false]);
    }

    public function tumunuKaldir()
    {
        $gorev = Gorevler::where("tamam",1)->get();

        foreach($gorev as $a){
            $a->delete();
        }
        return response(["error" => false]);
    }
}
