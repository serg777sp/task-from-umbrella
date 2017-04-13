@extends('layouts.main')

@section('content')
    <div class="page-header">
        <h1>Sticky footer with fixed navbar</h1>
    </div>
    <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
    <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>
    <div class="container">
	<div class="row">
	    <div id='main-form-div'></div>
	</div>
    </div>
    <script type="text/template" id='main-form'>
	<div>
	    <label>Original url</label>
	    <input>
	</div>
    </script>
@endsection