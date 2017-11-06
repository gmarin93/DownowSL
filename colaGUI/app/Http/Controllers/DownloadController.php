<?php

namespace App\Http\Controllers;

use App\Download;
 use Input;
 use App\descargas;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



/*/***//*/*/

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Http\Controllers\DownloadController;



class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  $this->showVideos();
    }

    public function showVideos()
    {
         $user_id= Auth::id();

         $videos = new descargas;

         $data=$videos->showVideos($user_id);


         return view('home',compact('data'));
}

public function comeBack()
{
  $user_id= Auth::id();

  $videos = new descargas;

  $data=$videos->showVideos($user_id);

  $this->insercion();
  return redirect()->action('DownloadController@showVideos');
  
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($user_id, $link, $estado)
    {


           $descargas = array('user_id' => $user_id,
           'link' => $link,
           'estado' => $estado);


           // convert the array to json
           $data = json_encode($descargas);

            $connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest', '/');
            $channel = $connection->channel();

            $channel->queue_declare('hello', false, false, false,  false);
            $msg = new AMQPMessage($data);

            $channel->basic_publish($msg, '', 'hello');
            echo "La descarga ha finalizado", "\n";
            $channel->close();
            $connection->close();


            // return redirect()->action('DownloadController@comeBack');

        }

    public function insercion()
    {

      $video = new descargas;

      $user_id = Auth::user()->id;
      $link = Input::get('link');
      $estado = false;

      if(is_null($estado))
      {
          echo "No se inserto", $estado;

      }
      else{
      $id=  $video->insercion($user_id, $link, $estado);

    //  echo "El id es: ", $id;
      }

         $this->download($user_id, $link, $estado);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
