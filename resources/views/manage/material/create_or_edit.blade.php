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
    @if (!isset($material) && $mode == 'edit')
        <div class="alert alert-danger">
            <strong>{{ config('message.item_not_found') }}</strong>
        </div>
    @else
        <form action="{{ url('manage/material') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row mb-4">
                <div class="col-12 text-right">
                    <a class="btn btn-warning" href="{{ url('manage/material') }}">キャンセル</a>
                    <input type="submit" name="{{ $mode }}_mode" class="btn btn-primary" value="登録">
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$material, 'label' => '原料ID', 'required' => true, 'name' => 'genryo_id', 'readonly_all' => true])
            <div class="form-group row">
                <label for="up_contents" class="col-sm-2 col-form-label">原料公開</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="up_contents" value="1" id="up_contents" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($material->up_contents ? 'checked' : '') : (old('up_contents') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="top_random" class="col-sm-2 col-form-label">ランダム公開</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="top_random" value="1" id="top_random" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($material->top_random ? 'checked' : '') : (old('top_random') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>
            @include('form.input.number_only', ['object' => @$material, 'label' => '表示順','name' => 'hyojijun','min'=>'-2000000000', 'max' => '2000000000'])
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">TOP画像</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->top_pic) && $material->top_pic ? url(config('app.upload_image_folder').'/'.$material->top_pic) : url('/img/manage/no-image.jpg') }}" alt="">
                        <input type="file" class="d-none" name="top_pic" value="">
                        <input type="hidden" name="is_updated_pict" value="{{ isset($material->top_pic) && $material->top_pic ? '' : 1 }}">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_image_button">画像アップロード</a>
                            <a href="" class="btn btn-danger delete_image_button">削除</a>
                        </div>
                    </div>
                    <!-- <div class="invalid-feedback">{!! implode('<br>', $errors->get('top_pic')) !!}</div> -->
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$material, 'label' => '一言特徴','name' => 'hitokoto', 'text_count_limit' => 80])
            @include('form.input.text_only', ['object' => @$material, 'label' => '商品概要タイトル','name' => 'item_gaiyo_title', 'text_count_limit' => 50, 'default_create_mode_text' => '商品概要'])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '商品概要', 'name' => 'item_gaiyo', 'rows' => 6, 'text_count_limit' => 1000])
            @include('form.input.text_only', ['object' => @$material, 'label' => '商品名', 'required' => true, 'name' => 'item_nm'])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '一般名', 'required' => true, 'name' => 'ippan_nm', 'rows' => 2])
            @include('form.input.text_only', ['object' => @$material, 'label' => '一般名のカナ名', 'required' => true, 'name' => 'ippan_nm_kana'])
            @include('form.input.multi_radio_only', ['object' => @$material, 'label' => '販売主体', 'name' => 'hanbai_shutai','required' => true, 'master_obj_list' => $hanbai_shutai_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.dropdown_data_only', ['object' => @$material, 'label' => '企業', 'name' => 'kigyo_cd','required' => true,'searchable' => true,'col' => 5, 'master_obj_list' => $kigyo_master_list, 'master_key' => 'kigyo_cd', 'master_value' => 'kigyo_nm'])
            @include('form.clone.single_control_only', ['object' => @$material, 'label' => '成分名', 'name' => 'seibun_nm', 'searchable' => true, 'master_obj_list' => $seibun_master_list, 'master_key' => 'seibun_cd', 'master_value' => 'seibun_nm'])
            <div class="form-group row">
                <label for="sokyu_koka" class="col-sm-2 col-form-label">訴求効果</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <div class="form-check-inline col-sm-9 ml-1 p-2 multi_element_base d-none" >
                            <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka1[]" disabled>
                                @foreach($sokyu_cate_master_list as $sokyu_cate_master)
                                    <option value="{{ $sokyu_cate_master->sokyu_cate_cd }}">{{ $sokyu_cate_master->sokyu_cate_nm }}</option>
                                @endforeach
                            </select>
                            <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka2[]" disabled></select>
                            <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka3[]" disabled></select>
                            <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
                        </div>
                        <?php
                            $sokyu_cate_list = $mode=='edit' && !\Session::has('keep_input') ? $material->sokyu_categories : @array_map(function($sokyu_koka1, $sokyu_koka2, $sokyu_koka3){
                                    return (object) [
                                        'sokyu_cate_cd' => $sokyu_koka1,
                                        'sokyu_cate2_cd' => $sokyu_koka2,
                                        'sokyu_cate3_cd' => $sokyu_koka3,
                                    ];
                            }, old('sokyu_koka1'), old('sokyu_koka2'), old('sokyu_koka3'));
                        ?>
                        @if (isset($sokyu_cate_list))
                            @foreach ($sokyu_cate_list as $sokyu_cate)
                                <div class="form-check-inline col-sm-9 ml-1 p-2 multi_element" >
                                    <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka1[]">
                                        @foreach($sokyu_cate_master_list as $sokyu_cate_master)
                                            <option value="{{ $sokyu_cate_master->sokyu_cate_cd }}" {{ $sokyu_cate_master->sokyu_cate_cd == $sokyu_cate->sokyu_cate_cd ? 'selected' : '' }}>{{ $sokyu_cate_master->sokyu_cate_nm }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka2[]" select_id="{{ $sokyu_cate->sokyu_cate2_cd }}"></select>
                                    <select class="form-control col-sm-3 manual_searchable_select" name="sokyu_koka3[]" select_id="{{ $sokyu_cate->sokyu_cate3_cd }}"></select>
                                    <div class="col-sm-2 text-right"><a href="" class="btn btn-danger multi_element_delete_button">削除</a></div>
                                </div>
                            @endforeach
                        @endif
                        <div class="text-right">
                            <a href="" class="btn btn-primary multi_element_add_button">追加</a>
                        </div>
                    </div>
                </div>
            </div>
            @include('form.clone.single_control_only', ['object' => @$material, 'label' => '食添・食添製剤での用途', 'name' => 'shokuten','searchable' => true, 'master_obj_list' => $shokuten_master_list, 'master_key' => 'yoto_cate_cd', 'master_value' => 'yoto_cate_nm'])
            @include('form.input.dropdown_data_only', ['object' => @$material, 'label' => '機能性表示食品対応状況', 'name' => 'jokyo','required' => true,'col' => 3, 'master_obj_list' => $jokyo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '想定するヘルスクレーム', 'name' => 'sotei_hc', 'rows' => 6])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '関与成分', 'name' => 'kanyo', 'rows' => 3])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '規格成分', 'name' => 'kikaku', 'rows' => 3])
            @include('form.input.text_only', ['object' => @$material, 'label' => '有効成分名のカナ名', 'name' => 'yoko_seibun_kana'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '原材料表示例', 'required' => true, 'name' => 'genryo_ex'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '英語名', 'name' => 'en_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '内容量', 'required' => true, 'name' => 'naiyo'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '供給体制　複可', 'name' => 'kyokyu', 'master_obj_list' => $kyokyu_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '製造メーカー', 'name' => 'seizo_maker'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '賞味期限', 'name' => 'shomi_kigen'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '使用上の注意', 'name' => 'warning'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '区分　複可', 'name' => 'kubun','required' => true, 'master_obj_list' => $kubun_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '添加物使用基準', 'name' => 'tenka_kijun'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'おすすめ剤型　複可', 'name' => 'zaikei', 'master_obj_list' => $zaikei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'チャイナ', 'name' => 'chaina', 'master_obj_list' => $chaina_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '海外での使用実績　複可', 'name' => 'kaigai','required' => true, 'master_obj_list' => $kaigai_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'ペット向け　複可', 'name' => 'pet','required' => true, 'master_obj_list' => $pet_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '特許', 'name' => 'tokkyo'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '商標・ロゴマーク', 'name' => 'shohyo_logo', 'master_obj_list' => $shohyo_logo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ロゴアップロード1</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->logo_pic1) && $material->logo_pic1 ? url(config('app.upload_image_folder').'/'.$material->logo_pic1) : url('/img/manage/no-image.jpg') }}" alt="">
                        <input type="file" class="d-none" name="logo_pic1" value="">
                        <input type="hidden" name="is_updated_logo1" value="{{ isset($material->logo_pic1) && $material->logo_pic1 ? '' : 1 }}">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_logo1_button">画像アップロード</a>
                            <a href="" class="btn btn-danger delete_logo1_button">画像削除</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ロゴアップロード2</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->logo_pic2) && $material->logo_pic2 ? url(config('app.upload_image_folder').'/'.$material->logo_pic2) : url('/img/manage/no-image.jpg') }}" alt="">
                        <input type="file" class="d-none" name="logo_pic2" value="">
                        <input type="hidden" name="is_updated_logo2" value="{{ isset($material->logo_pic2) && $material->logo_pic2 ? '' : 1 }}">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_logo2_button">画像アップロード</a>
                            <a href="" class="btn btn-danger delete_logo2_button">画像削除</a>
                        </div>
                    </div>
                </div>
            </div>
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '性状', 'name' => 'seijo','required' => true, 'master_obj_list' => $seijo_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '水への溶解性　複可', 'name' => 'suiyosei','required' => true, 'master_obj_list' => $suiyosei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '油への溶解性　複可', 'name' => 'yuyosei','required' => true, 'master_obj_list' => $yuyosei_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'アレルギー物質　複可', 'name' => 'allergie','required' => true, 'master_obj_list' => $allergie_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'GMO情報', 'name' => 'gmo_info','required' => true, 'master_obj_list' => $gmo_info_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '原生薬比', 'name' => 'genseiyaku_hi'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '一日摂取目安', 'name' => 'sesshu'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '安全性データ', 'name' => 'anzen_data','required' => true, 'master_obj_list' => $anzen_data_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '自社保有エビデンス', 'name' => 'evidence','required' => true, 'master_obj_list' => $evidence_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => 'トクホ素材', 'name' => 'tokuho', 'master_obj_list' => $tokuho_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '訴求部位　複可', 'name' => 'sokyu_bui', 'master_obj_list' => $sokyu_bui_master_list, 'master_key' => 'sokyu_bui_cd', 'master_value' => 'sokyu_bui_nm'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '由来', 'name' => 'yurai'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '使用部位', 'name' => 'siyo_bui'])
            @include('form.clone.single_control_only', ['object' => @$material, 'label' => '原産国(主成分)', 'name' => 'gensankoku','required' => true,'searchable' => true, 'master_obj_list' => $gensankoku_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.clone.single_control_only', ['object' => @$material, 'label' => '最終加工国(県)', 'name' => 'saishu_koku','required' => true,'searchable' => true, 'master_obj_list' => $saishu_koku_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.clone.link_control_only', ['object' => @$material, 'label' => '関連リンク', 'url_label' => 'リンク名', 'url' => 'url', 'url_name' => 'link_mei', 'url_data' => 'genryo_links', 'url_info' => 'link_mei'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '認証名', 'name' => 'ninsho_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '認証ロゴ　ハラル&コーシャ以外', 'name' => 'ninsho_logo', 'master_obj_list' => $ninsho_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            @include('form.input.multi_checkbox_only', ['object' => @$material, 'label' => '認証ロゴ　ハラル&コーシャ', 'name' => 'ninsho_logo_halal', 'master_obj_list' => $ninsho_halal_kosher_master_list, 'master_key' => 'code', 'master_value' => 'code_nm'])
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">資料アップロード</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->path) && $material->path ? url('/img/manage/doc-image.png') : url('/img/manage/file-image.png') }}" alt="">
                        <label class="doc-name"></label>
                        @if(isset($material->path) && $material->path)
                            <a class="doc-url" href="{{url($material->path)}}" target="_blank">{{sizeof(explode('/', $material->path)) > 1 ? url(explode('/', $material->path)[0].'/'.explode('/', $material->path)[1].'/'.explode('.', $material->path, 2)[1]) : explode('.', $material->path, 2)[1]}}</a>
                        @endif

                        <input type="file" class="d-none" name="path" value="">
                        <input type="hidden" name="is_updated_path" value="">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_doc_button">資料アップロード</a>
                            <a href="" class="btn btn-danger delete_doc_button">資料削除</a>
                        </div>
                    </div>
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('path')) !!}</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">資料アップロード2</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->path2) && $material->path2 ? url('/img/manage/doc-image.png') : url('/img/manage/file-image.png') }}" alt="">
                        <label class="doc-name"></label>
                        @if(isset($material->path2) && $material->path2)
                            <a class="doc-url" href="{{url($material->path2)}}" target="_blank">{{sizeof(explode('/', $material->path2)) > 1 ? url(explode('/', $material->path2)[0].'/'.explode('/', $material->path2)[1].'/'.explode('.', $material->path2, 2)[1]) : explode('.', $material->path2, 2)[1]}}</a>
                        @endif

                        <input type="file" class="d-none" name="path2" value="">
                        <input type="hidden" name="is_updated_path2" value="">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_doc_button">資料アップロード</a>
                            <a href="" class="btn btn-danger delete_doc_button">資料削除</a>
                        </div>
                    </div>
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('path2')) !!}</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">資料アップロード3</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <img class="col-sm-3" src="{{ isset($material->path3) && $material->path3 ? url('/img/manage/doc-image.png') : url('/img/manage/file-image.png') }}" alt="">
                        <label class="doc-name"></label>
                        @if(isset($material->path3) && $material->path3)
                            <a class="doc-url" href="{{url($material->path3)}}" target="_blank">{{sizeof(explode('/', $material->path3)) > 1 ? url(explode('/', $material->path3)[0].'/'.explode('/', $material->path3)[1].'/'.explode('.', $material->path3, 2)[1]) : explode('.', $material->path3, 2)[1]}}</a>
                        @endif

                        <input type="file" class="d-none" name="path3" value="">
                        <input type="hidden" name="is_updated_path3" value="">
                        <div class="text-right">
                            <a href="" class="btn btn-primary upload_doc_button">資料アップロード</a>
                            <a href="" class="btn btn-danger delete_doc_button">資料削除</a>
                        </div>
                    </div>
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('path3')) !!}</div>
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$material, 'label' => 'ListFinder　URL<br>お問い合わせ', 'name' => 'lf_url'])
            @include('form.input.text_only', ['object' => @$material, 'label' => 'ListFinder　URL<br>資料DL', 'name' => 'lf_url_dl'])
            @include('form.input.text_only', ['object' => @$material, 'label' => 'ListFinder　URL<br>無償サンプル依頼', 'name' => 'lf_url_sample'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '動画 iframe URL', 'name' => 'video_iframe_src'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '動画タイトル', 'name' => 'video_title', 'text_count_limit' => 100])
            @include('form.input.text_only', ['object' => @$material, 'label' => '動画注意事項', 'name' => 'video_note', 'text_count_limit' => 100, 'default_create_mode_text' => '全編ご覧になりたい方はパスワードが必要です、申請フォーム入力後パスワードをお送りします。'])
            @include('form.input.text_only', ['object' => @$material, 'label' => '動画再生時間', 'name' => 'video_duration'])
            @include('form.input.textarea_only', ['object' => @$material, 'label' => '動画文章詳細', 'name' => 'video_text_content', 'rows' => 4, 'text_count_limit' => 150])
            @include('form.input.text_only', ['object' => @$material, 'label' => '動画リストファインダー入力', 'name' => 'video_get_password_url'])
            <div class="form-group row">
                <label for="rec_genryo" class="col-sm-2 col-form-label">おすすめ原料</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="rec_genryo" value="1" id="rec_genryo" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($material->rec_genryo ? 'checked' : '') : (old('rec_genryo') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="del_flg" class="col-sm-2 col-form-label">削除</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="del_flg" value="1" id="del_flg" {{ ($mode=='edit' && !\Session::has('keep_input')) ? ($material->del_flg ? 'checked' : '') : (old('del_flg') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-warning" href="{{ url('manage/material') }}">キャンセル</a>
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
        $(".upload_image_button, .upload_logo1_button, .upload_logo2_button, .upload_doc_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("input").trigger("click");
        });
        $("input[name=top_pic]").change(function(){
            $(this).closest(".form-control").find("input[name=is_updated_pict]").val(1);
            show_file_to_control(this, $(this).closest(".form-control").find("img"));
        });
        $("input[name=logo_pic1]").change(function(){
            $(this).closest(".form-control").find("input[name=is_updated_logo1]").val(1);
            show_file_to_control(this, $(this).closest(".form-control").find("img"));
        });
        $(".delete_logo1_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("img").attr('src',"{{ url('/img/manage/no-image.jpg') }}");
            $(this).closest(".form-control").find("input[name=is_updated_logo1]").val(1);
            $(this).closest(".form-control").find("input[name=logo_pic1]").val('');
        });
        $("input[name=logo_pic2]").change(function(){
            $(this).closest(".form-control").find("input[name=is_updated_logo2]").val(1);
            show_file_to_control(this, $(this).closest(".form-control").find("img"));
        });
        $(".delete_logo2_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("img").attr('src',"{{ url('/img/manage/no-image.jpg') }}");
            $(this).closest(".form-control").find("input[name=is_updated_logo2]").val(1);
            $(this).closest(".form-control").find("input[name=logo_pic2]").val('');
        });
        $(".delete_doc_button").click(function(e){
            e.preventDefault();
            $(this).closest(".form-control").find("img").attr('src',"{{ url('/img/manage/file-image.png') }}");
            $(this).closest(".form-control").find("input[name^=is_updated_path]").val(1);
            $(this).closest(".form-control").find("label").text("");
            $(this).closest(".form-control").find(".doc-url").text("");
            $(this).closest(".form-control").find("input[name^=path]").val('');
        });
        $("input[name^=path]").change(function(){
            $(this).closest(".form-control").find("input[name^=is_updated_path]").val(1);
            $(this).closest(".form-control").find("img").attr('src',"{{ url('/img/manage/doc-image.png') }}");
            $file = this.files[0].name;
            $(this).closest(".form-control").find("label").text($file);
            $(this).closest(".form-control").find(".doc-url").text("");
        });
    });
</script>