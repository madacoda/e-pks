@extends('layouts.app')

@section('title', 'E-PKS — Elektronik Pengawasan Kerja Sosial | Kejaksaan Republik Indonesia')

@section('content')
    @include('partials.news-ticker')
    @include('partials.hero')
    @include('partials.features')
    @include('partials.absensi')
    @include('partials.monitoring')
    @include('partials.terpidana')
    @include('partials.home-extra')
@endsection