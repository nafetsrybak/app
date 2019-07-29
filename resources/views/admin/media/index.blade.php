@extends('layouts.admin')

@section('content')
	@if(session()->has('massage_text'))
		<div class="alert alert-success" role="alert">
			<p>{{ session('massage_text') }}</p>
		</div>
	@endif
<h1>Media</h1>
@if($photos)
<form action="{{ route('delete.media') }}" method="post" class="form-inline">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
	<div class="form-group">
		<select id="" class="form-control">
			<option>Delete</option>
		</select>
	</div>
	<div class="form-group">
		<button name="delete_all" value="Delete" class="btn btn-primary">Submit</button>
	</div>

	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th class="col-sm-2">Check all <input type="checkbox" id="options"></th>
					<th>Id</th>
					<th class="col-sm-3">Photo</th>
					<th>Created</th>
					<!-- <th>Delete</th> -->
				</tr>
			</thead>
			<tbody>
				@foreach($photos as $photo)
					<tr>
						<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $photo->id }}"></td>
						<td>{{ $photo->id }}</td>
						<td>
							<div class="thumbnail">
								<img src="{{ $photo->file }}">
							</div>
						</td>
						<td>{{ $photo->created_at->diffForHumans() }}</td>
						<td>
<!-- 							<form method="post" action="{{ route('media.destroy', $photo->id) }}">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<div class="form-group">
									<button class="btn btn-lg btn-danger">Delete</button>
								</div>
							</form> -->
<!-- 							<div class="form-group">
								<input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
								<input type="hidden" name="photo" value="{{ $photo->id }}">
							</div> -->
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</form>
@endif()
@endsection()

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#options').click(function(){
				if(this.checked){
					$('.checkBoxes').each(function(){
						this.checked = true;
					});
				}else{
					$('.checkBoxes').each(function(){
						this.checked = false;
					});
				}
			});
		});
	</script>
@endsection()