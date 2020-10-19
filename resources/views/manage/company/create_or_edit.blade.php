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
    @if (!isset($company) && $mode == 'edit')
        <div class="alert alert-danger">
            <strong>{{ config('message.item_not_found') }}</strong>
        </div>
    @else
        <form action="{{ url('manage/company') }}" method="post">
            {{ csrf_field() }}
            @include('form.input.text_only', ['object' => @$company, 'label' => '企業ID', 'required' => true, 'name' => 'kigyo_cd', 'readonly_all' => true])
            @include('form.input.text_only', ['object' => @$company, 'label' => '企業名', 'required' => true, 'name' => 'kigyo_nm'])
            @include('form.input.text_only', ['object' => @$company, 'label' => '所在地', 'required' => true, 'name' => 'address'])
            <div class="form-group row">
                <label for="tel" class="col-sm-2 col-form-label required">Tel</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control {{ ($errors->has('tel')) ? 'is-invalid' : '' }}" id="tel" name="tel" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $company->tel : old('tel') }}">
                    <div class="invalid-feedback">{!! implode('<br>', $errors->get('tel')) !!}</div>
                </div>
                <label for="fax" class="col-sm-2 col-form-label text-right">Fax</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="fax" name="fax" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $company->fax : old('fax') }}">
                </div>
            </div>
            @include('form.input.text_only', ['object' => @$company, 'label' => '企業HP', 'name' => 'kigyo_hp'])
            @include('form.input.text_only', ['object' => @$company, 'label' => '担当者', 'name' => 'tantosha'])
            @include('form.input.text_only', ['object' => @$company, 'label' => '備考・メモ欄', 'name' => 'biko'])
            <div class="form-group row">
                <label for="keiyaku_date" class="col-sm-2 col-form-label">契約日</label>
                <div class="input-group date col-sm-4 date_picker" id="keiyaku_date" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#keiyaku_date" name="keiyaku_date" value="{{ $mode=='edit' && !\Session::has('keep_input') ? $company->keiyaku_date : old('keiyaku_date') }}">
                    <span class="input-group-append" data-target="#keiyaku_date" data-toggle="datetimepicker">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="del_flg" class="col-sm-2 col-form-label">削除</label>
                <div class="col-sm-10">
                    <div class="form-check col-form-label">
                        <input class="form-check-input" type="checkbox" name="del_flg" value="1" id="del_flg" {{ $mode=='edit' && !\Session::has('keep_input') ? ($company->del_flg ? 'checked' : '') : (old('del_flg') ? 'checked' : '') }}>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-right">
                    <a class="btn btn-warning" href="{{ url('manage/company') }}">キャンセル</a>
                    <input type="submit" name="{{ $mode }}_mode" class="btn btn-primary" value="登録">
                </div>
            </div>
        </form>
    @endif
</div>