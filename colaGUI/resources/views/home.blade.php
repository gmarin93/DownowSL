  @extends('layouts.app')

  @section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Dashboard</div>

                  <div class="panel-body">
                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}

                          </div>
                      @endif

                      @if (Auth::guest())
    <h1>Bienvenido, inicia tu sesion o regìstrate para continuar descargando!</h1>
  @else
  {!! Form::open(array('url' => '/down_method ', 'action' => '', 'method'=>'post')) !!}

  Pega el:
  <br><br>
  {{ Form::text('link', '', array('placeholder' => 'Link del video', 'class'=>'form-control', 'required')) }}
  <br><br>
  {!! Form::submit('Descargar')!!}
    <br>
  {!! Form::close() !!}

  {!! Form::open(array('url' => '/down_method ', 'action' => '', 'method'=>'post')) !!}

  @endif



                          <br>
                          <table class="table table-bordered">
        <thead>
            <tr>
                <th> User_id</th>
                <th> Link</th>
                <th> Estado </th>

            </tr>
        </thead>
        <tbody>
             @foreach($data as $data_user)
              <tr>
                  <td> {{$data_user->user_id}} </td>
                  <td> {{$data_user->link}} </td>
                  <td> {{$data_user->estado}} </td>

              </tr>
             @endforeach
       </tbody>
    </table>
                          {!! Form::close() !!}


                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection
