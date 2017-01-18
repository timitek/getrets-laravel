@extends('GetRETS::example.layouts.getrets')

@section('title', 'Example')

@section('styles')
@include('GetRETS::example.partials.styles')
@endsection

@section('content')

@include('GetRETS::example.partials.navbar')

<div class="content container tab-content">

    @include('GetRETS::example.partials.home')

    @include('GetRETS::example.partials.searching.tab', $data)

    @include('GetRETS::example.partials.details.tab', $data)

</div><!-- /.container -->

@endsection

@section('scripts')
@include('GetRETS::example.partials.scripts')
@endsection