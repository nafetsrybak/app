@extends('layouts.blog-home')

@section('content')
    <div class="container main">
        <div class="row">
            <div class="col-md-8">
        		<!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{ $post->user->name }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{ ($post->photo) ?  $post->photo->file : $post->placeholder() }}" alt="">

                <hr>

                <!-- Post Content -->
                <p>{!! $post->body !!}</p>

                <hr>

                <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

        var disqus_config = function () {
        this.page.url = '{{ url('/post', $post->slug) }}';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '{{ '/post/' . $post->slug }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = 'https://app-test-3.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>
            Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
        </noscript>

                                    

                @if(session()->has('massage_text'))
        			<div class="alert alert-success" role="alert">
        				<p>{{ session('massage_text') }}</p>
        			</div>
        		@endif

                <!-- Blog Comments -->
                <hr>
                @if(Auth::check())

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" role="form" action="{{ route('comments.store') }}">
                    	{{ csrf_field() }}
                    		<input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                @endif

                <hr>

                <!-- Posted Comments -->

                @if($post->comments)
                	@foreach($post->comments as $comment)
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{ $comment->photo }}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $comment->author }}
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </h4>
                                <p>{{ $comment->body }}</p>
                                @if($comment->replies)
        	                        @foreach($comment->replies as $reply)
        		                        	<!-- Nested Comment -->
        		                        	<div class="media">
        		                        		<a class="pull-left" href="#">
        		                        			<img class="media-object" height="64" src="{{ $reply->photo }}" alt="">
        		                        		</a>
        		                        		<div class="media-body">
        											<h4 class="media-heading">{{ $reply->author }}
        												<small>{{ $reply->created_at->diffForHumans() }}</small>
        		                        			</h4>
        			                                <p>{{ $reply->body }}</p>
        			                            </div>
        			                        </div>
        			                		<!-- End Nested Comment -->
        		                	@endforeach
        	                	@endif()
        					    <div class="comment-reply-container">
        				        	<button class="toggle-reply btn btn-primary pull-right">Reply</button>
        				        	<div class="comment-reply col-sm-6 col-xs-9">
        				                <form method="post" action="{{ route('create.reply') }}">
        				                	<div class="form-group">
        				        				<textarea class="form-control" rows="1" name="body"></textarea>
        				    				</div>
        				    				<input type="hidden" name="comment_id" value="{{ $comment->id }}">
        				                	{{ csrf_field() }}
        				                	<!-- @csrf -->
        				                	<div class="form-group">
        				                		<button class="btn btn-info btn-lg">Submit</button>
        				                	</div>
        						        </form>
        					    	</div>
        						</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div> <!-- col-md-8 -->
            @include('includes.front_sidebar')
        </div><!-- row -->
    </div>
@endsection()

@section('scripts')
	<script type="text/javascript">
		$(".comment-reply-container .toggle-reply").click(function(){
			$(this).next().slideToggle('slow');
		});
	</script>
@endsection()