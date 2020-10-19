<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>{{ $tag_object['title'] }}</title>
	<meta name="description" content="{{ $tag_object['description'] }}" />
	<meta name="Keywords" content="{{ $tag_object['keyword'] }}" />
	<link rel="canonical" href="{{ Request::fullUrl() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/common.css?190716">
	<link rel="stylesheet" href="/css/benchmark.css?190716">
	<link rel="stylesheet" href="/css/compare/style.css">
	<!-- JS -->
	<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	<script src="/js/compare/main.js"></script>
	@include('inc.head')
</head>
<body id="detail" class="search sidebar">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="detailInfoPc pc">
					<div class="leftBox">
						<div class="mainTitle">&nbsp;</div>
						<p class="productName"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>ベンチマーク比較</p>
					</div>
					<div class="rightBox">
						<div class="mail">
						<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">
								<img src="/img/material/icon_mail.svg" alt="" class="mailIcon">
								<p class="main">このページを<br>メールで共有する</p>
								<p class="sub">この原料ページを知り合いに送信、<br>同じ部署のメンバーと共有したり<br>取引先の問屋担当者に問い合わせ。</p>
								<div class="arrowIcon"><p></p></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // header -->

	<section class="cd-products-comparison-table">
		<div class="cd-products-table">
			<div class="features">
				<div class="top-info">&nbsp;</div>
				<ul class="cd-features-list">
					<li>剤型</li>
					<li>重量（粒・包）</li>
					<li>一日目安量</li>
					<li>通常価格</li>
					<li>お徳⽤価格</li>
					<li>⼀⽇単価</li>
					<li>原材料名</li>
					<li>⼀⽇有効成分量</li>
					<li>特徴</li>
				</ul>
			</div> <!-- .features -->
			
			<div class="cd-products-wrapper">
				<ul class="cd-products-columns">
					@foreach ($benchmark_list as $benchmark)
						<li class="product">
							<div class="top-info">
								<h3>{{ $benchmark->item_nm }}&nbsp;</h3>
								<p class="product-tag">
									<span style=" {{ $benchmark->shurui ? '' : 'visibility: hidden;' }}">
										@foreach($shurui_master_list as $shurui_master)
											{{ $shurui_master->code == $benchmark->shurui ? $shurui_master->code_nm : '' }}
										@endforeach
									</span>
								</p>
								<img src="{{ isset($benchmark->top_pic) && $benchmark->top_pic ? url(config('app.upload_image_folder').'/'.$benchmark->top_pic) : url('/img/manage/no-image.jpg') }}" alt="{{ $benchmark->item_nm }}">
								<p class="product-description">
									{{ $benchmark->hanbai_nm }}<br>{{ $benchmark->naiyoryo }}&nbsp;
								</p>
								<a href="{{ url('/benchmark/detail/'.$benchmark->bench_cd) }}"><div class="button">詳細を見る</div></a>
							</div> <!-- .top-info -->

							<ul class="cd-features-list">
								<li>
									@include('utils.data_list', ['object' => @$benchmark, 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
								</li>
								<li>{!! nl2br(e($benchmark->juryo)) !!}</li>
								<li>{{ $benchmark->meyasu? $benchmark->meyasu : '' }}</li>
								<li>{{ $benchmark->kn? $benchmark->kn : '' }}</li>
								<li>{{ $benchmark->sale_kn? $benchmark->sale_kn : '' }}</li>
								<li>{{ $benchmark->day_kn? $benchmark->day_kn : '' }}</li>
								<li>{!! nl2br(e($benchmark->genzairyo_nm)) !!}</li>
								<li>{!! nl2br(e($benchmark->yukoseibun)) !!}</li>
								<li>{!! nl2br(e($benchmark->tokucho)) !!}&nbsp;</li>
							</ul>
						</li> <!-- .product -->
					@endforeach
				</ul> <!-- .cd-products-columns -->
			</div> <!-- .cd-products-wrapper -->
			
			<ul class="cd-table-navigation">
				<li><a href="#0" class="prev inactive">Prev</a></li>
				<li><a href="#0" class="next">Next</a></li>
			</ul>
		</div> <!-- .cd-products-table -->
	</section> <!-- .cd-products-comparison-table -->

	<div class="our-research">
		<table>
			<col>
			<tr>
				<td style="width:20%"><当社調べ></td>
				<td><ul class="research-contents">
					<li>※本ページは商品紹介の情報提供を目的にしており、その情報の即時性や正確性を保証するものではありません。</li>
					<li>※当サイトの情報を用いて行う一切の行為について、責任を負いません。</li>
				</ul></td>
			</tr>
		</table>
		<div class="mail">
		<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">
				<img src="/img/material/icon_mail.svg" alt="" class="mailIcon">
				<p class="main">このページを<br>メールで共有する</p>
				<p class="sub">この原料ページを知り合いに送信、<br>同じ部署のメンバーと共有したり<br>取引先の問屋担当者に問い合わせ。</p>
				<div class="arrowIcon"><p></p></div>
			</a>
		</div>
	</div>

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

	<!--<div class="menuOverlay"></div>-->
</body>

<script>
	// not good solution here!
	$(function(){
		var max_height_per_rows = [];
		$(".cd-features-list").each(function() {
			$(this).children().each(function() {
				if (!max_height_per_rows[$(this).index()] || $(this).height() > max_height_per_rows[$(this).index()]) {
					max_height_per_rows[$(this).index()] = $(this).height();
				}
			});
		});
		$(".cd-features-list").each(function() {
			$(this).children().each(function() {
				$(this).height(max_height_per_rows[$(this).index()]);
			});
		});
	});
</script>

</html>