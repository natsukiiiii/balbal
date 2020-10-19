<div class="searchWrap benchmark">
	<div class="searchArea">
	<div class="block conditions pc-inline-block">
		<p>条件を指定して探す</p>
		<ul>
			<li class="search-btn one"><a href="">期待する効果から探す</a></li>
			<li class="search-btn two"><a href="">剤型から探す</a></li>
		</ul>
	</div>
	<div class="block pc-inline-block">
		<p>キーワードから探す</p>
		<div class="searchTxt">
		<form action="/benchmark" method="get" class="keyword">
			<input id="txt" type="text" name="keyword" placeholder="原料名・有効成分・フリーワードから検索" value="{{ old('keyword') }}" class="height">
			<input id="submit" type="submit" value="">
		</form>
		</div>
	</div>
	</div>
	<div class="searchCont">
		<div class="modal one sokyubuiSearchModal">
			<div class="upperBlock">
				<p class="ttl">期待する効果から探す</p>
				<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
			</div>
			<div class="chubuBlock">
				<ul class="input-01 checkbox_list">
					@foreach ($mokuteki_cate_master_list as $mokuteki_cate_master)
						<li>
							<a href="/benchmark/?category={{ $mokuteki_cate_master->mokuteki_cate_cd }}">{{ $mokuteki_cate_master->mokuteki_cate_nm }}</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="modal two">
			<div class="upperBlock">
				<p class="ttl">剤型から探す</p>
				<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
			</div>
			<div class="chubuBlock">
				<ul class="input-01 checkbox_list">
					@foreach ($zaikei_bench_master_list as $zaikei_bench_master)
						<li>
							<a href="/benchmark/?zaikei={{ $zaikei_bench_master->code }}">{{ $zaikei_bench_master->code_nm }}</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>