@extends('template.app')
@section('content')
<div id="app">
	<quotation-component :order="'{{$order}}'" :type="'{{$type}}'"></quotation-component>
</div>
@endsection