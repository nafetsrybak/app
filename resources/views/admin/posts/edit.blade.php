@extends('layouts.admin')

@section('content')
	<h1>Update Post</h1>
	<div class="row">
		<div class="col-sm-3">
			<img src="{{ ($post->photo) ? $post->photo->file : url('images/noimage.jpg') }}" class="img-responsive img-rounded">
		</div>
		<div class="col-sm-9">
			<form method="post" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="form-group">
					<label for="name">Title:</label>
					<input class="form-control" type="text" id="name" name="title" placeholder="Name" value="{{ $post->title }}"><br>
				</div>
				<div class="form-group">
					<label for="body">Body:</label>
					<textarea class="form-control" rows="4" id="body" name="body" placeholder="Body text...">{{ $post->body }}</textarea><br>
				</div>
				<div class="form-group">
			      <label for="category">Category:</label>
			      <select id="category" class="form-control" name="category_id">
			        <option selected>Choose...</option>
			        @if($categories)
			        	@if($post->category()->exists())
					        @foreach($categories as $id=>$category)
					        	@if($id == $post->category->id)
					        		<option value="{{ $id }}" selected="">{{ $category }}</option>
					        	@else
					        		<option value="{{ $id }}">{{ $category }}</option>
					        	@endif
					        @endforeach
				        @else
				        	@foreach($categories as $id=>$category)
					        		<option value="{{ $id }}">{{ $category }}</option>
					        @endforeach
					    @endif
			        @endif
			      </select>
			    </div>
			    <div class="form-group">
					<label class="form-check-label" for="InputFile">File upload:</label>
					<input type="file" class="form-control-file-lg" name="photo_id" id="InputFile">
				</div>
				<!-- @csrf -->
				<div class="form-group">
					<button class="btn btn-lg btn-info col-sm-3 col-xs-5">Update post</button>
				</div>	
			</form>
			<form method="post" action="{{ route('admin.posts.destroy', $post->id) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<div class="form-group">
					<button class="btn btn-lg btn-danger col-sm-3 col-xs-5 pull-right">Delete post</button>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>
@endsection()