$(function(){

//	イベント処理
//******************************************************************************************************************************************************

	//====================================================================================================
	//	機能	：ページ内アンカーリンク押下時
	//	説明	：スムーススクロールしながらページ内遷移を行う
	//====================================================================================================

	$('a[href^="#"]').click(function() {
		// スクロールの速度
		var speed = 500;
		// アンカーの値取得
		var href= $(this).attr("href");
		// 移動先を取得
		var target = $(href == "#" || href == "" ? 'html' : href);
		if (typeof target.offset() !== "undefined") {
			// 移動先を数値で取得
			var position = target.offset().top;
			// スムーススクロール
			$('body, html').animate({scrollTop:position}, speed, 'swing');
		}
	});

	//====================================================================================================
	//	機能	：ハンバーガーメニューボタン
	//	説明	：ハンバーガーメニューボタンを押下時、メニューを表示させる
	//====================================================================================================

	$('.btnGlobalNav').click(function(e){
		e.stopPropagation();
		$(".globalNavMenu").fadeIn(0).addClass('open');
	});

	$('.globalNavMenu .btnClose').click(function(){
		$(".globalNavMenu").fadeOut(500).removeClass('open');
	});
	
	$(document).on('click', function (e) {
	    if ($(e.target).closest(".globalNavMenu").length === 0 && $(".globalNavMenu").hasClass('open')) {
	        $(".globalNavMenu").fadeOut(500).removeClass('open');
	    }
	});

	//====================================================================================================
	//	機能	：ページトップに戻るボタン
	//	説明	：ページトップに戻るボタン押下時、画面上部に遷移する
	//			画面をスクロール時にページトップに戻るボタンを表示させる
	//====================================================================================================

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.btnPageTop').fadeIn();
		} else {
			$('.btnPageTop').fadeOut();
		}
	});

	$('.btnPageTop').click(function () {
		$('body, html').animate({ scrollTop: 0 }, 500);
	});

});

////////////////////////////////////////
// from now is the part of ILOVEX //////
////////////////////////////////////////

