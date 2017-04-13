@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
	<div class="panel-heading">Adding new link</div>
	<div class="panel-body" id="link-add-form-div">
	</div>
    </div>
    @include('templates.linkForm')
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/backbone/LinkForm.js') }}"></script>
@endsection