@extends('template.app')
@section('content')

<pos-component :slug="'{{$slug}}'" :id="'{{$id}}'" ></pos-component>
@endsection