@extends('layouts.admin')

@section('content')
	@if(session()->has('massage_text'))
		<div class="alert alert-success" role="alert">
			<p>{{ session('massage_text') }}</p>
		</div>
	@endif
	<h1>Posts</h1>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th class="col-sm-3">Photo</th>
						<th>Owner</th>
						<th>Category</th>
						<th>Title</th>
						<th>Body</th>
						<th>Go to</th>
						<th>Comments</th>
						<th>Created</th>
						<th>Updated</th>
					</tr>
				</thead>
				<tbody>
					@if($posts)
					@foreach($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>
							<div class="thumbnail">
								<a href="{{ route('admin.posts.edit', $post->id) }}"><img src="{{ ($post->photo) ? $post->photo->file : '/images/noimage.jpg'}}"></a>
							</div>
						</td>
						<td>{{ ($post->user) ? $post->user->name : 'no owner' }}</td>
						<td>{{ ($post->category) ? $post->category->name : 'no category' }}</td>
						<td>{{ $post->title }}</td>
						<td>{{ str_limit($post->body, 20) }}</td>
						<td><a href="{{ route('home.post', $post->slug) }}">View post</a></td>
						<td><a href="{{ route('admin.comments.show', $post->id) }}">View comments</a></td>
						<td>{{ $post->created_at->diffForHumans() }}</td>
						<td>{{ $post->updated_at->diffForHumans() }}</td>
					</tr>
					@endforeach
					@endif()
				</tbody>
			</table>
		</div>
	</div>
@endsection()