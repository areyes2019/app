@extends('template.app')
@section('content')
<div class="container-fluid">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
  		<li class="nav-item" role="presentation">
    		<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Resumen</button>
  		</li>
  		<li class="nav-item" role="presentation">
    		<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pendientes de Cobro</button>
  		</li>
  		<li class="nav-item" role="presentation">
    		<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Gastos</button>
  		</li>
  		<li class="nav-item" role="presentation">
    		<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#credit" type="button" role="tab" aria-controls="contact" aria-selected="false">Para Facturar</button>
  		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  			<div class="container mt-4">
  				<h5>Enero 2023</h5>
  				<h4>Inventario</h4>
  				<table class="table table-bordered">
  					<tr>
  						<th>Total de inventario</th>
  						<td>$985.22</td>
  					</tr>
  					<tr>
  						<th>Utilidad del Inventario</th>
  						<td>$259.00</td>
  					</tr>
  				</table>
  				<h4>General</h4>
  				<table class="table table-bordered">
  					<tr>
  						<th>Ingresos Netos</th>
  						<td>$20.000</td>
  					</tr>
  					<tr>
  						<th>Gastos totales</th>
  						<td>$456.00</td>
  					</tr>
  					<tr>
  						<th>Utilidades en Bruto</th>
  						<td>$456.00</td>
  					</tr>
  					<tr>
  						<th>Utilidades Netas</th>
  						<td>$456.00</td>
  					</tr>
  				</table>
  			</div>
  		</div>
	  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	  		
	  	</div>
	  	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	  		
	  	</div>
	  	<div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="contact-tab">
	  		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione voluptate perspiciatis ullam dolor veniam tempora itaque voluptatum quas in, dolorum incidunt officia placeat facere neque ea nesciunt sunt labore, voluptatem.</p>
	  	</div>
	</div>
</div>
@endsection