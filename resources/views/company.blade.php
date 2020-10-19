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
	
	<link rel="stylesheet" href="/css/top.css">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="top" class="search">

	<!-- header -->
	<div class="header">
		@include('inc.header')
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="sub-contents">
		    <h1 class="other-hx">運営企業情報</h1>
		</div>

		<div class="wrapper"> 
			<section class="sub-contents3">
				<table class="company-tbl">
				<tr>
					<th>会社名</th>
					<td>株式会社E.EFFECT</td>
				</tr>
				<tr>
					<th>代表者</th>
					<td>代表取締役社長　志賀吉浩</td>
				</tr>
				<tr>
					<th>設立	</th>
					<td>2018年4月</td>
				</tr>
				<tr>
					<th>資本金</th>
					<td>500万円</td>
				</tr>
				<tr>
					<th>所在地</th>
					<td>〒583-0008<br>
					大阪府藤井寺市大井2丁目4-15</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td>072-976-5530</td>
				</tr>
				<tr>
					<th>事業内容</th>
					<td>メディア事業・広告掲載</td>
				</tr>
				<tr>
					<th>URL</th>
					<td><a href="{{ url('company') }}" target="_blank">{{ url('/') }}</a></td>
				</tr>
				<tr>
					<th>主要取引銀行</th>
					<td>三菱UFJ銀行</td>
				</tr>
				</table>
			</section>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	
<div class="menuOverlay"></div>
</body>
</html>