@extends('template.app')
@section('content')
<h2>Panel de Control</h2>
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ventas Totales</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$mes}} {{$year}}</h6>
                            <p class="card-text">Resumen de las ventas totales</p>
                            <h4>${{$sales}}</h4>
                            <a href="#" class="card-link">Ir a resumen</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Utilidades netas</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$mes}} {{$year}}</h6>
                            <p class="card-text">Utilidad que se puede disponer</p>
                            <h4>${{$profit}}</h4>
                            <a href="#" class="card-link">Ir a resumen</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Piezas vendidas</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$mes}} {{$year}}</h6>
                            <p class="card-text">Resumen de piezas vendidas</p>
                            <h4>{{$sold}}</h4>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total de Gastos</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$mes}} {{$year}}</h6>
                            <p class="card-text">Resumen total de Gastos del mes</p>
                            <h4>59</h4>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-4 p-0">
                      <div class="card-header">
                        Noviembre 2022
                      </div>
                      <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Entradas Brutas</th>
                                <td>$2,593.56</td>
                            </tr>
                            <tr>
                                <th>Gastos Totales</th>
                                <td>$593.56</td>
                            </tr>
                            <tr>
                                <th>Impuestos sobre utilidades</th>
                                <td>$2,593.56</td>
                            </tr>
                            <tr>
                                <th>Ganancias netas</th>
                                <td>$2,593.56</td>
                            </tr>
                            
                        </table>
                      </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mt-4 p-0">
                      <div class="card-header">
                        Ultimas Cotizaciones
                      </div>
                      <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>55</td>
                                    <td>Agro industrias</td>
                                    <td>5 abril 20023</td>
                                    <td>$250.00</td>
                                    <td class="d-flex justify-content-end">
                                        <button class="btn btn-danger btn-sm">Ver</button>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
@endsection