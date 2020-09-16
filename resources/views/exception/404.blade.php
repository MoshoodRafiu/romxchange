@extends('layouts.user')


@section('content')
    <section class="text-center" id="portfolio">
        <h1 class="mt-5" style="font-size: 70px; font-family: sans-serif">404</h1>
        <p>Oops! Looks like the link was invalid, page not found</p>
        <a href="{{ route('home') }}" class="btn btn-special">Back To Home</a>
    </section>
@endsection
