	<header>
		<div class="headerWrap">
			<div class="box">
				<div class="btnGlobalNav">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="logo">
					<a href="{{ url('/') }}"><img src="/img/logo-BalBal-yoko-RGB.png" alt="バルバル"></a>
				</div>
				<div class="back sp">
					<a href="#" onclick='history.back();return false;'><img src="/img/icon_back.svg" alt=""></a>
				</div>
			</div>
			@if (!isset($do_not_show_header_contact) || !$do_not_show_header_contact)
				<div class="box pc">
					<div class="contact">
						<a href="{{ url('/contact') }}">原料掲載をご希望の方はこちら</a>
					</div>
				</div>
			@endif
		</div>
	</header>

	<div class="globalNavMenu">
		<nav>
			<ul>
				<li>
					<p class="title">MENU</p>
					<div class="btnClose">×</div>
				</li>
				<li><a href="{{ url('/material?k=1') }}">海外に実績のある原料一覧</a></li>
				<li><a href="{{ url('/material?p=1') }}">ペットに実績のある原料一覧</a></li>
				<li><a href="{{ url('/food') }}">機能性表示食品届出一覧</a></li>
				<li><a href="{{ url('/benchmark') }}">サプリメント市販商品一覧</a></li>
				<li><a href="{{ url('/tenjikai') }}">展示会開催情報一覧</a></li>
				<li><a href="{{ url('/company') }}">運営会社</a></li>
				<li>
					<form action="/material" method="get" class="keyword">
						<input id="txt" type="text" name="keyword" placeholder="原料名・規格成分名から検索" value="" class="height">
						<input id="submit" type="submit" value="" class="btnSearch">
					</form>
				</li>
			</ul>
		</nav>
	</div>

	<!-- popup -->
	<div class="screen"></div>
	<div class="popup">
		<img src="/img/BALBAL.png" alt="バルバル">
		<div class="title">BALBALをご利用の皆様へ</div>
		<div class="main-content">
			このサイトに記載している情報は、健康食品等の<br>
			業界関係者や研究・開発の方を対象にした情報であり、<br>
			一般消費者の方に対する情報提供を目的としたものではありません。
		</div>
		<div class="sub-content">あなたは業界関係者ですか？</div>
		<div class="link">
			<a href="#" class="no" id="welcome_popup_no">いいえ</a>
			<a href="#" id="welcome_popup_yes">はい</a>
		</div>
	</div>
	<!-- end: popup -->