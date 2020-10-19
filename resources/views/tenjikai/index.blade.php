<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>{{ $tag_object['title'] }}</title>
	<meta name="description" content="{{ $tag_object['description'] }}" />
	<meta name="Keywords" content="{{ $tag_object['keyword'] }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/common.css?190716">
	<link rel="stylesheet" href="/css/tenjikai.css?200218">
	<!-- JS -->
	<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="food" class="search">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li>国内･海外展示会開催情報</li>
					</ul>
				</div>
				<h1>国内･海外展示会開催情報</h1>
				<div class="blueline"></div>
			</div>
		</div>
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents" id="detail">
		<div class="contentsWrap">
			<main>
				<h2>新着情報</h2>
				<ul class="foodList">
					@foreach ($posts as $post)
						<li class="{{ $post->is_kaigai ? 'kaigai' : '' }}">
							<div class="listTitle">{{ @$post->area }}</div>
							<div class="imgArea pc">
								<img src="{{ @$post->thumbnail_url ? $post->thumbnail_url : url('/img/manage/no-image.jpg') }}" alt="{{ @$post->name }}">
							</div>
							<div class="txtBox">
								<p class="itemName">
									{{ @$post->start_date }} ～ {{ @$post->end_date }}<br>
									{{ @$post->event_time }}
								</p>
								<p class="foodName">{!! nl2br(e(@$post->name)) !!}</p>
								<div class="imgArea sp">
									<img src="{{ @$post->thumbnail_url ? $post->thumbnail_url : url('/img/manage/no-image.jpg') }}" alt="{{ @$post->name }}">
								</div>
								@if (@$post->home_page || @$post->test_page)
									<div class="officeName">
										@if (@$post->home_page)
											<a target="_blank" class="button" href="{{ $post->home_page }}">公式 HP</a>
										@endif
										@if (@$post->test_page)
											<a target="_blank" class="button" href="{{ $post->test_page }}">事前登録</a>
										@endif
									</div>
								@endif
							</div>
						</li>
					@endforeach
				</ul>
				@include('utils.frontend_pagination_nav', ['pagination_list' => $posts])
			</main>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

	<!--<div class="menuOverlay"></div>-->

</body>
</html>