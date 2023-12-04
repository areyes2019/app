<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ticket de Venta</title>

<style type="text/css">  
    *{
        font-family: sans-serif;
    }
    table{
        font-size: medium;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    h3{
        color: grey;
    }
    td{
        padding: 15px;
    }
    th{
        padding: 10px;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td>
            <center><img src="{{asset('img/logo2.png')}}" alt="" width="150"/></center>
            <center>
                @foreach ($customer as $person)
                <h3>Recibe: {{$person->name}}</h3>
                 @endforeach
                 @foreach ($quotation as $data)
                <h2 style="line-height: 2px;">Nota:{{$data->idOrder}}</h2>
                <h2 style="line-height: 15px;">Fecha:{{$data->created_at}}</h2>
                <p><br></p>
                 @endforeach
            </center>
        </td>
    </tr>

  </table>


  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th align="left">Descripción</th>
        <th>Quantity</th>
        <th>Unit Price $</th>
        <th>Total $</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($detail as $det)
        <tr>
            <td>{{$det->name}}</td>
            <td align="center">{{$det->quantity}}</td>
            <td align="center">{{$det->unit}}</td>
            <td align="center">{{$det->total}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <table width="50%" style="margin-top: 25px; float: right;">
        @foreach ($quotation as $totals)
        <tr>
            <th align="right" style="background-color: grey;">SUB_TOTAL</th>
            <td align="right">${{$totals->amount}}</td>
        </tr>
        <tr>
            <th align="right" style="background-color: grey;">IVA</th>
            <td align="right">${{$totals->tax}}</td>
        </tr>
        <tr>
            <th align="right" style="background-color: grey;">SALDO</th>
            <td align="right">${{$totals->grand_total}}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>