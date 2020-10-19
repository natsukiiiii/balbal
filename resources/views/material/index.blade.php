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
	<link rel="stylesheet" href="/css/material.css?200805">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="material" class="search">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li>{{ @$breadcrumb_text }}</li>
					</ul>
				</div>
				@include('inc.frontend.search_box')
			</div>
		</div>
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="contentsWrap">
			<main>
				<section class="sec">
					@if ($search_by_text)
						<div class="lead">
							<h1>{{ $search_by_text }}</h1>
						</div>
					@endif
					<ul class="materialList">
						@foreach ($material_list as $material)
							<li>
								<a href="{{ url('material/detail/'.@$material->genryo_id) }}">
									<div class="listTitle">&nbsp;@include('utils.data_list', ['object' => @$material, 'name' => 'seijo', 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])</div>
									<div class="productInfo">
										<div class="filter"></div>
										<img class="background" src="{{ @$material->top_pic ? url(config('app.upload_image_folder').'/'.rawurlencode(@$material->top_pic)) : '' }}"
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
										<p class="productTitle" ><span {{ !in_array(@$material->jokyo, $show_jokyo) ? 'style=visibility:hidden' : '' }}>機能性表示食品対応</span></p>
										<div class="certificationMark">
											@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
												@foreach($all_ninsho_master_list_array as $ninsho_master)
													{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<img src="'.$ninsho_master['code_rnm'].'" alt="'.$ninsho_master['code_nm'].'">' : '' !!}
												@endforeach
											@endforeach
										</div>
										<p class="productName"><span>商品名</span><br>{{ @$material->item_nm }}</p>
										@if ($material->video_iframe_src)
											<img src="/img/common/movie.png" alt="" class="video-indicator">
										@endif
									</div>
									<div class="generalInfo">
										<p class="generalName"><span>一般名</span><br>{!! nl2br(e(@$material->ippan_nm)) !!}</p>
									</div>
									<div class="descriptionInfo">
										<div>
											<span>規格成分</span>
											<p class="descriptionTitle">{!! nl2br(e(@$material->kikaku)) !!}</p>
										</div>
										<p class="description">{{ @$material->hitokoto }}</p>
										<p class="company">{{ @$material->company->kigyo_nm }}</p>
									</div>
								</a>
							</li>
						@endforeach
					</ul>
					@include('utils.frontend_pagination_nav', ['pagination_list' => $material_list])
				</section>
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