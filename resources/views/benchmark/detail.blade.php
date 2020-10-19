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
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/common.css?190716">
	<link rel="stylesheet" href="/css/benchmark.css?190716">
	<!-- JS -->
	<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="detail" class="search sidebar">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li><a href="{{ url('/benchmark') }}">サプリメント市販商品一覧</a></li>
						<li>{{ @$benchmark->item_nm }}</li>
					</ul>
				</div>
				@if ($benchmark)
					<div class="detailInfoPc pc">
						<div class="leftBox">
							<div class="mainTitle">
								@if($benchmark->shurui)
									<div class="group01">
										@foreach($shurui_master_list as $shurui_master)
											{{ $shurui_master->code == $benchmark->shurui ? $shurui_master->code_nm : '' }}
										@endforeach
									</div>
								@endif
								<p class="deliveryDate"><span>掲載⽇</span>{{ $benchmark->keisai_date }}</p>
							</div>
							<p class="productName"><span>商品名：&nbsp;&nbsp;&nbsp;&nbsp;</span>{{ $benchmark->item_nm }}</p>
							<p class="deliveryName"><span>販売者名：</span>{{ $benchmark->hanbai_nm }}</p>
							
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
				@endif
				@include('inc.frontend.benchmark_search_box')
			</div>
		</div>
	</div>
	<!-- // header -->

	@if ($benchmark)
		<!-- contents -->
		<div class="contents">
			<div class="contentsWrap">
				<main>
					<div class="mainView">
						<div class="mainViewPc pc">
							<div class="group02">
								@include('utils.data_list', ['object' => @$benchmark, 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
							</div>
							<div class="mainViewBox">
								<div class="imgArea">
									<img src="{{ isset($benchmark->top_pic) && $benchmark->top_pic ? url(config('app.upload_image_folder').'/'.$benchmark->top_pic) : url('/img/manage/no-image.jpg') }}" alt="{{ $benchmark->item_nm }}">
								</div>
							</div>
							
						</div>
						<div class="mainViewSp sp">
							<div class="h1">サプリメント市販商品一覧</div>
							@if($benchmark->shurui)
								<div class="group01">
									@foreach($shurui_master_list as $shurui_master)
										{{ $shurui_master->code == $benchmark->shurui ? $shurui_master->code_nm : '' }}
									@endforeach
								</div>
							@endif
							<div class="mainViewBox">
								<p class="deliveryDate"><span>掲載⽇</span>{{ $benchmark->keisai_date }}</p>
								<p class="productName">{{ $benchmark->item_nm }}</p>
								<p class="deliveryName">{{ $benchmark->hanbai_nm }}</p>
								
								<div class="imgArea">
									<img src="{{ isset($benchmark->top_pic) && $benchmark->top_pic ? url(config('app.upload_image_folder').'/'.$benchmark->top_pic) : url('/img/manage/no-image.jpg') }}" alt="{{ $benchmark->item_nm }}">
								</div>
								<div class="group02">
									@include('utils.data_list', ['object' => @$benchmark, 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
								</div>
							</div>
						</div>
					</div>
					<section id="sec01" class="sec">
						<div class="secWrap reportInfo">
							<table class="open" style="display:table">
								<tr>
									<th>商品名</th>
									<td>{{ $benchmark->item_nm }}</td>
								</tr>
								<tr>
									<th>販売者名</th>
									<td>{{ $benchmark->hanbai_nm }}</td>
								</tr>
								<tr>
									<th>剤型</th>
									<td>
										@include('utils.data_list', ['object' => @$benchmark, 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
									</td>
								</tr>
								<tr>
									<th>重量</th>
									<td>{!! nl2br(e($benchmark->juryo)) !!}</td>
								</tr>
								<tr>
									<th>内容量</th>
									<td>{!! nl2br(e($benchmark->naiyoryo)) !!}</td>
								</tr>
							</table>
						</div>
						<div class="secWrap baseInfo">
							<dl class="txtDl">
								<dt>原材料名</dt>
								<dd>{!! nl2br(e($benchmark->genzairyo_nm)) !!}</dd>
							</dl>
							<dl class="txtDl">
								<dt>⼀⽇有効成分量 </dt>
								<dd>{!! nl2br(e($benchmark->yukoseibun)) !!}</dd>
							</dl>
						</div>
						<div class="secWrap reportInfo">
							<table class="open" style="display:table">
								<tr>
									<th>⼀⽇⽬安量</th>
									<td>{{ $benchmark->meyasu? $benchmark->meyasu : '' }}</td>
								</tr>
								<tr>
									<th>通常価格</th>
									<td>{{ $benchmark->kn? $benchmark->kn : '' }}</td>
								</tr>
								<tr>
									<th>お徳⽤価格</th>
									<td>{{ $benchmark->sale_kn? $benchmark->sale_kn : '' }}</td>
								</tr>
								<tr>
									<th>⼀⽇単価</th>
									<td>{{ $benchmark->day_kn? $benchmark->day_kn : '' }}</td>
								</tr>
								<tr>
									<th colspan="2">
										<a class="outsideLink" href="{{ $benchmark->site }}" target="_blank">関連サイト 外部リンク</a>
									</th>
								</tr>
							</table>
						</div>
						<div class="secWrap baseInfo">
							<dl class="txtDl">
								<dt>特徴</dt>
								<dd>{!! nl2br(e($benchmark->tokucho)) !!}</dd>
							</dl>
						</div>
						@if (count($benchmark_genryo_list) > 0)
							<div class="secWrap functionalFoodInfo">
								<div class="functionalFoodList">
									<p class="title">原料から<br class="sp">商品を⾒る</p>
									<ul>
										@foreach ($benchmark_genryo_list as $benchmark_genryo)
											<li><a href="/benchmark?genryo={{ $benchmark_genryo->seibun_cd }}">{{ $benchmark_genryo->seibun_nm }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
						@if (count($benchmark->benchmark_suppliers) > 0)
							<div class="secWrap sellerInfo">
								<div class="sellerList">
									<p class="title">原料からメーカー、<br class="sp">販売者一覧を見る</p>
									<ul>
										@foreach ($benchmark->benchmark_suppliers as $benchmark_supplier)
											<li><a href="{{ $benchmark_supplier->url }}">{{ $benchmark_supplier->genryo_mei }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
					</section>

				</main>
				<aside class="pc detail">
					<div class="categoryList">
						<div class="categoryTitle">機能性カテゴリー</div>
						<ul style="background-color: #fff;">
							<!-- @foreach ($benchmark->mokuteki_categories1 as $mokuteki_category)
								<li><a href="/benchmark?category={{ $mokuteki_category->mokuteki_cate_cd }}">{{ $mokuteki_category->mokuteki_cate_nm }}</a></li>
							@endforeach -->
							@foreach ($mokuteki_cate_master_list as $mokuteki_cate_master)
						<li>
							<a href="/benchmark/?category={{ $mokuteki_cate_master->mokuteki_cate_cd }}">{{ $mokuteki_cate_master->mokuteki_cate_nm }}</a>
						</li>
					@endforeach
						</ul>
					</div>
					@if (count($benchmark_genryo_list) > 0)
						<div class="functionalFoodList">
							<p class="title">原料から商品を⾒る</p>
							<ul>
								@foreach ($benchmark_genryo_list as $benchmark_genryo)
									<li><a href="/benchmark?genryo={{ $benchmark_genryo->seibun_cd }}">{{ $benchmark_genryo->seibun_nm }}</a></li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (count($benchmark->benchmark_suppliers) > 0)
						<div class="sellerList">
							<p class="title">原料からメーカー、販売者一覧を見る</p>
							<ul>
								@foreach ($benchmark->benchmark_suppliers as $benchmark_supplier)
									<li><a href="{{ $benchmark_supplier->url }}">{{ $benchmark_supplier->genryo_mei }}</a></li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="mail">
					<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">
							<img src="/img/material/icon_mail.svg" alt="" class="mailIcon">
							<p class="main">このページを<br>メールで共有する</p>
							<p class="sub">この原料ページを知り合いに送信、<br>同じ部署のメンバーと共有したり<br>取引先の問屋担当者に問い合わせ。</p>
							<div class="arrowIcon"><p></p></div>
						</a>
					</div>
				</aside>
			</div>
		</div>
		<!-- // contents -->
	@endif

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	<div class="menuOverlay"></div>

	<!--<div class="menuOverlay"></div>-->

	<script>
		// $(function(){

		// 	//====================================================================================================
		// 	//	機能	：続きを読むボタン
		// 	//	説明	：続きを読むボタンを押下時、テキストエリアを表示させる
		// 	//====================================================================================================

		// 	$('.reportInfo .btnRead').click(function(){
		// 		if($('.reportInfo table').hasClass('open')){
		// 			$(".reportInfo table").removeClass('open');
		// 			$(".reportInfo").animate({ padding: "48px 20px 0"}, 500 );
		// 			$(".reportInfo table").slideUp(500);
		// 		} else {
		// 			$(".reportInfo table").addClass('open');
		// 			$(".reportInfo").animate({ padding: "48px 20px 35px"}, 500 );
		// 			$(".reportInfo table").slideDown(500);
		// 		}
		// 	});

		// });
	</script>

</body>
</html>