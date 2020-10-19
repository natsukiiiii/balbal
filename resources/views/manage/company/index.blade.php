@include('manage.header')
@include('manage.navi')

<div class="container">
    <form action="{{ url('manage/company') }}" method="get">
        <div class="form-group row">
            <label for="kigyo_nm" class="col-sm-2 col-form-label">企業名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kigyo_nm" name="kigyo_nm" value="{{ old('kigyo_nm') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label">所在地</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="contract_date" class="col-sm-2 col-form-label">契約日</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="input-group date col-sm-5 date_picker" id="keiyaku_date_from" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#keiyaku_date_from" name="keiyaku_date_from" value="{{ old('keiyaku_date_from') }}">
                        <span class="input-group-append" data-target="#keiyaku_date_from" data-toggle="datetimepicker">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </span>
                    </div>
                    <div class="col-xs-1 col-form-label">~</div>
                    <div class="input-group date col-sm-5 date_picker" id="keiyaku_date_to" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#keiyaku_date_to" name="keiyaku_date_to" value="{{ old('keiyaku_date_to') }}">
                        <span class="input-group-append" data-target="#keiyaku_date_to" data-toggle="datetimepicker">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <a href="{{ url('manage/company/create') }}" class="btn btn-primary">新規登録</a>
            </div>
            <div class="col-8 text-right">
                <input type="submit" class="btn btn-primary" value="検索">
                <button class="btn btn-warning btnClear">クリア</button>
            </div>
        </div>
    </form>

    <!-- top pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $company_list])

    <!-- search result -->
    <table class="search-result-table table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="width:13%">企業ID</th>
                <th scope="col" style="width:40%">企業名</th>
                <th scope="col" style="width:40%">所在地</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($company_list as $company)
                <tr>
                    <th scope="row"><a class="btn btn-link" href="{{ url('/manage/company/'.$company->kigyo_cd.'/edit') }}">{{ $company->kigyo_cd }}</a></th>
                    <td>{{ $company->kigyo_nm }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->del_flg ? '削除' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- bottom pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $company_list])

    <div class="text-right">
        <a href="{{ url('manage') }}" class="btn btn-primary">戻る</a>
    </div>
</div>