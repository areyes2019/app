@extends('template.app')
@section('content')
	<production-component :order="'{{$order}}'"></production-component>
@endsection