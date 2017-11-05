<?php

namespace App\Http\Controllers;

use App\Download;
 use Input;
 use App\descargas;

use Illuminate\Support\Facades\Auth;



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
  return view('welcome');
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

            $channel->queue_declare('hello', false, false, false, false);
            $msg = new AMQPMessage($data);

            $channel->basic_publish($msg, '', 'hello');
            echo "La descarga ha finalizado", "\n";
            $channel->close();
            $connection->close();


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
        $video->insercion($user_id, $link, $estado);
      }

         $this->download($user_id, $link, $estado);


  return view('home');


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
