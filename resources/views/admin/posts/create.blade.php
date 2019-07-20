@extends('layouts.admin');

@section('content')
	<h1>Create Post</h1>
	<div class="row">
		<form method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Title:</label>
				<input class="form-control" type="text" id="name" name="title" placeholder="Name"><br>
			</div>
			<div class="form-group">
				<label for="body">Body:</label>
				<textarea class="form-control" rows="4" id="body" name="body" placeholder="Body"></textarea><br>
			</div>
			<div class="form-group">
		      <label for="category">Category:</label>
		      <select id="category" class="form-control" name="category_id">
		        <option selected>Choose...</option>
		        @if($categories)
			        @foreach($categories as $id=>$category)
			        	<option value="{{ $id }}">{{ $category }}</option>
			        @endforeach
		        @endif
		      </select>
		    </div>
		    <div class="form-group">
				<label class="form-check-label" for="InputFile">File upload:</label>
				<input type="file" class="form-control-file-lg" name="photo_id" id="InputFile">
			</div>
			<!-- @csrf -->
			<div class="form-group">
				<button class="btn btn-info btn-lg">Create post</button>
			</div>	
		</form>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>
@endsection()