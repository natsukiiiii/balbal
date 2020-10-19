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
    <link rel="stylesheet" href="/css/top.css?200122">
	<link rel="stylesheet" href="/css/sitemap.css?200122">
    
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
        <h1 class="other-hx">サイトマップ</h1>
    </div>


  <div class="wrapper">
    <section class="sub-contents4">

            <div class="left">
                <dl>
                    <dt class="st-heading">健康食品原料を探す </dt>
                    <dd>
                        <ul>
                            <li><a href="{{ url('/') }}">TOPページ</a></li>
                            <li><a href="{{ url('/material') }}">訴求効果から探す</a></li>
                            <li><a href="{{ url('/material') }}">訴求部位から探す</a></li>
                            <li><a href="{{ url('/material') }}">成分名から探す</a></li>
                            <li><a href="{{ url('/material') }}">用途から探す</a></li>
                            <li><a href="{{ url('/material?k=1') }}">海外で使用実績のある原料</a></li>
                            <li><a href="{{ url('/material?p=1') }}">ペットサプリに実績のある原料</a></li>
                            </ul>
                    </dd>
                </dl>
                <dl>
                    <dt class="st-heading">機能性表示食品進捗情報  </dt>
                    <dd>
                        <ul>
                            <li><a href="/food/">関連成分から探す</a></li>
                            <li><a href="/food/">機能性から探す</a></li>
                            </ul>
                    </dd>
                </dl>
            </div>
            <div class="right">
                <dl>
                    <dt class="st-heading">サプリメント市販商品一覧 </dt>
                    <dd>
                        <ul>
                            <li><a href="/benchmark/">期待する効果から探す</a></li>
                            <li><a href="/benchmark/">剤型から探す</a></li>
                            </ul>
                    </dd>
                </dl>
                <dl>
                    <dt class="st-heading">展示会開催スケジュール</dt>
                    <dd>
                        <ul>
                         <li><a href="/tenjikai/">国内･海外展示会開催情報</a></li>
                        </ul>
                    </dd>
                </dl>

                <dl>
                    <dt class="st-heading">ご利用について  </dt>
                    <dd>
                        <ul>
                            <li><a href="/terms/">利用規約</a></li>
                            <li><a href="/privacypolicy/">プライバシーポリシー</a></li>
                            </ul>
                    </dd>
                </dl>
                <dl>
                    <dt class="st-heading">企業情報 </dt>
                    <dd>
                        <ul>
                        　　<li><a href="/contact/">問い合わせ</a></li>
                            <li ><a href="/company/">運営会社</a></li>
                        </ul>
                    </dd>
                </dl>
            </div>

    </section>
  </div>
</div>
	<!-- // contents -->

    <div style="margin-bottom: 10px;"></div>
	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->
	
<div class="menuOverlay"></div>
</body>
</html>