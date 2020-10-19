@include('manage.header')
@include('manage.navi')

<div class="container">
    <form action="{{ url('manage/functionality') }}" method="get">
        <div class="form-group row">
            <label for="item_nm" class="col-sm-2 col-form-label">商品名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item_nm" name="item_nm" value="{{ old('item_nm') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="todokede_no" class="col-sm-2 col-form-label">届出番号</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="todokede_no" name="todokede_no" value="{{ old('todokede_no') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="todokede_nm" class="col-sm-2 col-form-label">届出者名</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="todokede_nm" name="todokede_nm" value="{{ old('todokede_nm') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="included_deleted" class="col-sm-2 col-form-label">削除も含む</label>
            <div class="col-sm-10">
                <div class="form-check col-form-label">
                    <input class="form-check-input" type="checkbox" name="included_deleted" value="1" id="included_deleted" {{ old('included_deleted') ? 'checked' : '' }}>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <a href="{{ url('manage/functionality/create') }}" class="btn btn-primary">新規登録</a>
            </div>
            <div class="col-8 text-right">
                <input type="submit" class="btn btn-primary" value="検索">
                <button class="btn btn-warning btnClear">クリア</button>
            </div>
        </div>
    </form>

    <!-- top pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $function_list])

    <!-- search result -->
    <table class="search-result-table table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="width:13%">届出番号</th>
                <th scope="col" style="width:30%">商品名</th>
                <th scope="col" style="width:50%">機能性カテゴリ</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($function_list as $function)
                <tr>
                    <th scope="row"><a class="btn btn-link" href="{{ url('/manage/functionality/'.$function->kinosei_cd.'/edit') }}">{{ $function->todokede_no }}</a></th>
                    <td>{{ $function->item_nm }}</td>
                    <td>{!! implode('、', $function->kinosei_categories->pluck('kinosei_category')->toArray()) !!}</td>
                    <td>{{ $function->del_flg ? '削除' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- bottom pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $function_list])

    <div class="text-right">
        <a href="{{ url('manage') }}" class="btn btn-primary">戻る</a>
    </div>
</div>