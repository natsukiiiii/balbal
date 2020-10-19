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
<div class="sub-contents">
	<h1 class="other-hx">お問い合わせ</h1>
</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="form_box" style="width: 100%;">
			<iframe id="form_iframe" src="" style="width: 100%;min-height: 689px;"></iframe>
			<script type="text/javascript" src="//lmsg.jp/js/ja/formutil.js"></script>
			<script>document.getElementById("form_iframe").src = addLfCdParam("https://lmsg.jp/form/12000/YlbOoXkX");</script>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	
<div class="menuOverlay"></div>
</body>
</html>