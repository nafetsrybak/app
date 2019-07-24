@extends('layouts.admin')

@section('content')
	@if(count($comments) > 0)
		<h1>Comments</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
					<th>Post id</th>
					<th>Action</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($comments as $comment)
					<tr>
						<td>{{ $comment->id }}</td>
						<td>{{ $comment->author }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ $comment->body }}</td>
						<td><a href="{{ route('home.post', $comment->post->id) }}">{{ $comment->post->id }}</a></td>
						<td>
							@if($comment->is_active == 1)
								<form method="post" action="{{ route('admin.comments.update', $comment->id) }}">
									{{ method_field('PATCH') }}
										<input type="hidden" name="is_active" value="0"><br>
									{{ csrf_field() }}
									<!-- @csrf -->
									<div class="form-group">
										<button class="btn btn-danger btn-lg">Un-approve</button>
									</div>	
								</form>
							@else
								<form method="post" action="{{ route('admin.comments.update', $comment->id) }}">
									{{ method_field('PATCH') }}
										<input type="hidden" name="is_active" value="1"><br>
									{{ csrf_field() }}
									<!-- @csrf -->
									<div class="form-group">
										<button class="btn btn-info btn-lg">Approve</button>
									</div>	
								</form>
							@endif
						</td>
						<td>
							<form method="post" action="{{ route('admin.comments.destroy', $comment->id) }}">
									{{ method_field('DELETE') }}
									{{ csrf_field() }}
									<!-- @csrf -->
									<div class="form-group">
										<button class="btn btn-danger btn-lg">Delete</button>
									</div>	
								</form>
						</td>
					</tr>
				@endforeach()
			</tbody>
		</table>
	@else
		<h1 class="text-center">No Comments</h1>
	@endif()
@endsection()