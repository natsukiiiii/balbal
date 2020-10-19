<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>{{ $tag_object['title'] }}</title>
	<meta name="description" content="{{ $tag_object['description'] }}" />
	<meta name="Keywords" content="{{ $tag_object['keyword'] }}" />
	<link rel="canonical" href="{{ Request::fullUrl() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@if (!$material)
		<meta name="robots" content="noindex">
	@endif
	<!-- CSS -->
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/common.css?200403">
	<link rel="stylesheet" href="/css/material.css?200727">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js?200228"></script>
	@include('inc.head')
</head>

<body id="detail">

	@if ($material)
	<!-- header -->
	<div class="header">
		<div class="filter"></div>
		<img class="background" src="{{ url(config('app.upload_image_folder').'/'.rawurlencode(@$material->top_pic)) }}"
			@if (@$material->ippan_nm != @$material->item_nm)
				alt="{{ @$material->company->kigyo_nm }}の原料{{ @$material->ippan_nm }}、商品名{{ @$material->item_nm }}"
			@else
				alt="{{ @$material->company->kigyo_nm }}の原料{{ @$material->ippan_nm }}"
			@endif
		>
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li><a href="{{ $material_last_search_url }}">{{ $search_from_breadcrumb_text }}</a></li>
						<li>{{ @$material->item_nm }}</li>
					</ul>
				</div>
				<div class="detailInfoPc pc">
					<div class="leftBox">
						<p class="group">
							@if(count($material->seijo) > 0)
								<span class="group01">
									@include('utils.data_list', ['object' => @$material, 'name' => 'seijo', 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
								</span>
							@endif
							@foreach ($jokyo_master_list as $jokyo_master)
								@if ($jokyo_master->code == $material->jokyo && in_array($jokyo_master->code_nm, array('対応可', '準備中')))
									<span class="group02">機能性表示食品対応</span>
								@endif
							@endforeach
						</p>
						<p class="generalName"><span>商品名：</span>{{ $material->item_nm }}</p>
						<h1 class="productName">{{ $material->hitokoto }}</h1>
						<table>
							<tr>
								<th>区分</th>
								<td>
									@include('utils.data_list', ['object' => @$material, 'name' => 'kubun', 'master_obj_list' => $kubun_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
								</td>
								<td rowspan="2" style="position:relative">
									<div class="certificationMark">
										@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
											@foreach($all_ninsho_master_list_array as $ninsho_master)
												{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<img src="'.$ninsho_master['code_rnm'].'" alt="'.$ninsho_master['code_nm'].'">' : '' !!}
											@endforeach
										@endforeach
									</div>
								</td>
							</tr>
							<tr>
								<th>ペット向け</th>
								<td>
									@include('utils.data_list', ['object' => @$material, 'name' => 'pet', 'master_obj_list' => $pet_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
								</td>
							</tr>
							<tr>
								<th>海外使用実績</th>
								<td colspan="2">
									@include('utils.data_list', ['object' => @$material, 'name' => 'kaigai', 'master_obj_list' => $kaigai_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
								</td>
							</tr>
						</table>
					</div>
					<div class="rightBox">
						<div class="mail">
							<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">
								<img src="/img/material/icon_mail.svg" alt="" class="mailIcon">
								<p class="main">このページを<br>メールで共有する</p>
								<p class="sub">この原料ページを知り合いに送信、<br>同じ部署のメンバーと共有したり<br>取引先の問屋担当者に問い合わせ。</p>
								<div class="arrowIcon">
									<p></p>
								</div>
							</a>
						</div>
						<div class="seller">
							<p class="name">
								<span>{{ $material->hanbai_shutai_name }}</span><br>
								{{ @$material->company->kigyo_nm }}
							</p>
							<p class="tel">TEL:{{ @$material->company->tel }}</p>
						</div>
					</div>
				</div>
				<div class="detailInfoSp sp">
					<p class="group">
						@if(count($material->seijo) > 0)
							<span class="group01">
								@include('utils.data_list', ['object' => @$material, 'name' => 'seijo', 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
							</span>
							@foreach ($jokyo_master_list as $jokyo_master)
								@if ($jokyo_master->code == $material->jokyo && in_array($jokyo_master->code_nm, array('対応可', '準備中')))
									<span class="group02">機能性表示食品対応</span>
								@endif
							@endforeach
						@endif
					</p>
					<h1 class="productName"><span>商品名：</span>{{ $material->item_nm }}</h1>
					<div class="mail">
						<div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url="{{ url()->full() }}" data-color="default" data-size="small" data-count="false" style="display: none;"></div>
						<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
						<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">メールで送る</a>
						@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
							@foreach($all_ninsho_master_list_array as $ninsho_master)
								{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<img class="certmark" src="'.$ninsho_master['code_rnm'].'" alt="">' : '' !!}
							@endforeach
						@endforeach
					</div>
					<p class="generalName">{{ $material->hitokoto }}</p>
					<div class="seller">
						<p class="name"><span>販売者</span><br>{{ @$material->company->kigyo_nm }}</p>
					</div>
					<table>
						<tr>
							<th>区分</th>
							<td>
								@include('utils.data_list', ['object' => @$material, 'name' => 'kubun', 'master_obj_list' => $kubun_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
							</td>
						</tr>
						<tr>
							<th>ペット向け</th>
							<td>
								@include('utils.data_list', ['object' => @$material, 'name' => 'pet', 'master_obj_list' => $pet_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
							</td>
						</tr>
						<tr>
							<th>海外使用実績</th>
							<td>
								@include('utils.data_list', ['object' => @$material, 'name' => 'kaigai', 'master_obj_list' => $kaigai_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
							</td>
						</tr>
					</table>
			</div>
			</div>
		</div>
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="contentsWrap">
		    <div class="bar_follow">当ページ記載の情報は効果効能を標榜するものではありません。消費者向け製品への表示は各種法令を遵守願います。</div>
			<main>
				<section id="sec01" class="sec">
					@if(count($material->sokyu_categories)>0)
					<div class="secWrap">
						<h2>期待できる機能性</h2>
						<ul class="effectList">
							<?php
								$show_cat1 = [];
								$show_cat2 = [];
							foreach ($material->sokyu_categories as $sokyu_category) {
								if (!in_array($sokyu_category->sokyu_cate, $show_cat1)) {
									echo '<li><span>' . $sokyu_category->sokyu_cate->sokyu_cate_nm . '</span></li>';
										$show_cat1[] = $sokyu_category->sokyu_cate;							
									}
								if ($sokyu_category->sokyu_cate2 && !in_array($sokyu_category->sokyu_cate2, $show_cat2) && trim($sokyu_category->sokyu_cate2->sokyu_cate2_nm, 'その他')) {
									echo '<li><span>' . $sokyu_category->sokyu_cate2->sokyu_cate2_nm . '</span></li>';
										$show_cat2[] = $sokyu_category->sokyu_cate2;							
									}
								if ($sokyu_category->sokyu_cate3) {
									echo '<li><span>' . $sokyu_category->sokyu_cate3->sokyu_cate3_nm . '</span></li>';
									}
								}
							?>
						</ul>
					</div>
					@endif

					@if($material->shokuten)
						<div class="secWrap">
							<h2>食添、食添製剤での用途</h2>
							<ul class="useList">
								@foreach($shokuten_master_list as $shokuten_master)
									{!! in_array($shokuten_master->yoto_cate_cd , $material->shokuten) ? '<li><span>'.$shokuten_master->yoto_cate_nm.'</span></li>' : '' !!}
								@endforeach
							</ul>
						</div>
					@endif

					@if ($material->video_iframe_src)
						<div class="vimeo-sec pc">
							<div class="left-tag">動画</div>
							<h2 class="title">{{ $material->video_title }}</h2>
							<div class="video-sub-title-wrap">
								<div class="video-sub-title">{{ $material->video_note }}</div>
							</div>
							<div class="cols">
								<div class="left">
									<div class="main-video-text-upper">
										<div class="video-duration">{{ $material->video_duration }}</div>
										<div class="vimeo-icon">
											<img src="/img/common/vimeo_icon_white_on_blue_rounded.png" alt="vimeo">
										</div>
									</div>
									<div class="main-video-text">{!! nl2br(e(@$material->video_text_content)) !!}</div>
									@if ($material->video_get_password_url)
										<a href="{{ url('/material/genryo_video_key_request?mid='.@$material->genryo_id) }}" class="video-contact-btn">パスワード申請フォーム</a>
									@endif
								</div>
								<div class="right">
									<div class="vimeo-container">
										<iframe src="{{ $material->video_iframe_src }}" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						<div class="vimeo-sp sp">
							<div class="sec-title"><img src="/img/common/vimeo_icon_white_on_blue_rounded.png" alt="vimeo">商品動画</div>
							<div class="vimeo-container">
								<iframe src="{{ $material->video_iframe_src }}" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
							</div>
							<div class="vimeo-sp-content">
								<div class="video-duration">{{ $material->video_duration }}</div>
								<h2 class="title">{{ $material->video_title }}</h2>
								<div class="main-video-text">{!! nl2br(e(@$material->video_text_content)) !!}</div>
								<div class="video-sub-title">{{ $material->video_note }}</div>
								@if ($material->video_get_password_url)
									<a href="{{ url('/material/genryo_video_key_request?mid='.@$material->genryo_id) }}" class="video-contact-btn">パスワード申請フォーム</a>
								@endif
							</div>
						</div>
					@endif

					<div class="secWrap">
						@if($material->item_gaiyo)
							@if($material->item_gaiyo_title)
								<h2>{{ $material->item_gaiyo_title }}</h2>
							@else
								<h2>商品概要</h2>
							@endif
							<p class="txt">{{ $material->item_gaiyo }}</p>
						@endif
						<div class="contact">
							<ul class="contactList">
								<li class="leftBox">
									<img src="/img/material/img_tel.png" alt="TEL" class="sp">
									<p>お問い合わせ電話番号</p>
									<p class="tel pc">{{ @$material->company->tel }}</p>
									<a class="tel sp" href="tel:{{ @$material->company->tel }}">{{ @$material->company->tel }}</a>
								</li>
								<li class="rightBox">
									<ul class="btnList">
										<li><a href="{{ url('/material/genryo_contact?mid='.@$material->genryo_id) }}">見積依頼・問い合せ</a></li>
										<li><a href="{{ url('/material/dl_contact?mid='.@$material->genryo_id) }}">資料ダウンロード</a></li>
										<li><a href="{{ url('/material/sample_contact?mid='.@$material->genryo_id) }}">無償サンプル依頼</a></li>
									</ul>
								</li>
							</ul>
							<p class="caption">商流についてはメーカー、販売者様にご相談下さい。</p>
						</div>
					</div>
				</section>
				<section id="sec02" class="sec">
					<div class="secWrap">
						<h2>{{ @$material->item_nm }}の基本情報</h2>
						<div class="baseInfo">
							<h3>名称と規格区分</h3>
							<ul class="flexBox">
								<li>
									<table class="common_info">
										<tr>
											<th>一般名</th>
											<td>{{ @$material->ippan_nm }}</td>
										</tr>
										@if(@$material->en_nm)
											<tr>
												<th>英語名</th>
												<td>{{ @$material->en_nm }}</td>
											</tr>
										@endif
										<tr>
											<th>原材料表示例</th>
											<td>{{ @$material->genryo_ex }}</td>
										</tr>
									</table>
								</li>
								<li>
									<table>
									<tr>
											<th>区分</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'kubun', 'master_obj_list' => $kubun_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
											</td>
										</tr>
										@if (isset($material->tenka_kijun) && $material->tenka_kijun)
											<tr>
												<th>添加物使用基準</th>
												<td><a class="outsideLink" target="_blank" href="{{ $material->tenka_kijun }}">使用基準リスト</a></td>
											</tr>
										@endif
										<tr>
											<th>規格成分</th>
											<td>{!! nl2br(e(@$material->kikaku)) !!}</td>
										</tr>
									</table>
								</li>
							</ul>

							<h3>性状と特性</h3>
							<ul class="flexBox">
								<li>
									<table>
									<tr>
											<th>性状</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'seijo', 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
											</td>
										</tr>
										<tr>
											<th>水への溶解性</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'suiyosei', 'master_obj_list' => $suiyosei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										<tr>
											<th>油への溶解性</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'yuyosei', 'master_obj_list' => $yuyosei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(@$material->shomi_kigen)
											<tr>
												<th>賞味期限</th>
												<td>{{ $material->shomi_kigen }}</td>
											</tr>
										@endif
										<tr>
											<th>GMO情報</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'gmo_info', 'master_obj_list' => $gmo_info_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(@$material->warning)
											<tr>
												<th>使用上の注意</th>
												<td>{{ $material->warning }}</td>
											</tr>
										@endif
									</table>
								</li>
								<li>
									<table>
									<tr>
											<th>おすすめ剤型</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'zaikei', 'master_obj_list' => $zaikei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(@$material->sesshu)
											<tr>
												<th>一日摂取目安量</th>
												<td>{{ $material->sesshu }}</td>
											</tr>
										@endif
										@if(count(@$material->sokyu_bui) > 0)
											<tr>
												<th>訴求部位</th>
												<td>
													@include('utils.data_list', ['object' => @$material, 'name' => 'sokyu_bui', 'master_obj_list' => $sokyu_bui_master_list, 'master_key' => 'sokyu_bui_cd', 'master_value' => 'sokyu_bui_nm', 'delimiter' => '、'])
												</td>
											</tr>
										@endif
										<tr>
											<th>アレルギー物質</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'allergie', 'master_obj_list' => $allergie_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(@$material->genseiyaku_hi)
											<tr>
												<th>原生薬比</th>
												<td>{{ $material->genseiyaku_hi }}</td>
											</tr>
										@endif
									</table>
								</li>
							</ul>

							<h3>由来とデータ</h3>
							<ul class="flexBox">
								<li>
									<table>
										@if(@$material->yurai)
										<tr>
												<th>由来</th>
												<td>{{ $material->yurai }}</td>
											</tr>
										@endif
										@if(@$material->siyo_bui)
											<tr>
												<th>使用部位</th>
												<td>{{ $material->siyo_bui }}</td>
											</tr>
										@endif
										<tr>
											<th>原産国（主成分）</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'gensankoku', 'master_obj_list' => $gensankoku_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										<tr>
											<th>最終加工国（県）</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'saishu_koku', 'master_obj_list' => $saishu_koku_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table>
									<tr>
											<th>自社保有エビデンス</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'evidence', 'master_obj_list' => $evidence_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(@$material->tokuho)
											<tr>
												<th>トクホ素材</th>
												<td>
													@include('utils.data_list', ['object' => @$material, 'name' => 'tokuho', 'master_obj_list' => $tokuho_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
												</td>
											</tr>
										@endif
										<tr>
											<th>安全性データ</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'anzen_data', 'master_obj_list' => $anzen_data_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										@if(sizeof($material->chaina) > 0)
										<tr>
												<th>チャイナ</th>
												<td>
													@include('utils.data_list', ['object' => @$material, 'name' => 'chaina', 'master_obj_list' => $chaina_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
												</td>
											</tr>
										@endif
									</table>
								</li>
							</ul>

							<h3>供給と知的財産</h3>
							<ul class="flexBox">
								<li>
									<table>
										@if($material->seizo_maker)
										<tr>
												<th>製造メーカー</th>
												<td>{{ $material->seizo_maker }}</td>
											</tr>
										@endif
										<tr>
											<th>内容量</th>
											<td>{{ $material->naiyo }}</td>
										</tr>
										@if(count(@$material->kyokyu) > 0)
											<tr>
												<th>供給体制</th>
												<td>
													@include('utils.data_list', ['object' => @$material, 'name' => 'kyokyu', 'master_obj_list' => $kyokyu_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
												</td>
											</tr>
										@endif
										<?php
											$show_logo = '';
											foreach ($shohyo_logo_master_list as $shohyo_logo_master) {
											if ($shohyo_logo_master->code_nm == '商品への使用条件有り') {
													$show_logo = $shohyo_logo_master->code;
												}
											}
										?>
										@if(count(@$material->shohyo_logo) > 0)
											<tr>
												<th>商標・ロゴマーク</th>
												<td>
													@include('utils.data_list', ['object' => @$material, 'name' => 'shohyo_logo', 'master_obj_list' => $shohyo_logo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
												</td>
											</tr>
										@endif
										@if(in_array($show_logo, @$material->shohyo_logo))
											<tr>
												<th></th>
												<td>
													<ul class="markList">
														@if (isset($material->logo_pic1) && $material->logo_pic1)
															<li><img src="{{ url(config('app.upload_image_folder').'/'.$material->logo_pic1) }}" alt=""></li>
														@endif
														@if (isset($material->logo_pic2) && $material->logo_pic2)
															<li><img src="{{ url(config('app.upload_image_folder').'/'.$material->logo_pic2) }}" alt=""></li>
														@endif
													</ul>
												</td>
											</tr>
										@endif
									</table>
								</li>
								<li>
									<table>
									<tr>
											<th>海外使用実績</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'kaigai', 'master_obj_list' => $kaigai_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '、'])
											</td>
										</tr>
										<tr>
											<th>ペット向け</th>
											<td>
												@include('utils.data_list', ['object' => @$material, 'name' => 'pet', 'master_obj_list' => $pet_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])
											</td>
										</tr>
										@if(@$material->tokkyo)
											<tr>
												<th>特許</th>
												<td>{{ $material->tokkyo }}</td>
											</tr>
										@endif
									</table>
								</li>
							</ul>
						</div>
					</div>

					@if ($material->jokyo != '4')
						<div class="secWrap bgWhite">
							<h2>機能性表示食品</h2>
							<div class="functionalFoodInfo">
								<table>
									<tr>
										<th>状況</th>
										<td>
											@foreach($jokyo_master_list as $jokyo_master)
												{{ $jokyo_master->code == $material->jokyo ? $jokyo_master->code_nm : '' }}
											@endforeach
										</td>
									</tr>
									@if(@$material->kanyo)
									<tr>
										<th>関与成分</th>
										<td>
											{!! nl2br(e(@$material->kanyo)) !!}
										</td>
									</tr>
									@endif
									@if(@$material->sotei_hc)
										<tr>
											<th>想定されるヘルスクレーム</th>
											<td>
												{!! nl2br(e(@$material->sotei_hc)) !!}
											</td>
										</tr>
									@endif
								</table>
							</div>
						</div>
					@endif

					@if(sizeof($material->genryo_links->all()) > 0)
						<div class="secWrap bgWhite">
							<h2>参考リンク</h2>
							<div class="referenceLinks">
								<?php
							$cols = array_chunk($material->genryo_links->all(), ceil(count($material->genryo_links) / 2));
									foreach ($cols as $links) {
										echo '<ul>';
										foreach ($links as $link) {
									echo '<li><a class="outsideLink" href="' . $link->url . '" target="_blank">' . $link->link_mei . '</a></li>';
										}
										echo '</ul>';
									}
								?>
							</div>
						</div>
					@endif

					@if($material->ninsho_logo or $material->ninsho_logo_halal)
						<div class="secWrap bgWhite">
							<h2>取得認証</h2>
							<div class="authenticatedInfo">
								<ul class="authenticatedList">
									@foreach($material->ninsho_logo as $ninsho_logo)
										@foreach($all_ninsho_master_list_array as $ninsho_master)
											{!! $ninsho_master['code'] == $ninsho_logo ? '<li>'.$ninsho_master['code_nm'].'</li>' : '' !!}
										@endforeach
									@endforeach
									@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
										@foreach($all_ninsho_master_list_array as $ninsho_master)
											{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<li>'.$ninsho_master['code_nm'].'</li>' : '' !!}
										@endforeach
									@endforeach
								</ul>
								<ul class="authenticatedImageList pc">
									@foreach($material->ninsho_logo as $ninsho_logo)
										@foreach($all_ninsho_master_list_array as $ninsho_master)
											{!! $ninsho_master['code'] == $ninsho_logo ? '<li><img src="'.$ninsho_master['code_rnm'].'" alt=""></li>' : '' !!}
										@endforeach
									@endforeach
									@foreach($material->ninsho_logo_halal as $ninsho_logo_halal)
										@foreach($all_ninsho_master_list_array as $ninsho_master)
											{!! $ninsho_master['code'] == $ninsho_logo_halal ? '<li><img src="'.$ninsho_master['code_rnm'].'" alt=""></li>' : '' !!}
										@endforeach
									@endforeach
								</ul>
							</div>
						</div>
					@endif
				</section>

				<section id="sec03" class="sec">
					<div class="secWrap">
						<h2>販売者情報</h2>
						<div class="sellerInfo">
							<table>
								<tr>
									<th class="pc">企業名</th>
									<td>{{ @$material->company->kigyo_nm }}</td>
								</tr>
								<tr>
									<th class="pc">所在地</th>
									<td>{{ @$material->company->address }}</td>
								</tr>
								<tr>
									<th class="pc">企業HP</th>
									<td><a href="{{ @$material->company->kigyo_hp }}" target="_blank">{{ @$material->company->kigyo_hp }}</a></td>
								</tr>
							</table>
						</div>
						<div class="contact">
							<ul class="contactList">
								<li class="leftBox">
									<img src="/img/material/img_tel.png" alt="TEL" class="sp">
									<p>お問い合わせ電話番号</p>
									<p class="tel pc">{{ @$material->company->tel }}</p>
									<a class="tel sp" href="tel:{{ @$material->company->tel }}">{{ @$material->company->tel }}</a>
								</li>
								<li class="rightBox">
									<ul class="btnList">
										<li><a href="{{ url('/material/genryo_contact?mid='.@$material->genryo_id) }}">見積依頼・問い合せ</a></li>
										<li><a href="{{ url('/material/dl_contact?mid='.@$material->genryo_id) }}">資料ダウンロード</a></li>
										<li><a href="{{ url('/material/sample_contact?mid='.@$material->genryo_id) }}">無償サンプル依頼</a></li>
									</ul>
								</li>
							</ul>
							<p class="caption">商流についてはメーカー、販売者様にご相談下さい。</p>
						</div>
					</div>
				</section>

				<section id="sec04" class="sec">
					<div class="secWrap">
						@if(count($recs)>0)
							<h2>{{ @$material->company->kigyo_nm }}取扱いのおすすめ原料</h2>
							<div class="otherAdviceInfo">
								<ul class="otherAdviceList">
									@foreach($recs as $rec)
										<li>
											<a href="{{ url('/material/detail/'.$rec->genryo_id) }}">
												<dl>
											<dt>
												@if (@$rec->top_pic)
													<img src="{{ url(config('app.upload_image_folder').'/'.rawurlencode($rec->top_pic)) }}" 
														@if (@$rec->ippan_nm != @$rec->item_nm)
															alt="{{ @$rec->company->kigyo_nm }}の原料{{ @$rec->ippan_nm }}、商品名{{ @$rec->item_nm }}"
														@else
															alt="{{ @$rec->company->kigyo_nm }}の原料{{ @$rec->ippan_nm }}"
														@endif
													>
												@endif
											</dt>
											<dd>
												<div>{{ $rec->ippan_nm }}</div>
											</dd>
												</dl>
											</a>
										</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>

					<div class="secWrap pc">
						<div class="mail">
							<a href="mailto:?subject=このページを共有する&amp;body=%0d%0a %0d%0a %0d%0a▼共有するページURL▼ %0d%0a{{ urlencode(url()->full()) }}">
								<img src="/img/material/icon_mail.svg" alt="" class="mailIcon">
								<p class="main">このページを<br>メールで共有する</p>
								<p class="sub">この原料ページを知り合いに送信、<br>同じ部署のメンバーと共有したり<br>取引先の問屋担当者に問い合わせ。</p>
								<div class="arrowIcon">
									<p></p>
								</div>
							</a>
						</div>
					</div>
				</section>
			</main>
		</div>
	</div>
	<!-- // contents -->
	@endif


	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

</body>

</html>