$(function(){

	// Control when user check / uncheck .check_all button
	$(".categorySearchModal .sokyu_cate2_display .check_all").change(function(){
		$(this).closest(".modal").find(".categoryListSub input[type=checkbox]").prop('checked', $(this).prop('checked')).trigger("change");
	});

	// Control when user select sokyu_cate level 1
	$(".categorySearchModal .categoryList li").click(function(e){
		var is_sp = window.innerWidth < 768 ? true : false;
		e.preventDefault();
		var $this = $(this).find("a");
        $beneathBlock = $this.parents('.chubuBlock').next('.beneathBlock');
		var sokyu_cate_cd = $this.attr("sokyu_cate_cd");
		$this.closest(".categoryList").find("a").removeClass("active");

		// for sp (inherit from damn before company's css)
        $beneathBlock.slideUp(100);
		if (is_sp) {
            if ($this.parent().hasClass('open')) {
            	$this.parent().removeClass('open');
            	return;
            }
            $this.parent().siblings().removeClass('open');
        }
		$.ajax({
            url: "/getSokyuCate2/" + sokyu_cate_cd,
            dataType: 'json',
            success: function(data) {
            	$this.closest(".modal").find(".sokyu_cate2_display .check_all").next("span").html($this.html()+"すべて");
				$this.addClass("active");
                var $target_ul = $this.closest(".modal").find(".categoryListSub");
                $target_ul.empty();

                $current_selected_ul = $this.closest(".modal").find(".choiceList");
                for (var i = 0; i < data.length; i++) {
                	var checked_text = $current_selected_ul.find("li[sokyu_cate_cd="+sokyu_cate_cd+"][sokyu_cate2_cd="+data[i]['sokyu_cate2_cd']+"]").length > 0 ? 'checked' : '';
                	$target_ul.append('<li><label><input type="checkbox" class="checkbox01-input" sokyu_cate_cd="'+sokyu_cate_cd+'" sokyu_cate2_cd="'+data[i]['sokyu_cate2_cd']+'" '+checked_text+'><span class="checkbox01-parts">'+data[i]['sokyu_cate2_nm']+'</span></label></li>');
                }
                $target_ul.parent().find(".check_all").prop('checked', $target_ul.find("[type=checkbox]:checked").length >= $target_ul.find("[type=checkbox]").length && $target_ul.find("[type=checkbox]").length > 0);
            	if (is_sp) {
            		$this.parent().addClass('open');
            		$beneathBlock.css('top', $this.parent().position().top + $this.parent().outerHeight());
            	}
        		$beneathBlock.slideDown(100);
            }
        });
	});

	// Control when user check / uncheck sokyu_cate level 2 checkbox
	$(".categorySearchModal .categoryListSub").on("change", "input[type=checkbox]", function(){
		var sokyu_cate_cd = $(this).attr("sokyu_cate_cd");
		var sokyu_cate2_cd = $(this).attr("sokyu_cate2_cd");

		// update check_all checkbox value
		$target_ul = $(this).closest(".categoryListSub");
		$target_ul.parent().find(".check_all").prop('checked', $target_ul.find("[type=checkbox]:checked").length >= $target_ul.find("[type=checkbox]").length);

		// add to current selected items
		$current_selected_ul = $target_ul.closest(".modal").find(".choiceList");
		$exist_selected_li = $current_selected_ul.find("li[sokyu_cate_cd="+sokyu_cate_cd+"][sokyu_cate2_cd="+sokyu_cate2_cd+"]")
		if ($(this).prop("checked")) {
			// find exist or not in selected list
			if ($exist_selected_li.length == 0) {
				$current_selected_ul.append('<li sokyu_cate_cd="'+sokyu_cate_cd+'" sokyu_cate2_cd="'+sokyu_cate2_cd+'">'+$(this).next("span").html()+'</li>');
			}
		} else {
			$exist_selected_li.remove();
		}
	});

	// User click clear button in Category Search
	$(".categorySearchModal .clearBtn").click(function(e){
		e.preventDefault();
		$(this).closest(".modal").find(".choiceList").empty();
		$(this).closest(".modal").find(".categoryList a").removeClass("active");
		$(this).closest(".modal").find(".categoryList li:first a").addClass("active").trigger("click");
	});

	$("form#material_search_form").submit( function(e) {
		$(this).find(".choiceList li input").remove();
		$(this).find(".choiceList li").each(function(){
			$('<input>').attr({
			    type: 'hidden',
			    name: 's[]',
			    value: $(this).attr('sokyu_cate_cd')
			}).appendTo($(this));
			$('<input>').attr({
			    type: 'hidden',
			    name: 't[]',
			    value: $(this).attr('sokyu_cate2_cd')
			}).appendTo($(this));
		});
        return true;
    });

	$(".sokyubuiSearchModal .clearBtn, .shokutenSearchModal .clearBtn").click(function(e){
		e.preventDefault();
		$(this).closest(".modal").find("input[type=checkbox]").prop("checked", false);
	});

	//////
	// /food
	$(".food .searchCont input#involvedtxt").bind("keyup change", function(e) {
		var search_text = $(this).val();
		$(this).closest(".searchCont").find("ul.involved_ul li").each(function(){
			if ($(this).find("a").html().toLowerCase().indexOf(search_text.toLowerCase()) >= 0) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
    });
	
	///////////////////////////////////////////////////////////
	// call after doc ready
	if (window.innerWidth >= 768) {
		$(".categorySearchModal .categoryList li:first a").addClass("active").trigger("click");
	}

	// POPUP
	$(function(){
		$("#welcome_popup_yes").click(function(){
			localStorage.setItem('welcome_popup', JSON.stringify(true));
			$(this).closest(".popup").fadeOut();
			$(".screen").fadeOut();
		});
		$("#welcome_popup_no").click(function(){
			// localStorage.setItem('welcome_popup', JSON.stringify(false));
			$(this).closest(".popup").fadeOut();
			$(".screen").fadeOut();
			window.location.href = "https://www.google.co.jp/";
		});
	});

	// Reset when storage is more than 3 hours
	var hours = 3;
	var now = new Date().getTime();
	var setupTime = localStorage.getItem('setupTime');
	if (setupTime == null) {
		localStorage.setItem('setupTime', now);
	} else {
		if(now - setupTime > hours*60*60*1000) {
			localStorage.clear();
			localStorage.setItem('setupTime', now);
		}
	}

	// execute when doc is ready
	// if (document.referrer.indexOf('google') !== -1) {
	var welcome_popup_value = localStorage.getItem('welcome_popup') ? JSON.parse(localStorage.getItem('welcome_popup')) : null;
	if (welcome_popup_value == null) {
		$(".popup").fadeIn();
		$(".screen").fadeIn();
	}
	// }
});