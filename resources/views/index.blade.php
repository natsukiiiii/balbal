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
	<link rel="stylesheet" href="/css/common.css?20200227">
	<link rel="stylesheet" href="/css/top.css?200618">
	<link rel="apple-touch-icon" href="/img/top/BALBALアイコン用.jpg?20190909"/>
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191113"></script>
	
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="top" class="search">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<img class="background" src="/img/top/TOPアイキャッチ.jpg?20190902" alt="健康食品、サプリメントの商品開発をサポート原料検索サイトバルバル">
			<div class="filter"></div>
			<div class="firstViewWrap">
				<div class="mainCont">
					<h1>健康食品、サプリメントの<br class="sp">商品開発をサポート<br>原料検索サイトバルバル</h1>
					<!-- <h1>健康食品・サプリ開発に市況から原料まで掲載、商品開発をサポート原料検索サイトバルバル</h1> -->
					<!--<p class="ttl pcBlock">健康食品・サプリ開発に<br>市況から原料まで掲載、<br>商品開発をサポート原料検索サイト</p>
					<p class="ttl spBlock">健康食品・サプリ開発に<br>商品開発をサポート<br>原料検索サイト バルバル</p>-->
					<!-- <p class="img"><img src="img/top/main_photo.png" alt=""></p> -->
				</div>
				@include('inc.frontend.search_box')
			</div>
		</div>
	</div>
	<!-- // header -->

	

	<!-- contents -->
	<div class="contents">
		<div class="contentsBk">
			<div class="contentsWrap order_materialList">
				<main>
					<section class="sec">
					　　<div class="lead">
							<h2>トピック原料</h2>
						</div>
						<ul class="materialList">
							@foreach ($material_list as $material)
								<li>
									<a href="{{ url('material/detail/'.@$material->genryo_id) }}">
										<div class="productInfo">
											<div class="filter"></div>
											<div class="listTitle">&nbsp;@include('utils.data_list', ['object' => @$material, 'name' => 'seijo', 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])</div>
											<img class="background" 
												src="{{ @$material->top_pic ? url(config('app.upload_image_folder').'/'.rawurlencode(@$material->top_pic)) : '' }}"
												@if (@$material->ippan_nm != @$material->item_nm)
													alt="{{ @$material->company->kigyo_nm }}の原料{{ @$material->ippan_nm }}、商品名{{ @$material->item_nm }}"
												@else
													alt="{{ @$material->company->kigyo_nm }}の原料{{ @$material->ippan_nm }}"
												@endif
											>
											<?php
												$show_jokyo = array();
												foreach($jokyo_master_list as $jokyo_master){
													if(in_array($jokyo_master->code_nm, array('対応可', '準備中')))
														$show_jokyo[] = $jokyo_master->code;
												}
											?>
											<p class="productTitle" ><span {{ !in_array(@$material->jokyo, $show_jokyo) ? 'style=visibility:hidden' : '' }}>機能性表示対応</span></p>
											<div class="certificationMark">
												@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
													@foreach($all_ninsho_master_list_array as $ninsho_master)
														{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<img src="'.$ninsho_master['code_rnm'].'" alt="'.$ninsho_master['code_nm'].'">' : '' !!}
													@endforeach
												@endforeach
											</div>
											<p class="productName1">商品名</p>
											<p class="productName2">{{ @$material->item_nm }}</p>

											<p class="description">{{ @$material->hitokoto }}</p>
										</div>
											<p class="company">{{ @$material->company->kigyo_nm }}</p>
									</a>
								</li>
							@endforeach
						</ul>
					</section>
				</main>
			</div>

			<div class="contentsWrap order_bnr" id="contentsWrap_bgc">
				<main>
					<div class="contInner">
						<ul class="bnr">
							<li>
								<a href="{{ url('/benchmark') }}">
									<img src="/img/top/benchmark.jpg" class="contents pc-v" alt="サプルメント市販商品ベンチマーク検索" style="margin-right: 52px;">
									<img src="/img/top/benchmark_sp.png" class="contents sp-v" alt="サプルメント市販商品ベンチマーク検索">
								</a>
							</li>
							<li id="tenjikai">
								<a href="{{ url('/tenjikai') }}">
									<img src="/img/top/tenjikai_baner.jpg" class="contents pc-v" alt="展示会">
									<img src="/img/top/tenjikai_sp.png" class="contents sp-v" alt="展示会">
								</a>
							</li>
						</ul>
					</div>
				</main>
			</div>
			<div class="contentsWrap order_foodList">
			<main">
			　　<div class="lead">
					<h2>機能性表示食品新着情報</h2>
				</div>
				<ul class="foodList">
					@foreach ($function_list as $function)
						<li>
						    <p class="todokede_date">届出日 {{ $function->todokede_date }}</p>
							<p class="new_circle"><u>New</u></p>
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
				<div class="submit">
				 <p><a href="{{ url('/food') }}">機能性表示食品一覧</a></p>
			    </div>
			</main>
		</div>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	
<div class="menuOverlay"></div>
</body>
</html>