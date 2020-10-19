@include('manage.header')
@include('manage.navi')

<div class="container">
    <!-- alert part -->
    <?php
        if (Session::has('success_message')) {
            $alert_class = 'alert-success';
            $alert_message = Session::get('success_message');
        } elseif (Session::has('fail_message')) {
            $alert_class = 'alert-danger';
            $alert_message = Session::get('fail_message');
        }
    ?>
    @if (isset($alert_message))
        <div class="alert {{ $alert_class }} alert-dismissible">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <strong>{{ $alert_message }}</strong>
        </div>
    @endif

    <!-- validation error part -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- main form -->
    @if (!isset($function) && $mode == 'edit')
        <div class="alert alert-danger">
            <strong>{{ config('message.item_not_found') }}</strong>
        </div>
    @else
        <form action="{{ url('manage/functionality') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('form.input.text_only', ['object' => @$function, 'label' => '機能性食品コード', 'required' => true, 'name' => 'kinosei_cd', 'readonly_all' => true])
            <div class="form-group row">
                <label for="up_contents" class="col-sm-2 col-form-label">原料公開</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="up_contents" value="1" id="up_contents" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($function->up_contents ? 'checked' : '') : (old('up_contents') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="todokede_no" class="col-sm-2 col-form-label required">届出番号</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ ($errors->has('todokede_no')) ? 'is-invalid' : '' }}" id="todokede_no" name="todokede_no" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $function->todokede_no : old('todokede_no') }}">
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('todokede_no')) !!}</div>
                </div>
                <label for="todokede_date" class="col-sm-1 col-form-label text-right">届出日</label>
                <div class="input-group date col-sm-2 date_picker" id="todokede_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#todokede_date" name="todokede_date" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $function->todokede_date : old('todokede_date') }}">
                    <span class="input-group-append" data-target="#todokede_date" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
                <label for="todokede_nm" class="col-sm-1 col-form-label text-right">届出者名</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="todokede_nm" name="todokede_nm" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $function->todokede_nm : old('todokede_nm') }}">
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$function, 'label' => '商品名', 'name' => 'item_nm'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '食品の区分', 'name' => 'shokuhin_kb'])
            <div class="form-group row">
                <label for="henko_date" class="col-sm-2 col-form-label">変更日</label>
                <div class="input-group date col-sm-2 date_picker" id="henko_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#henko_date" name="henko_date" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $function->henko_date : old('henko_date') }}">
                    <span class="input-group-append" data-target="#henko_date" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
                <label for="tekkai_date" class="col-sm-3 col-form-label text-right">撤回日</label>
                <div class="input-group date col-sm-2 date_picker" id="tekkai_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#tekkai_date" name="tekkai_date" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $function->tekkai_date : old('tekkai_date') }}">
                    <span class="input-group-append" data-target="#tekkai_date" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
            </div>
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '表示しようとする機能性', 'name' => 'hyoji_kinosei', 'rows' => 6])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '機能性関与成分名', 'name' => 'kanyo_seibun_nm', 'rows' => 6])
            @include('form.input.multi_checkbox_only', ['object' => @$function, 'label' => '機能性カテゴリ', 'name' => 'kinosei_categories', 'pluck' => 'kinosei_category_cd', 'master_obj_list' => $kinosei_category_master_list, 'master_key' => 'kinosei_category_cd', 'master_value' => 'kinosei_category'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '想定する主な対象者', 'name' => 'taisho'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '安全性の評価方法', 'name' => 'hyoka'])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '生産・製造及び品質管理に関する情報', 'name' => 'info', 'rows' => 6])
            @include('form.input.text_only', ['object' => @$function, 'label' => '機能性の評価方法', 'name' => 'hyoka_hoho'])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '変更履歴', 'name' => 'henko_rireki', 'rows' => 6])
            @include('form.input.text_only', ['object' => @$function, 'label' => '届出撤回の事由', 'name' => 'tekkai_jiyu'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '消費者庁届出情報詳細', 'name' => 'shohi_info'])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '一日の摂取目安量', 'name' => 'meyasu', 'rows' => 3])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '機能性関与成分（含有量）', 'name' => 'kanyo_seibun', 'rows' => 3])
            @include('form.input.textarea_only', ['object' => @$function, 'label' => '機能性関与成分を含む原材料名', 'name' => 'genzairyo_nm', 'rows' => 3])
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">画像</label>
                <div class="col-sm-10">
                    <div class="form-control {{ ($errors->has('pict')) ? 'is-invalid' : '' }}">
                        <img class="col-sm-3" src="{{ isset($function->pict) && $function->pict ? url(config('app.upload_image_folder').'/'.$function->pict) : url('/img/manage/no-image.jpg') }}" alt="">
                        <input type="file" class="d-none" name="pict" value="">
                        <input type="hidden" name="is_updated_pict" value="">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_image_button">画像アップロード</a>
                            <a href="" class="btn btn-danger delete_image_button">削除</a>
                        </div>
                    </div>
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('pict')) !!}</div>
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$function, 'label' => '情報表示するウェブサイト', 'name' => 'hp'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '名称', 'name' => 'meisho'])
            @include('form.input.text_only', ['object' => @$function, 'label' => '販売開始予定日', 'name' => 'hanbai_yotei_date'])
            @include('form.clone.single_control_only', ['object' => @$function, 'label' => 'この原材料を使用している<br>ほかの機能性食品を見る', 'name' => 'kinosei_shokuhin', 'max_element' => 20, 'master_obj_list' => $kinosei_shokuhin_master_list, 'master_key' => 'kinosei_stg_cd', 'master_value' => 'kinosei_stg', 'searchable' => true])
            @include('form.clone.link_control_only', ['object' => @$function, 'label' => 'この原材料を扱っている<br>全てのサプライヤーはこちら', 'url_label' => '原料名', 'url' => 'url_sup', 'url_name' => 'genzairyo_sup', 'url_data' => 'kinosei_suppliers', 'url_info' => 'genryo_mei', 'max_element' => 10])
            @include('form.clone.single_control_only', ['object' => @$function, 'label' => '関与成分から探す', 'name' => 'search_kanyo', 'master_obj_list' => $kinosei_shokuhin_master_list, 'master_key' => 'kinosei_stg_cd', 'master_value' => 'kinosei_stg', 'searchable' => true])
            <div class="form-group row">
                <label for="del_flg" class="col-sm-2 col-form-label">削除</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="del_flg" value="1" id="del_flg" {{ $mode=='edit' && !\Session::has('keep_input') ? ($function->del_flg ? 'checked' : '') : (old('del_flg') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-warning" href="{{ url('manage/functionality') }}">キャンセル</a>
                    <input type="submit" name="{{ $mode }}_mode" class="btn btn-primary" value="登録">
                </div>
            </div>
        </form>
    @endif
</div>

<script>
    $(function(){
        $(".delete_image_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("img").attr('src',"{{ url('/img/manage/no-image.jpg') }}");
            $(this).closest(".form-control").find("input[name=is_updated_pict]").val(1);
            $(this).closest(".form-control").find("input[name=pict]").val('');
        });

        $(".upload_image_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("input[name=pict]").trigger("click");
        });
        $("input[name=pict]").change(function(){
            $(this).closest(".form-control").find("input[name=is_updated_pict]").val(1);
            show_file_to_control(this, $(this).closest(".form-control").find("img"));
        });
    });
</script>