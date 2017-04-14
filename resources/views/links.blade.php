@foreach($links as $link)
    <tr>
	<td>{{ $link->id }}</td>
	<td>{{ $link->original_url }}</td>
	<td>{{ url('/') }}/{{ $link->short_url }}</td>
	<td>{{ $link->created_at }}</td>
	<td>{{ \Carbon\Carbon::parse($link->created_at.' + 15 days')->diffForHumans(\Carbon\Carbon::now()) }}</td>
    </tr>
@endforeach
