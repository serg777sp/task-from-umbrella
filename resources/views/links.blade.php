@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
	<div class="panel-heading">All links</div>
	<div class="panel-body" id="link-add-form-div">
	    <table class="table">
		<tr>
		    <th>ID</th>
		    <th>Original</th>
		    <th>Short</th>
		    <th>Created at</th>
		    <th>Will be delete</th>
		</tr>
		@foreach($links as $link)
		    <tr>
			<td>{{ $link->id }}</td>
			<td>{{ $link->original_url }}</td>
			<td>{{ url('/') }}/{{ $link->short_url }}</td>
			<td>{{ $link->created_at }}</td>
			<td>{{ \Carbon\Carbon::parse($link->created_at.' + 15 days')->diffForHumans(\Carbon\Carbon::now()) }}</td>
		    </tr>
		@endforeach
	    </table>
	</div>
    </div>
@endsection

@section('scripts')

@endsection