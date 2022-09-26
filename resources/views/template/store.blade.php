<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sello Pronto</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">	
	<link rel="stylesheet" href="{{asset('css/store.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">	
</head>
<body>
	<div class="top-header">
		<div class="container">
			<p>Bienvenidos a la tienda de sellos más grande de México</p>
			<p><span class="bi bi-truck"></span>Envíos a todo México</p>
			<p><span class="bi bi-box-seam"></span>Mas de 300 productos en catálogo</p>
			<p><span class="bi bi-wallet2"></span>Multiples métodos de pago</p>
		</div>
	</div>
	<div class="top-header-mobile">
		<p>Bienvendios a la tinda de sellos mas grande de México</p>
		<p>vetnas@sellopronto.com.mx</p>
	</div>
	<div class="container">
		<div class="top-menu">
			<div class="row m-0 p-0">
				<div class="col-md-5">
					<div class="store-logo">
						<a href="{{url('/')}}"><img src="img/logoweb.png" alt=""></a>
					</div>
				</div>
				<div class="col-md-7 side-menu">
					<div class="menu-link">
						<a href="">Nosotros</a>
						<a href="">Contacto</a>
						<a href="">Políticas</a>
						<a href="">Envíos</a>
					</div>
					<div class="support">
						<span class="bi bi-headset"></span>
						<div class="support-text">
							<p>Atencion personal</p>
							<p>WhatsApp 461 358 1090</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="app">
		@yield('content')
	</div>
	<div class="footer">
		<div class="row p-0 m-0">
			<div class="col-md-3 footer-section">
				<p>Categorias</p>
				<ul>
					<li><a href=""><span class="bi bi-arrow-right-circle"></span> Sellos para tela</a></li>
					<li><a href=""><span class="bi bi-arrow-right-circle"></span> Sellos para doctores</a></li>
					<li><a href=""><span class="bi bi-arrow-right-circle"></span> Sellos para doctores</a></li>
					<li><a href=""><span class="bi bi-arrow-right-circle"></span> Sellos para Tela</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-section">
				<p>Nosotros</p>
				<ul>
					<li><a href="">Contacto</a></li>
					<li><a href="">Nosotros</a></li>
					<li><a href="">Politicas</a></li>
					<li><a href="">Envíos</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-section">
				<p class="payment">Metodos de pago</p>
				<img src="img/oxxopagos.png" class="img-fluid" alt="">
				<p class="payment">Si eres empresa y requires un estado de cuenta o clave interbancaria, con gusto te la enviamos</p>
			</div>
			<div class="col-md-3 footer-section m-0">
				<img src="img/promesa.png" class="img-fluid" alt="">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>