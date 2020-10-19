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
	<link rel="stylesheet" href="/css/common.css?191112">
	<link rel="stylesheet" href="/css/food.css?200819">
	<!-- JS -->
	<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191113"></script>
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
						<li>{{ $tag_object['h1'] }}</li>
					</ul>
				</div>
				<h1>{{ $tag_object['h1'] }}</h1>
				<div class="sub-header-text sp">
					消費者庁出典の機能性表示食品の届出情報サイトの<br>
					ページより当社調べにて加工掲載しています。
				</div>
				@include('inc.frontend.food_search_box')
			</div>
		</div>
	</div>
	<div class="sub-header-text pc">
		※消費者庁出典の機能性表示食品の届出情報サイトのページより当社調べにて加工掲載しています。
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="contentsWrap">
			<main>
				@if ($search_by_text)
					<p class="lead">{{ $search_by_text }}</p>
				@endif
				<h2 class="sp">新着情報</h2>
				<ul class="foodList">
					@foreach ($function_list as $function)
						<li>
						    <p class="todokede_date">届出日 {{ $function->todokede_date }}</p>
							<a href="{{ url('food/detail/'.$function->kinosei_cd) }}">
								<div class="imgArea">
									<img src="{{ isset($function->pict) && $function->pict ? url(config('app.upload_image_folder').'/'.$function->pict) : url('/img/manage/no-image.jpg') }}" alt="{{ $function->item_nm }}">	
								</div>
								<p class="foodName">{{ $function->todokede_no }}</p>
								<div class="txtBox">
									<p class="itemName">関与成分</p>
									<p class="itemTxt">{!! nl2br(e($function->kanyo_seibun_nm)) !!}</p>	
								</div>
								<div class="listTitle">
									@foreach ($function->kinosei_categories->pluck('kinosei_category') as $kinosei_category_name )
										<span>{{ $kinosei_category_name }}</span>
									@endforeach
								</div>
								<div class="hover">
									<p>{{ $function->item_nm }}<br><br>{{ $function->todokede_nm }}</p>
								</div>
							</a><p class="officeName">{{ $function->todokede_nm }}</p>
						</li>
					@endforeach
				</ul>
				@include('utils.frontend_pagination_nav', ['pagination_list' => $function_list])
			</main>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

</body>
</html>