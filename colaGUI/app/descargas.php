<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class descargas extends Model
{
  public function insercion($user_id,$link,$estado)
{
  // Validate the request...
  $descargas = array('user_id' => $user_id,
       'link' => $link,
       'estado' => $estado);
      //var_dump($descargas);
     DB::table('descargas')->insert($descargas)->lastInsertId();

}
}
