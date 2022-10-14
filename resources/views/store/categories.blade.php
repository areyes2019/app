@extends('template.store')
@section('content')
<div class="container mt-4 mb-4">
	<div class="top-ten">
		<div class="top-ten-title">
			<p></p>
			<p>{{$title}}</p>
		</div>
		<div class="row">
			@foreach ($articles as $article )
			<div class="col-md-3 col-2 p-2">
				<div class="top-ten-item">
					<a href="/shop_item/{{$article->idArticle}}"><img src="{{asset('img/front01.png')}}" class="img-fluid" alt=""></a>
					<p><a href="">{{$article->model}}</a></p>
					<p>{{$article->name}}</p>
					<p>${{$article->price}}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection