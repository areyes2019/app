@extends('template.app')
@section('content')
<div id="app">
	<quotation-component :id="'{{$id}}'" :slug="'{{$slug}}'" :customer="'{{$customer}}'"></quotation-component>
</div>
@endsection