@extends('template.store')
@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-8 col-12 p-3 article-img">
			<img src="{{asset('img/front01.png')}}" class="img-fluid" alt="">
		</div>
		<div class="col-md-4 col-12 p-3 article-features">
			<p>Sello de 59 x 23 mm</p>
			<p>Colop C30</p>
			<p>$250.00</p>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Magni debitis, laboriosam id quia asperiores laudantium facere magnam aspernatur, est laborum ullam repellat sequi iusto doloribus optio obcaecati distinctio ex labore.</p>
			<img src="{{asset('img/bancos.png')}}" class="img-fluid" alt="">
			<p>Es bueno que sepas</p>
			<p class="feature-icon-list"><span class="bi bi-exclamation-diamond"></span> Siempre enviaremos un diseño a tu correo para aprobación</p>
			<p class="feature-icon-list"><span class="bi bi-chat-dots"></span> Tus sellos pueden ser en cualquier idioma</p>
			<p class="feature-icon-list"><span class="bi bi-wallet2"></span> Pago 100% seguro</p>
			<p class="feature-icon-list"><span class="bi bi-hand-thumbs-up"></span> Tus sellos se fabrican hasta que tengamos tu aprobación</p>
			<p class="ink-color">Puedes escoger el color de tu preferencia</p>
			<img src="{{asset('img/colors.png')}}" class="img-fluid" alt="">
			<button class="btn rounded-0"><span class="bi bi-whatsapp"></span> Me interesa</button>
		</div>
	</div>
</div>
@endsection