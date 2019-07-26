@extends('layouts.admin')

@section('content')
	@if(count($replies) > 0)
		<h1>Replies</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Id</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
					<th>Post</th>
					<th>Action</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($replies as $reply)
					<tr>
						<td>{{ $reply->id }}</td>
						<td>{{ $reply->author }}</td>
						<td>{{ $reply->email }}</td>
						<td>{{ $reply->body }}</td>
						<td><a href="{{ route('home.post', $reply->comment->post->slug) }}">{{ $reply->comment->post->id }}</a></td>
						<td>
							@if($reply->is_active == 1)
								<form method="post" action="{{ route('replies.update', $reply->id) }}">
									{{ method_field('PATCH') }}
										<input type="hidden" name="is_active" value="0"><br>
									{{ csrf_field() }}
									<!-- @csrf -->
									<div class="form-group">
										<button class="btn btn-danger btn-lg">Un-approve</button>
									</div>	
								</form>
							@else
								<form method="post" action="{{ route('replies.update', $reply->id) }}">
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
							<form method="post" action="{{ route('replies.destroy', $reply->id) }}">
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
		<h1 class="text-center">No Replies</h1>
	@endif()
@endsection()