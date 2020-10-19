	<div class="btnPageTop"><p></p></div>

	<footer>
		<div class="footerWrap">
			<div class="legalLinks">
				<ul>
					<li><a href="{{ url('company') }}">運営会社</a></li>
					<li><a href="{{ url('sitemap') }}">サイトマップ</a></li>
					<li><a href="{{ url('terms') }}">利用規約</a></li>
					<li><a href="{{ url('privacypolicy') }}">プライバシーポリシー</a></li>
				</ul>
			</div>
			<div class="copyright">
				<small>&copy; balbal {{ \Carbon\Carbon::now()->year }}</small>
			</div>
		</div>
	</footer>