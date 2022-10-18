@extends('template.store')
<?php use App\Models\cnnxn_categorie ?>
@section('content')
<div class="container mt-4 mb-4">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
	  </ol>
	</nav>
	<div class="row">
		<div class="col-md-3 col-12">
			<div class="categories-menu">
				<span class="bi bi-list"></span>
				<p>nuestros sellos</p>
			</div>
			<ul class="categories-list p-2">
				@foreach ($parent as $parents)
				<li><a href="#{{$parents->slug}}" class="d-flex justify-content-between" data-bs-toggle="collapse">{{$parents->name}}<span class="bi bi-plus-circle-dotted"></span></a>
					<ul class="p-0 m-0 collapse" id="{{$parents->slug}}">
						<?php $query = cnnxn_categorie::where('main',$parents->idCategorie)->get()?>
						@foreach ($query as $child)
						<li class="m-0"><a href="/store_categorie/{{$child->slug}}">{{$child->name}}</a></li>
						@endforeach
					</ul>
				</li>
				@endforeach
				
				@foreach ($single as $singles)
				<li><a href="/store_categorie/{{$singles->slug}}">{{$singles->name}}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="col-md-8 col-12">
			<div class="top-ten">
				<div class="top-ten-title">
					<p></p>
					<p>{{$title}}</p>
				</div>
				<div class="row">
					@foreach ($articles as $article )
					<div class="col-md-3 col-2 p-2">
						<div class="top-ten-item">
							<a href="/shop_item/{{$article->idArticle}}"><img src="{{ asset('img_cataloge/'.$article->img_url) }}" class="img-fluid" alt=""></a>
							<p><a href="">{{$article->model}}</a></p>
							<p>{{$article->name}}</p>
							<p>${{$article->price}}</p>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection