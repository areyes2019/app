<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  *{
    padding: 0px;
    margin: 0px;
  }
  body{
    background: #dfe6e9;
    font-family: sans-serif;
  }
  .container{
    background: white;
    width: 70%;
    padding: 40px;
    margin-top: 15px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 15px;
  }
  .intro{
    font-size: 25px;
  }
  .second{
    font-size: 18px;
  }
  table{
    margin-top: 15px;
  }
  table tr td{
    border: 1px solid grey;
  }
  .details{
    margin-top: 15px;
  }
  .details p{
    margin-bottom: 5px;
  }
  .details p{
    font-weight: bold;
    font-size: 18px;
  }
  
</style>
<body>
  <div class="container">
    <p class="intro">Hola:</p>
    <p class="second">Nuevo proyecto de diseño</p>
    @foreach ($mail as $data )
    <div class="details">
      <p>Modelo: {{$data->model}}</p>
      <p>Tamaño: {{$data->size}}</p>
      <img src='{{asset("/storage/prepress/".$data->color)}}' alt="">
      <p>{{$data->color}}</p>
      <p><strong>Instrucciones adicionales:</strong> Me lo envias pdf por favor</p>
    </div>
    @endforeach
    <hr>
    <hr>
  </div>
</body>
</html>