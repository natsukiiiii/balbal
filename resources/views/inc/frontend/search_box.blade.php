<div class="searchWrap">
	<div class="searchArea">
		<div class="block conditions">
			<p>条件を指定して探す</p>
			<ul>
				<li class="search-btn one"><a href="">機能性から探す</a></li>
				<li class="search-btn two"><a href="">訴求部位から探す</a></li>
				<li class="search-btn three"><a href="">成分名から探す</a></li>
				<li class="search-btn four"><a href="">用途から探す</a></li>
			</ul>
		</div>
		<div class="block">
			<p>キーワードから探す</p>
			<div class="searchTxt">
			<form action="/material" method="get" class="keyword">
				<input id="txt" type="text" name="keyword" placeholder="原料名・企業名から検索" value="{{ old('keyword') }}" class="height">
				<input id="submit" type="submit" value="">
			</form>
			</div>
		</div>
	</div>
	<div class="searchCont">
		<form action="/material" id="material_search_form" method="get">
			<div class="modal one categorySearchModal">
				<div class="upperBlock">
					<p class="ttl">機能性から探す</p>
					<p class="choice">選択中</p>
					<ul class="choiceList"></ul>
					<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
				</div>
				<div class="chubuBlock">
					<ul class="acoList categoryList">
						@foreach ($sokyu_cate_master_list as $sokyu_cate_master)
							<li><a href="" sokyu_cate_cd="{{ $sokyu_cate_master->sokyu_cate_cd }}">{{ $sokyu_cate_master->sokyu_cate_nm }}</a></li>	
						@endforeach
					</ul>
					
					<div class="spBlock">
						<ul class="button">
							<li class="clearBtn"><button type="submit">クリア</button></li>
							<li class="searchBtn"><button type="submit">検索</button></li>
						</ul>
					</div>
				</div>
				<div class="beneathBlock blueBk pcBlock">
					<div class="sokyu_cate2_display">
						<p class="formCategory">
							<label><input type="checkbox" name="checkbox01" class="check_all checkbox01-input">
								<span class="checkbox01-parts">ダイエットすべて</span>
							</label>
						</p>
						<ul class="checkbox_list categoryListSub"></ul>
					</div>

					<ul class="button">
						<li class="clearBtn"><button type="submit">クリア</button></li>
						<li class="searchBtn"><button type="submit">検索</button></li>
					</ul>
				</div>
			</div>
			<input type="hidden" name="is_seikyu_search" value="1">
		</form>

		<form action="/material" method="get">
			<div class="modal two sokyubuiSearchModal">
				<div class="upperBlock">
					<p class="ttl">訴求部位から探す</p>
					<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
				</div>
				<div class="chubuBlock">
						<ul class="input-01 checkbox_list">
							@foreach ($sokyu_bui_master_list as $sokyu_bui_master)
								<li><label>
									<input type="checkbox" name="sb[]" class="checkbox01-input" value="{{ $sokyu_bui_master->sokyu_bui_cd }}">
									<span class="checkbox01-parts">{{ $sokyu_bui_master->sokyu_bui_nm }}</span>
								</label></li>
							@endforeach
						</ul>

						<div class="searchBtn02 spBlock"><button type="submit">検索</button></div>
				</div>
				<div class="beneathBlock pcBlock">
					<ul class="button">
						<li class="clearBtn"><button type="submit">クリア</button></li>
						<li class="searchBtn"><button type="submit">検索</button></li>
					</ul>
				</div>
			</div>
		</form>

		<div class="modal three">
			<div class="upperBlock">
				<p class="ttl">成分名から探す</p>
				<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
			</div>
			<div class="beneathBlock">
				<ul class="component">
					@foreach ($seibun_mei_map_list as $key => $value)
						<li><a href="{{ url('/search/material/'.$key) }}">{{ $key }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>

		<form action="/material" method="get">
			<div class="modal four shokutenSearchModal">
				<div class="upperBlock">
					<p class="ttl">用途から探す</p>
					<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
				</div>
				<div class="chubuBlock">
						<ul class="input-01 checkbox_list">
							@foreach ($shokuten_master_list as $shokuten_master)
								@if (!in_array($shokuten_master->yoto_cate_cd, [4, 5, 7, 8, 9, 13, 19, 20, 21, 22, 23, 24, 26, 27]))
									<li><label>
										<input type="checkbox" name="st[]" class="checkbox01-input" value="{{ $shokuten_master->yoto_cate_cd }}">
										<span class="checkbox01-parts">{{ $shokuten_master->yoto_cate_nm }}</span>
									</label></li>
								@endif
							@endforeach
						</ul>

						<div class="searchBtn02 spBlock"><button type="submit">検索</button></div>
				</div>
				<div class="beneathBlock pcBlock">
					<ul class="button">
						<li class="clearBtn"><button type="submit">クリア</button></li>
						<li class="searchBtn"><button type="submit">検索</button></li>
					</ul>
				</div>
			</div>
		</form>
	</div>
</div>