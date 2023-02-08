<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class JugadorController extends Controller
{
    public function show(){

        $jugador=DB::table('jugador')->where('estado','<>',0)->get();
        $array=['jugadores'=>$jugador];
        return \view ('jugador.jugador_listar',$array);
    }

    public function jugador_editar(Request $request){
        $jugador=DB::table('jugador as j')->select('j.*','r.monto','r.banco','r.numero_transaccion','r.fecha_recarga')
        ->leftjoin('recargas as r','r.jugador_id','=','j.jugador_id')
        ->where('j.estado','<>',0)
        ->where('j.jugador_id',$request->id)
        ->first();
        // dd($jugador);
        $recargas=DB::table('recargas')->where('recargas.jugador_id',$request->id)->get();
        $array=['jugador'=>$jugador,'recargas'=>$recargas];
        return \view ('jugador.jugador_mostrar',$array);

    }

    public function jugador_update(Request $request){
        try {
            $data = request()->except(['_token']);
            $jugador=DB::table('jugador as j')
                    ->where('j.estado','<>',0)
                    ->where('j.jugador_id',$request->jugador_id)
                    ->first();
            // $monto_total=$jugador->saldo+$request->monto;

            // ACTUALIZAMOS EL SALDO DEL JUGADOR 
            // DB::table('jugador as j')
            //         ->where('j.estado','<>',0)
            //         ->where('j.jugador_id',$request->jugador_id)
            //         ->update(['saldo'=>$monto_total]);
            $data['fecha_recarga'] = Carbon::now();
            $data['estado']=2;// esatdo 2 sin activar , estado 1 activadas
            DB::table('recargas')->where('jugador_id',$request->jugador_id)->insert($data);
            return 1;
            
        } catch (Exception $th) {
            return $th;
        }
    }

    public function jugador_aprobar(Request $request){
        try {
            $data = request()->except(['_token']);
            $jugador=DB::table('jugador as j')
                    ->where('j.estado','<>',0)
                    ->where('j.jugador_id',$request->jugador_id)
                    ->first();
            $monto_total=$jugador->saldo+$request->monto;

            // ACTUALIZAMOS EL SALDO DEL JUGADOR 
            DB::table('jugador as j')
                    ->where('j.estado','<>',0)
                    ->where('j.jugador_id',$request->jugador_id)
                    ->update(['saldo'=>$monto_total]);

            // $data['fecha_recarga'] = Carbon::now();
            // esatdo 2 sin activar , estado 1 activadas de las recargas
            DB::table('recargas')->where('recarga_id',$request->recarga_id)->update(['estado'=>1]);
            return 1;
            
        } catch (Exception $th) {
            return $th;
        }
    }


    public function recarga_actualizar(Request $request){
        try {
             
             
            DB::table('recargas')->where('recarga_id',$request->recarga_id)->update(
                ['monto'=>$request->monto,'numero_transaccion'=>$request->numero_transaccion,'banco'=>$request->banco,'medio'=>$request->medio]
            );
            return 1;
            
        } catch (Exception $th) {
            return $th;
        }
    }
}
