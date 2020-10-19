<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>{{ $seibun_mei }}行の成分名を持つ原料検索・一覧【健康食品原料検索サイトバルバル】</title>
	<meta name="description" content="健康食品やサプリメントに使われる{{ $seibun_mei }}行の原料や有効成分を一覧から検索できます。五十音順で健康食品原料を探す時はまず【健康食品原料検索サイトバルバル】訴求効果、部位、用途からも原料を見つけれれます。BALBALは健康食品の商品開発担当者をサポートします！" />
	<meta name="Keywords" content="健康食品原料検索サイトバルバル,BALBAL,原料,成分名,五十音順,{{ $seibun_mei }}行,訴求効果,部位,サプリメント開発" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/common.css?190716">
	<link rel="stylesheet" href="/css/search.css">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="search" class="search">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li><a href="{{ url('/'.$type) }}">成分名から探す</a></li>
						<li>{{ $seibun_mei }}行</li>
					</ul>
				</div>
				@if ($type == 'material')
					@include('inc.frontend.search_box')
				@elseif ($type == 'benchmark')
					@include('inc.frontend.benchmark_search_box')
				@endif
			</div>
		</div>
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="contentsWrap">
			<main>
				<div class="searchSyllabaryTabs">
					<ul>
						@foreach ($seibun_mei_map_list as $key => $value)
							<li class="{{ $key == $seibun_mei ? 'active' : '' }}"><a href="{{ url('/search/'.$type.'/'.$key) }}">{{ $key }}</a></li>
						@endforeach
				</div>
				<div class="searchSyllabaryLinks">
					<ul>
						@foreach ($seibun_mei_map_list[$seibun_mei] as $sub_seibun_mei)
							<li><a href="#sec{{ $sub_seibun_mei }}">{{ $sub_seibun_mei }}</a></li>
						@endforeach
					</ul>
				</div>
				@foreach ($seibun_mei_map_list[$seibun_mei] as $sub_seibun_mei)
					<section id="sec{{ $sub_seibun_mei }}" class="sec">
						<div class="secWrap">
							<h2><span>{{ $sub_seibun_mei }}</span></h2>
							<ul class="syllabaryList">
								@foreach ($seibun_list as $seibun)
									@if ($seibun['50_order'] == $sub_seibun_mei)
										<li><a href="/{{ $type }}/?sbi={{ $seibun->seibun_cd }}" {!! $seibun->biko ? '' : 'onclick="return false;" style="color:#a9a9a9"' !!}>{{ $seibun->seibun_nm }} ({{ $seibun->biko ? $seibun->biko : 0 }})</a></li>
									@endif
								@endforeach
							</ul>
						</div>
					</section>
				@endforeach
			</main>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

	<div class="menuOverlay"></div>

</body>
</html>