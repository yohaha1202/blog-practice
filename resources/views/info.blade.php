@extends('layouts.default', array('category'=>$catrgory))

@if (session('alert'))
	<script>alert('<?= session('alert');?>');</script>
@endif

@section('content')
	@if(!empty($article->previousId))
		<a href="{{ url('info/'.$article->previousId) }}" class="fh5co-post-prev"><span><i class="icon-chevron-left"></i> Prev</span></a>
	@endif
	@if(!empty($article->nextId))
	<a href="{{ url('info/'.$article->nextId) }}" class="fh5co-post-next"><span>Next <i class="icon-chevron-right"></i></span></a>
	@endif
	<!-- END #fh5co-header -->
	<div class="container-fluid">
		<div class="row fh5co-post-entry single-entry">
			<article class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<figure class="animate-box">
					<img src="{{ '/images/'.$article->photo }}" alt="Image" class="img-responsive">
				</figure>
				<span class="fh5co-meta animate-box">
					@foreach ($article->categoryAry as $categoryName)
						{{ $categoryName }}&nbsp;&nbsp;
					@endforeach
				</span>
				<h2 class="fh5co-article-title animate-box">{{ $article->title }}</h2>
				<span class="fh5co-meta fh5co-date animate-box">{{ $article->created_at }}</span>

				@if(!empty($article->tagAry))
						@foreach ($article->tagAry as $tagName)
						<span class="label-success label label-default">
							{{ $tagName }}
						</span>&nbsp;&nbsp;&nbsp;&nbsp;
					@endforeach
				@endif
				<div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-left content-article">
					<div class="row">
						<div class="col-md-12 animate-box">
							<? echo $article->short_desc;?>
						</div>
					</div>
				</div>
			</article>
		</div>

		@if(count($article->commentAry) > 0)
			<div class="block-divider"></div>

			<div class="container-fluid">
				<article class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
					@foreach ($article->commentAry as $comment)
						<ul>
							<li>
								<div>
									<cite>{{ $comment->name }}</cite>
									<span>says:</span>
								</div>
								<div><a href="javascript:void(0)">{{ $comment->created_at }}</a></div>
								<p><? echo nl2br($comment->content)?></p>
							</li>
						</ul>
						<hr>
					@endforeach
				</article>
			</div>
		@endif

		<div class="block-divider"></div>

		<article class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
			<form action="{{ url('/comment') }}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" value="{{ $article->id }}" name="id">
				<p>
					<label for="author">Name<span>*</span></label><br>
					<input id="name" name="name" type="text" value="" size="30" required="required">
				</p>
				<p>
					<label for="comment">Comment</label><br>
					<textarea id="content" name="content" cols="45" rows="8" required="required"></textarea>
				</p>
				<p>
					<input name="submit" class="btn btn-warning" type="submit" id="submit" value="送出">
				</p>
			</form>
		</article>
	</div>


@stop

