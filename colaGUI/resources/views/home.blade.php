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


                        {!! Form::open(array('url' => '/down_method ', 'action' => '', 'method'=>'post')) !!}

                        Video link:
                        <br><br>
                      {{ Form::text('link', '', array('placeholder' => 'Link del video', 'class'=>'form-control', 'required')) }}
                        <br><br>
                        {!! Form::submit('Descargar')!!}
                          <br>
                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
