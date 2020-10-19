$(function(){
    var target = '';
    $(".search-btn").click(function(e){
        e.preventDefault();
        // Get the second class of "btn" class
        target = $(this).get(0).className.split(" ")[1];
        // Set the target modal window
        target = $(".modal." + target);
        // Show modal window
        var w = window.innerWidth;
        if (w < 768) {
            if ( target.is(":hidden") ) {
                $('.modal').hide();
                target.slideDown(100);
                $(".container").addClass("bg-blur");
            } else {
                target.slideUp(100);
                $(".container").removeClass("bg-blur");
            }
            $(this).toggleClass('open');
        } else {
            if ( target.is(":hidden") ) {
                target.fadeIn(100);
                $(".container").addClass("bg-blur");
            } else {
                target.hide();
                $(".container").removeClass("bg-blur");
            }
        }
        $('.menuOverlay').fadeToggle();
        return false;  
    });
  
    // Hide modal window
    $(".close ,.menuOverlay").click(function(){
        $(".modal").fadeOut();
        $('.menuOverlay').fadeOut();
    });
    
    $(window).on('resize', function(){
        var w = window.innerWidth;
        if (w > 767) {
            $('.beneathBlock').removeAttr('style');
        }
    });
	
	
    $(".food .search-btn").click(function(){
        var target2 = $(this).get(0).className.split(" ")[1];
        target2 = $(".aco." + target2);
        if ( target2.is(":hidden") ) {
            $(".aco").hide();
            target2.slideDown(100);
        } else {
            target2.slideUp(100);
        }
    });
    
$(function() {
    $('.txt:contains("Enterococcus faecalis")').each(function() {
        var mojiretsu = $(this).html();
        $(this).html(mojiretsu.replace(/Enterococcus faecalis/g,'<p class="txtitalic">Enterococcus faecalis</p>'));
    });
});

});