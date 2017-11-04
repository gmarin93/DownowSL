<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Downloader</title>
  </head>
  <body>

    {!! Form::open(array('url' => '/down_method ', 'action' => '', 'method'=>'post')) !!}

    Video link:
    <br><br>
  {{ Form::text('link', '', array('placeholder' => 'Link del video', 'required')) }}
    <br><br>
    {!! Form::submit('Descargar')!!}
      <br>
    {!! Form::close() !!}

  </body>
</html>
