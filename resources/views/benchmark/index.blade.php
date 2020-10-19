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
	<link rel="stylesheet" href="/css/benchmark.css?191118">
	<!-- JS -->
	<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="/js/common.js?191114"></script>
	<script src="/js/top.js"></script>
	@include('inc.head')
</head>
<body id="food" class="search sidebar">

	<!-- header -->
	<div class="header">
		@include('inc.header')
		<div class="firstView">
			<div class="firstViewWrap">
				<div class="breadcrumbs pc">
					<ul>
						<li><a href="{{ url('/') }}">ホーム</a></li>
						<li>{{ $tag_object['h1'] }}</li>
					</ul>
				</div>
				<h1>{{ $tag_object['h1'] }}</h1>
				@include('inc.frontend.benchmark_search_box')
			</div>
		</div>
	</div>
	<!-- // header -->

	<!-- contents -->
	<div class="contents">
		<div class="contentsWrap" style="display:block">
			@if ($search_by_text)
				<p class="lead">{{ $search_by_text }}</p>
			@endif
			<div style="display:flex">
				<main>
					<h2 class="sp">新着情報</h2>
					<ul class="foodList">
						@include('benchmark.index_items_only')
					</ul>
				</main>
				<aside class="pc">
					<div class="categoryList">
						<div class="categoryTitle">比較したい商品をここにドラッグ</div>
						

<div id="instafeed"></div>
<script>
$(function(){
	$.ajax({
		type: 'GET',
		url: "https://graph.facebook.com/v3.0/17841401971316111?fields=name%2Cmedia.limit(5)%7Bcaption%2Clike_count%2Cmedia_url%2Cpermalink%2Ctimestamp%2Cusername%7D&access_token=EAAPEtuq14nYBAGAYQNT0XfFzxgnxnNSuR4plCLyKjfHwpjwXJCwbTQqLBTJZA7Gbrpy3X9P8gq2CfR5XFPUqZAZBQXiDoyImVDiunnpW2KlFFqoB1Y2ebkZAtQJ0VeHN0PbvFAfTmWCfqCelj1t9L9ZCHSWVW7U0Q4djYgyATg4W8ICL1b4iH4ZCZBQ0RiffPoZD",
	dataType: 'json',
		success: function(json) {
		    	
		    var html = '';
		    var insta = json.media.data;
		    for (var i = 0; i < insta.length; i++) {
		    	html += '<div ><a href="' + insta[i].permalink + '" target="_blank"><img src="' + insta[i].media_url + '"></a></div>';
		    }
		      $("#instafeed").append(html);			
		},
		error: function() {
 
		//エラー時の処理
		}
	});
});	
</script>
						<div class="categoryWrap">
							<form action="{{ url('benchmark/compare/') }}" method="GET"  target="_blank" >
								<div class="compareItemList">
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div class="compareItem" ondrop="drop(event)" ondragover="allowDrop(event)">
										<input type="hidden" name="id[]" value="">
										<div class="name"></div>
										<div class="close"></div>
										<div class="circle">+</div>
									</div>
									<div style="clear:both;"></div>
								</div>
								<input type="submit" class="compareButton" value="比較する" disabled>
							</form>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
	<!-- // contents -->

	<!-- footer -->
	@include('inc.footer')
	<!-- // footer -->

	<div class="menuOverlay"></div>
</body>

<script>
	var ls_key = 'balbal_compareItemList';

	// Save current DOM to localstorage
	function save_compare_list_to_local_storage() {
		localStorage.setItem(ls_key, $(".compareItemList").html());
		$(".compareButton").prop('disabled', $(".compareItemList .compareItem.on").length == 0);
	}
	function allowDrop(e) {
  		e.preventDefault();
	}
	function drag(e) {
		e.dataTransfer.setData("text", e.target.id); // change to "text" because of supporting for the damn IE11
		$('.compareItem').addClass('blink');
	}
	function drop(e) {
		e.preventDefault();
		var drag_id = e.dataTransfer.getData('text'); // change to "text" because of supporting for the damn IE11
		var $drag_obj = $('#'+drag_id);
		var $target_obj = $(e.target).closest('.compareItem');

		$('.compareItem').removeClass('blink');
		$target_obj.addClass('on');
		$target_obj.find('.name').html($drag_obj.find('.foodName').html() + '&nbsp;');
		$target_obj.css('background-image', 'url(' + encodeURI($drag_obj.find('.imgArea img').attr('src')) + ')');
		$target_obj.find('input').val(drag_id.replace(/drag_id_/g, ''));

		save_compare_list_to_local_storage();
	}
	document.addEventListener("dragend", function(event) {
		$('.compareItem').removeClass('blink');
	}, false);
	$(function(){
		if (localStorage.getItem('balbal_compareItemList') !== null) {
			$('.compareItemList').html(localStorage.getItem('balbal_compareItemList'));
			$(".compareButton").prop('disabled', $(".compareItemList .compareItem.on").length == 0);
		}

		$('.compareItem .close').click(function(){
			$(this).parent().removeClass('on')
				.css('background-image', 'none')
				.find('input').val('');
			save_compare_list_to_local_storage();
		});

		///////////////////////////////////////////
		// Auto get content when scrolling
		
		var is_loading_scroll_content = false;
		var current_page = parseInt('{{ $benchmark_list->currentPage() }}');
		var total_page = parseInt('{{ $benchmark_list->lastPage() }}');
		var base_full_url = '{{ url()->current() }}?{{ http_build_query(array_except(Request::query(), 'page')) }}';

		$(window).scroll(function() {
			var end = $(".footerWrap").offset().top; 
			var viewEnd = $(window).scrollTop() + $(window).height(); 
			var distance = end - viewEnd; 
			if (!is_loading_scroll_content && current_page < total_page && distance < 300) { // 300px from the .footerWrap 's top
				$.ajax({
					type: 'GET',
			        url: base_full_url + "&is_ajax=1&page=" + (current_page + 1),
			        beforeSend: function() {
				        // setting a timeout
				        is_loading_scroll_content = true;
				    },
			        success: function(data) {
			        	current_page++;
			        	$(".foodList").append(data);
			        },
			        complete: function() {
			        	is_loading_scroll_content = false;
			        },
			    });
		    }
		});
	});
</script>

</html>