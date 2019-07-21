@extends('layouts.admin')

@section('content')
	@if(session()->has('massage_text'))
		<div class="alert alert-success" role="alert">
			<p>{{ session('massage_text') }}</p>
		</div>
	@endif
<h1>Media</h1>
@if($photos)
<div class="row">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th class="col-sm-3">Photo</th>
				<th>Created</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach($photos as $photo)
				<tr>
					<td>{{ $photo->id }}</td>
					<td>
						<div class="thumbnail">
							<img src="{{ $photo->file }}">
						</div>
					</td>
					<td>{{ $photo->created_at->diffForHumans() }}</td>
					<td>
						<form method="post" action="{{ route('admin.media.destroy', $photo->id) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<div class="form-group">
								<button class="btn btn-lg btn-danger">Delete</button>
							</div>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif()
@endsection()