@extends('layout.main')

@section('HeadContent')
@stop

@section('BodyContent')
    <div id="permission-content"></div>
    <div id="token-content"></div>
@stop

@section('FooterContent')
    <script type="text/javaScript" src="{{ asset('js/app.js') }}"></script>
@stop
