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
	<link rel="stylesheet" href="/css/food.css?200819">
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
						<li><a href="{{ url('/food') }}">機能性表示食品届出一覧</a></li>
						<li>{{ @$function->item_nm }}</li>
					</ul>
				</div>
				@if ($function)
					<div class="detailInfoPc pc">
						<div class="leftBox">
							<div class="mainTitle">
								<h1>{{ $function->item_nm }}</h1>
								<p class="deliveryDate"><span>届出日</span>{{ $function->todokede_date }}</p>
							</div>
							<!-- <p class="productName"><span>販売者名：&nbsp;&nbsp;&nbsp;&nbsp;</span>{{ $function->hanbai_nm }}</p> -->
							<p class="deliveryName"><span>届出者名：</span>{{ $function->todokede_nm }}</p>
							<ul class="group">
								@foreach ($function->kinosei_categories->pluck('kinosei_category') as $kinosei_category_name)
									<li>{{ $kinosei_category_name }}</li>
								@endforeach
							</ul>
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
				@include('inc.frontend.food_search_box')
			</div>
		</div>
	</div>
	<div class="sub-header-text pc">
		※消費者庁出典の機能性表示食品の届出情報サイトのページより当社調べにて加工掲載しています。
	</div>
	<!-- // header -->

	@if ($function)
		<!-- contents -->
		<div class="contents">
			<div class="contentsWrap">
				<main>
					<div class="mainView">
						<div class="mainViewPc pc">
							<div class="mainViewBox">
								<div class="imgArea">
									<img src="{{ isset($function->pict) && $function->pict ? url(config('app.upload_image_folder').'/'.$function->pict) : url('/img/manage/no-image.jpg') }}" alt="{{ $function->item_nm }}">
								</div>
							</div>
							<table class="dateStatus">
								@if ($function->hanbai_yotei_date)
									<tr class="sellStartDate">
										<td class="span">販売開始予定日</td>
										<td>{{ $function->hanbai_yotei_date }}</td>
									</tr>
								@endif
								@if ($function->henko_date)
									<tr class="changeDate">
										<td class="span">変更日</td>
										<td>{{ $function->henko_date }}</td>
									</tr>
								@endif
								@if ($function->tekkai_date)
									<tr class="cancelDate">
										<td class="span">撤回日</td>
										<td>{{ $function->tekkai_date }}</td>
									</tr>
								@endif
							</table>
						</div>
						<div class="mainViewSp sp">
							<div class="h1">機能性表示食品</div>
							<div class="mainViewBox">
								<p class="deliveryDate"><span>届出日</span>{{ $function->todokede_date }}</p>
								<p class="productName">{{ $function->item_nm }}</p>
								<p class="deliveryName">{{ $function->todokede_nm }}</p>
								<ul class="group">
									@foreach ($function->kinosei_categories->pluck('kinosei_category') as $kinosei_category_name)
										<li>{{ $kinosei_category_name }}</li>
									@endforeach
								</ul>
								<div class="imgArea">
									<img src="{{ isset($function->pict) && $function->pict ? url(config('app.upload_image_folder').'/'.$function->pict) : url('/img/manage/no-image.jpg') }}" alt="{{ $function->item_nm }}">
								</div>
								<table class="dateStatus">
									@if ($function->hanbai_yotei_date)
										<tr class="sellStartDate">
											<td class="span">販売開始予定日</td>
											<td>{{ $function->hanbai_yotei_date }}</td>
										</tr>
									@endif
									@if ($function->henko_date)
										<tr class="changeDate">
											<td class="span">変更日</td>
											<td>{{ $function->henko_date }}</td>
										</tr>
									@endif
									@if ($function->tekkai_date)
										<tr class="cancelDate">
											<td class="span">撤回日</td>
											<td>{{ $function->tekkai_date }}</td>
										</tr>
									@endif
								</table>
							</div>
						</div>
					</div>
					<section id="sec01" class="sec">
						<div class="secWrap">
							<dl class="txtDl">
								<dt>表示しようとする機能性</dt>
								<dd>{!! nl2br(e($function->hyoji_kinosei)) !!}</dd>
							</dl>
						</div>

						<h2>届出情報概要</h2>
						<div class="secWrap reportInfo">
							<table class="open" style="display:table">
								<tr>
									<th>届出番号</th>
									<td>{{ $function->todokede_no }}</td>
								</tr>
								<tr>
									<th>食品の区分</th>
									<td>{{ $function->shokuhin_kb }}</td>
								</tr>
								<tr>
									<th>名称</th>
									<td>{{ $function->meisho }}</td>
								</tr>
								<tr>
									<th>関与成分の含有量/日</th>
									<td>{!! nl2br(e($function->kanyo_seibun)) !!}</td>
								</tr>
								<tr>
									<th>一日の摂取目安量</th>
									<td>{!! nl2br(e($function->meyasu)) !!}</td>
								</tr>
							</table>
						</div>
						<div class="secWrap baseInfo">
							<dl class="txtDl">
								<dt>関与成分を含む原材料名</dt>
								<dd>{!! nl2br(e($function->genzairyo_nm)) !!}</dd>
							</dl>
							<dl class="txtDl">
								<dt>想定する主な対象者</dt>
								<dd>{{ $function->taisho }}</dd>
							</dl>
							<!-- <dl class="txtDl">
								<dt>安全性の評価方法</dt>
								<dd>{{ $function->hyoka }}</dd>
							</dl> -->
							<dl class="txtDl">
								<dt>生産・製造及び品質管理に関する情報</dt>
								<dd>{!! nl2br(e($function->info)) !!}</dd>
							</dl>
							<dl class="txtDl">
								<dt>機能性の評価方法</dt>
								<dd>{{ $function->hyoka_hoho }}</dd>
							</dl>
							<dl class="txtDl">
								<dt>変更履歴</dt>
								<dd>{!! nl2br(e($function->henko_rireki)) !!}</dd>
							</dl>
							<dl class="txtDl">
								<dt>届出撤回の事由</dt>
								<dd>{{ $function->tekkai_jiyu }}</dd>
							</dl>
							<dl class="txtDl">
								<dt></dt>
								<dd>
									<ul class="outsideList sepcial-out-link">
										<li>
											@if (@$function->shohi_info)
												<a class="outsideLink" href="{{ @$function->shohi_info }}" target="_blank">消費者庁届出情報詳細</a>
											@else
												<a class="outsideLink" href="https://www.caa.go.jp/policies/policy/food_labeling/foods_with_function_claims/" target="_blank">消費者庁届出情報詳細</a>
											@endif
										</li>
										@if (isset($function->hp) && $function->hp)
											<li><a class="outsideLink" href="{{ $function->hp }}" target="_blank">情報開示するウェブサイト</a></li>
										@endif
									</ul>
								</dd>
							</dl>
							<dl class="txtDl">
								<dd>
									<ul class="outsideList">
										<li>
											<a class="outsideLink" href="https://www.caa.go.jp/policies/policy/food_labeling/foods_with_function_claims/search/" target="_blank">出典：消費者庁 機能性表示食品の届出情報サイト</a>
											<p class="sepcial-link-subtext">※消費者庁出典の機能性表示食品の届出情報サイトのページより当社調べにて加工掲載しています。</p>
										</li>
									</ul>
								</dd>
							</dl>
						</div>
						@if (count($kinosei_shokuhin_list) > 0)
							<div class="secWrap functionalFoodInfo">
								<div class="functionalFoodList">
									<p class="title">関与成分から<br class="sp">機能性表示食品を見る</p>
									<ul>
										@foreach ($kinosei_shokuhin_list as $kinosei_shokuhin)
											<li><a href="/food?kanyo={{ $kinosei_shokuhin->kinosei_stg_cd }}">{{ $kinosei_shokuhin->kinosei_stg }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
						@if (count($function->kinosei_suppliers) > 0)
							<div class="secWrap sellerInfo">
								<div class="sellerList">
									<p class="title">原料から<br class="sp">メーカー、販売者一覧を見る</p>
									<ul>
										@foreach ($function->kinosei_suppliers as $kinosei_supplier)
											<li><a href="{{ $kinosei_supplier->url }}">{{ $kinosei_supplier->genryo_mei }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
					</section>

				</main>
				<aside class="pc">
					<div class="categoryList">
						<div class="categoryTitle">機能性カテゴリー</div>
						<ul>
							@foreach ($kinosei_category_master_list as $kinosei_category_master)
						      <li><a href="/food?category={{ $kinosei_category_master->kinosei_category_cd }}">{{ $kinosei_category_master->kinosei_category }}</a></li>
		                    @endforeach
						</ul>
					</div>
					@if (count($kinosei_shokuhin_list) > 0)
						<div class="functionalFoodList">
							<p class="title">関与成分から機能性表示食品を見る</p>
							<ul>
								@foreach ($kinosei_shokuhin_list as $kinosei_shokuhin)
									<li><a href="/food?kanyo={{ $kinosei_shokuhin->kinosei_stg_cd }}">{{ $kinosei_shokuhin->kinosei_stg }}</a></li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (count($function->kinosei_suppliers) > 0)
						<div class="sellerList">
							<p class="title">原料からメーカー、販売者一覧を見る</p>
							<ul>
								@foreach ($function->kinosei_suppliers as $kinosei_supplier)
									<li><a href="{{ $kinosei_supplier->url }}">{{ $kinosei_supplier->genryo_mei }}</a></li>
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