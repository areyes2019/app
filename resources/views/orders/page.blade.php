@extends('template.app')
@section('content')
<div id="app">
	<order-component :supplier="'{{ $supplier_id }}'" :name="'{{ $supplier_name }}'" :slug="'{{ $slug }}'"></order-component>
</div>
@endsection