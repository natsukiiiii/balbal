<div class="searchWrap food">
	<div class="searchArea">
		<div class="block conditions">
			<p>条件を指定して探す</p>
			<ul>
				<li class="search-btn one"><a href="">関与成分から探す</a></li>
				<li class="search-btn two"><a href="">機能性から探す</a></li>
			</ul>
		</div>
		<div class="block">
			<p>キーワードから探す</p>
			<div class="searchTxt">
			<form class="keyword" action="{{ url('food') }}" method="get">
				<input id="txt" type="text" name="keyword" placeholder="商品名・原料名・企業名から検索" class="height" value="{{ old('keyword') }}">
				<input id="submit" type="submit" value="">
			</form>
			</div>
		</div>
	</div>
	<div class="searchCont">
		<div class="modal one involved">
			<div class="upperBlock">
				<p class="ttl">関与成分から探す</p>
				<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
			</div>
			<div class="chubuBlock">
				<div class="invosearch">
					<input id="involvedtxt" type="text" name="" placeholder="" value="" class="height" autocomplete="off">
					<input id="involvedsubmit" type="submit" value="">
				</div>
				<ul class="involved_ul">
					@foreach ($kinosei_shokuhin_master_list as $kinosei_shokuhin_master)
						<li><a href="/food?kanyo={{ $kinosei_shokuhin_master->kinosei_stg_cd }}">{{ $kinosei_shokuhin_master->kinosei_stg }}</a></li>	
					@endforeach
				</ul>
			</div>
		</div>
		
		<div class="modal two function">
			<div class="upperBlock">
				<p class="ttl">機能性から探す</p>
				<div class="close"><img src="/img/top/modal_close.png" alt="☓"></div>
			</div>
			<div class="chubuBlock">
				<ul>
					@foreach ($kinosei_category_master_list as $kinosei_category_master)
						<li><a href="/food?category={{ $kinosei_category_master->kinosei_category_cd }}">{{ $kinosei_category_master->kinosei_category }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="menuOverlay"></div>