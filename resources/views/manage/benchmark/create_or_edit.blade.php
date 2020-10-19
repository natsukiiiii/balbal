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
    @if (!isset($benchmark) && $mode == 'edit')
        <div class="alert alert-danger">
            <strong>{{ config('message.item_not_found') }}</strong>
        </div>
    @else
        <form action="{{ url('manage/benchmark') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => 'ベンチマークコード', 'required' => true, 'name' => 'bench_cd', 'readonly_all' => true])
            <div class="form-group row">
                <label for="keisai_date" class="col-sm-2 col-form-label">掲載日</label>
                <div class="input-group date col-sm-4 date_picker" id="keisai_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#keisai_date" name="keisai_date" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $benchmark->keisai_date : old('keisai_date') }}">
                    <span class="input-group-append" data-target="#keisai_date" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">パッケージ（画像）</label>
                <div class="col-sm-10">
                    <div class="form-control {{ ($errors->has('top_pic')) ? 'is-invalid' : '' }}">
                        <img class="col-sm-3" src="{{ isset($benchmark->top_pic) && $benchmark->top_pic ? url(config('app.upload_image_folder').'/'.$benchmark->top_pic) : url('/img/manage/no-image.jpg') }}" alt="">
                        <input type="file" class="d-none" name="top_pic" value="">
                        <input type="hidden" name="is_updated_pict" value="">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_image_button">画像アップロード</a>
                            <a href="" class="btn btn-danger delete_image_button">削除</a>
                        </div>
                    </div>
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('top_pic')) !!}</div>
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '販売者名', 'name' => 'hanbai_nm'])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '商品名', 'name' => 'item_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$benchmark, 'label' => '剤型', 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '一日目安量', 'name' => 'meyasu', 'col' => 4])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '通常価格', 'name' => 'kn', 'col' => 4])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => 'お徳用価格', 'name' => 'sale_kn', 'col' => 4])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '一日単価', 'name' => 'day_kn', 'col' => 4])
            @include('form.input.textarea_only', ['object' => @$benchmark, 'label' => '主成分（裏面表示通り）', 'name' => 'shuseibun', 'rows' => 3])
            @include('form.input.textarea_only', ['object' => @$benchmark, 'label' => '原材料名', 'name' => 'genzairyo_nm', 'rows' => 3])
            @include('form.input.textarea_only', ['object' => @$benchmark, 'label' => '一日有効成分量', 'name' => 'yukoseibun', 'rows' => 3])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '重量（粒・包）', 'name' => 'juryo'])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '内容量', 'name' => 'naiyoryo'])
            @include('form.input.multi_checkbox_only', ['object' => @$benchmark, 'label' => '目的カテゴリー', 'name' => 'mokuteki_categories1', 'pluck' => 'mokuteki_cate_cd', 'master_obj_list' => $mokuteki_cate_master_list, 'master_key' => 'mokuteki_cate_cd', 'master_value' => 'mokuteki_cate_nm','limit' => 5])
            @include('form.input.dropdown_data_only', ['object' => @$benchmark, 'label' => '種類', 'name' => 'shurui','col' => 3, 'master_obj_list' => $shurui_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$benchmark, 'label' => '関連サイト　外部リンク', 'name' => 'site'])
            @include('form.input.textarea_only', ['object' => @$benchmark, 'label' => '商品の特徴', 'name' => 'tokucho', 'rows' => 6])
            @include('form.clone.single_control_only', ['object' => @$benchmark, 'label' => 'この原材料を使用している<br>他の健康食品を見る', 'name' => 'benchmark_genryo','searchable' => true, 'master_obj_list' => $seibun_master_list, 'master_key' => 'seibun_cd', 'master_value' => 'seibun_nm', 'pluck' => 'seibun_cd'])
            @include('form.clone.link_control_only', ['object' => @$benchmark, 'label' => 'この原材料を扱っているサプライヤーを見る', 'url_label' => '原料名', 'url' => 'url_sup', 'url_name' => 'genzairyo_sup', 'url_data' => 'benchmark_suppliers', 'url_info' => 'genryo_mei'])
            
            <div class="form-group row">
                <label for="del_flg" class="col-sm-2 col-form-label">削除</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="del_flg" value="1" id="del_flg" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($benchmark->del_flg ? 'checked' : '') : (old('del_flg') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-warning" href="{{ url('manage/benchmark') }}">キャンセル</a>
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
            $(this).closest(".form-control").find("input[name=top_pic]").val('');
        });

        $(".upload_image_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("input[name=top_pic]").trigger("click");
        });
        $("input[name=top_pic]").change(function(){
            $(this).closest(".form-control").find("input[name=is_updated_pict]").val(1);
            show_file_to_control(this, $(this).closest(".form-control").find("img"));
        });
    });
</script>