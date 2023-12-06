<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        @page {
                margin: 0cm 0cm;
            }
        .header{
            font-size: 10px;
        }
        .header table{
            padding: 5px;
            color: black;
        }
        .info{
            background-color: #53676c;
            width: 100%;
            color: white;
            font-size: 12px;
        }
        
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          font-size: 12px;
        }
        #anticipo{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
            color: blue;
        }
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
          font-size: 15px;
        }

        #customers th span{
            font-weight: bolder;
            font-size: 16px;
            color: yellow;
        }
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #aa0000;
          color: white;
        }
        .deco{
            height: 0px;
            width: 40%;
            background-color: grey;
            margin: 15px;
        }
        .cuenta{
            width: 50%;
            margin-left: 365px;
        }
        .footer{
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2cm;
            background-color: grey;
            padding: 20px;
            color: white; 
        }
    </style>
</head>
<body>
    <div class="header" style="height: 200px;">
        <table width="100%" style="padding-top: 20px;">
            <tr>
                <td style="vertical-align: top; padding: 15px;">
                    <img src="{{asset('img/logo2.png')}}" width="150">
                </td>
                <td style="vertical-align: center;" align="right">
                   <h1>
                       SOLICITUD DE DISEÑO
                   </h1>
                </td>
                
            </tr>
        </table>
    </div>
    <div class="info">
        <table width="100%" style="padding: 15px;">
            <tr>
                @foreach ($user as $users)
                <td style="vertical-align: top;">
                    <strong style="font-size: 15px;">Para: {{$users->name}} </strong>
                    <br>Correo:  {{$users->email}}
                </td>
                @endforeach
                <td style="vertical-align: top; font-size: 15px;">
                    <strong>Orden No. OT- {{$id}}</strong><br>
                    <strong>Fecha: {{$date}}</strong><br>
                    
                </td>                
                <td style="vertical-align: top;">
                    <strong>Valor total del proyecto:</strong><br>
                    <span style="font-weight: bolder; font-size: 35px;">${{$cost}}</span>
                    <br>
                </td>
            </tr>
        </table>
    </div>
    <div class="resumen" style="margin-top: 10px; padding: 15px;">
        <table id="customers">
            <tr>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Tamaño</th>
                <th>Boceto</th>
            </tr>
            @foreach ($datos as $data )
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->model}}</td>
                <td>{{$data->size}}</td>
                <td>
                    <img src="{{public_path('/img/bancos.png')}}" width="200">
                </td>
            </tr>
            @endforeach
        </table>
    </div>   
    <div class="footer">
        <center><p>Copyright México 2022</p></center>
        <center><p>Cotización expresada en pesos Mexicanos. Esta cotización estará vigente durante 30 días naturales. Los precios pueden sufrir modificaciones sin previo aviso</p></center>
        <center>ventas@sellospronto.com.mx</center>
    </div>
</body>
</html>