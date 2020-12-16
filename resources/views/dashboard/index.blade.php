@extends('template.index')

@section('title')
    Dashboard
@endsection

@section('content')
    Selamat Datang {{ Auth::user()->username }}
@endsection