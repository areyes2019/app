@extends('template.app')
@section('content')
<div class="container-fluid">
	<div class="img-banner-area">
		<div class="row">
			<div class="col-md-3">
				<img src="{{asset('img/banner_zone01.png')}}" alt="" class="img-fluid">
			</div>
			<div class="col-md-6 hook-area">
				<h4>Hook principal</h4>
				<form method="POST" action="{{route('main_upload')}}" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="file" class="form-control" name="hook">
					<input type="text" value="1" name="id" class="d-none">
					<input type="submit" class="btn btn-danger mt-1" value="Guardar">
				</form>
				<p>Tamaño adecuado de la imagen 936 x 760 px</p>
			</div>
			<div class="col-md-3">
				@foreach ($query as $main_image )
				<img src="storage/multiporpouse/{{$main_image->img01}}" alt="" class="mt-3" width="150">
				@endforeach
			</div>
		</div>
	</div>
	<div class="img-banner-area">
		<div class="row">
			<div class="col-md-3">
				<img src="{{asset('img/banner_zone02.png')}}" alt="" class="img-fluid">
			</div>
			<div class="col-md-6 hook-area">
				<h4>Hook superior</h4>
				<form method="POST" action="{{route('main_upload')}}" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="file" class="form-control" name="hook">
					<input type="text" value="2" name="id" class="d-none">
					<input type="submit" class="btn btn-danger mt-1" value="Guardar">
				</form>
				<p>Tamaño adecuado de la imagen 936 x 760 px</p>
			</div>
			<div class="col-md-3">
				@foreach ($query as $superior_image )
				<img src="storage/multiporpouse/{{$superior_image->img02}}" alt="" class="mt-3" width="150">
				@endforeach
			</div>
		</div>
	</div>
	<div class="img-banner-area">
		<div class="row">
			<div class="col-md-3">
				<img src="{{asset('img/banner_zone03.png')}}" alt="" class="img-fluid">
			</div>
			<div class="col-md-6 hook-area">
				<h4>Hook inferior</h4>
				<form method="POST" action="{{route('main_upload')}}" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="file" class="form-control" name="hook">
					<input type="text" value="3" name="id" class="d-none">
					<input type="submit" class="btn btn-danger mt-1" value="Guardar">
				</form>
				<p>Tamaño adecuado de la imagen 936 x 760 px</p>
			</div>
			<div class="col-md-3">
				@foreach ($query as $inferior_image )
				<img src="storage/multiporpouse/{{$inferior_image->img03}}" alt="" class="mt-3" width="150">
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection