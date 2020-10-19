<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>原料のお問い合わせ</title>
	<meta name="description" content="原料のお問い合わせ" />
	<meta name="Keywords" content="原料のお問い合わせ" />
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
	  <h1 class="other-hx">{{ $title }}</h1>
　　</div>
	<!-- // header -->

	<!-- contents -->
	@if ($material->$contact)
		<div class="contents">
			<div class="form_box" style="width: 100%;">
				{!! $material->$contact !!}
			</div>
		</div>
	@endif
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	
	<style>
		.contents iframe {
			min-height: 689px;
		}
	</style>
</body>
</html>