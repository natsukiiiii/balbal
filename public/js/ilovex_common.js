function show_file_to_control(input, display_control) {
    display_control.closest(".form-control").removeClass("is-invalid");
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            display_control.attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function do_select2(object, additional_class="") {
    object.select2({ 
        height: '500px', 
        language: {
            "noResults": function(){
                return "見つかりません";
            }
        },
        containerCssClass: additional_class,
    });
}

function count_remain(object) {
    $text_count_limit = object.closest('.form-group').find(".text_count_limit");
    if ($text_count_limit.length > 0) {
        var line_count = object.val().split(/\r\n|\r|\n/).length;
        var remain_length = $text_count_limit.html() - object.val().length - (line_count - 1);
        // console.log(object.val().replace(/(\r\n|\n|\r)/g,"  ").length);
        if (remain_length < 0) {
            object.val(object.val().substring(0, parseInt($text_count_limit.html()) + remain_length));

            // one more time check
            line_count = object.val().split(/\r\n|\r|\n/).length;
            remain_length = $text_count_limit.html() - object.val().length - (line_count - 1);
            if (remain_length < 0) {
                object.val(object.val().slice(0, -1));                
            }

            remain_length = 0;
        }
        $text_count_limit.next(".text_count_limit_remain").html(remain_length);
    }
}

function updateSokyuCate(level, $src_sokyu_koka) {
    var $target_select = $src_sokyu_koka.parent().find("select[name='sokyu_koka" + level + "[]']");
    $target_select.empty();
    $target_select.append('<option value="">&nbsp;</option>');

    $.ajax({
        url: "/getSokyuCate" + level + "/" + $src_sokyu_koka.val(),
        dataType: 'json',
        success: function(data) {
            
            var select_id = null;
            if ($target_select.attr("select_id")) {
                select_id = $target_select.attr("select_id");
                $target_select.removeAttr("select_id");
            }
            
            for (var i = 0; i < data.length; i++) {
                var selected_text = (data[i]['sokyu_cate' + level + '_cd'] == select_id) ? 'selected' : '';
                $target_select.append('<option value="' + data[i]['sokyu_cate' + level + '_cd'] + '" '
                    + selected_text + '>' 
                    + data[i]['sokyu_cate' + level + '_nm'] + '</option>');
            }
            if (level < 3) {
                updateSokyuCate(level + 1, $target_select);
            }
        }
    });
}

function add_sokyu_koka_event_listener($object) {
    $manual_searchable_select_element = $object.find("select.manual_searchable_select");
    if ($manual_searchable_select_element.length > 0) {
        do_select2($manual_searchable_select_element, 'mr-1');
    }
    $object.find("select[name='sokyu_koka1[]']").change(function(){
        updateSokyuCate(2, $(this));
    });
    $object.find("select[name='sokyu_koka2[]']").change(function(){
        updateSokyuCate(3, $(this));
    });
    $object.find("select[name='sokyu_koka1[]']").trigger("change");
}

$(function () {
    /////////////////////////////////////////////////
    // other control
    $('.date_picker').datetimepicker({
        format: 'YYYY/MM/DD',
        locale: 'ja',
    });
    do_select2($(".searchable_select"));
    /////////////////////////////////////////////////
    // multi_element controll
    $(".multi_element_add_button").click(function(e){
        e.preventDefault();
        
        $multi_element_base = $(this).closest(".form-control").find('.multi_element_base');
        // validation
        var count = $(this).parent().siblings(".multi_element").length;
        var limit = $multi_element_base.attr('max_element');
        if (count + 1 > limit) {
            $(this).removeClass("btn-primary").addClass("btn-secondary");
        } else {
            if (count + 1 == limit) {
                $(this).removeClass("btn-primary").addClass("btn-secondary");
            }
            // process
            $new_element = $multi_element_base.clone();
            $new_element.removeClass("multi_element_base").removeClass("d-none").addClass("multi_element");
            $new_element.find("[name]").attr('disabled', false);
            $new_element.insertBefore($(this).parent());
            
            // add additional special abilities
            add_sokyu_koka_event_listener($new_element);
        }
    });
    $('.multi_element').each(function(){
        add_sokyu_koka_event_listener($(this));
    });
    $(".form-control").on("click", ".multi_element_delete_button", function(e){
        e.preventDefault();
        if ($(this).closest(".form-control").find('.multi_element').length <= $(this).closest(".form-control").find('.multi_element_base').attr('max_element')) {
            $(this).closest(".form-control").find('.multi_element_add_button').removeClass("btn-secondary").addClass("btn-primary");
        }
        $(this).closest('.multi_element').remove();
    });
    /////////////////////////////////////////////////
    // button control
	$('.btnClear').click(function(e){
		e.preventDefault();
        $(this).closest('form').find("input[type=text], textarea").val("");
        $(this).closest('form').find("input[type=checkbox]").prop('checked', false);
        $(this).closest('form').find("select").val([]);
    });
    $('.btnBack').click(function(e){
    	e.preventDefault();
        window.history.back();
    });
    /////////////////////////////////////////////////
    // validation control
    $("input.is-invalid").bind("keyup change", function(e) {
        $(this).removeClass('is-invalid');
    });
    /////////////////////////////////////////////////
    // word count control
    $("input").bind("keyup change click contextmenu input", function(e) {
        count_remain($(this));
    });
    $("textarea").bind("keyup change click contextmenu input", function(e) {
        count_remain($(this));
    });
    $(".form-group input, .form-group textarea").each(function(){
        count_remain($(this));
    });
    /////////////////////////////////////////////////
    // check-box limit control

    var do_limit_selected = function(this_object){
        $limit_number = this_object.siblings(".limit_number").html();
        if (this_object.find('input[type="checkbox"]:checked').length >= $limit_number) {
          this_object.find('input[type="checkbox"]:not(:checked)').prop('disabled', true);
        } else {
          this_object.find('input[type="checkbox"]:not(:checked)').prop('disabled', false);
        }
    }

    $(".limit-selected").on('change', function(e){
        do_limit_selected($(this));
    });
    $(".limit-selected").each(function(){
        do_limit_selected($(this));
    });
});