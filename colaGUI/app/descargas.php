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
    $id= DB::table('descargas')->insertGetId($descargas);

    return $id;

}

public function showVideos($id)
{

  $videos = DB::table('descargas')->where('user_id',$id)->get();


  return $videos;

}

// public function updateState(){
//
//
//   DB::table('users')
//             ->where('id', 1)
//             ->update(array('votes' => 1));
// }



}
