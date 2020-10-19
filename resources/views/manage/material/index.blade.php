@include('manage.header')
@include('manage.navi')

<div class="container">
    <form action="{{ url('manage/material') }}" method="get">
        <div class="form-group row">
            <label for="item_nm" class="col-sm-2 col-form-label">商品名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="item_nm" name="item_nm" value="{{ old('item_nm') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="ippan_nm" class="col-sm-2 col-form-label">一般名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ippan_nm" name="ippan_nm" value="{{ old('ippan_nm') }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="kigyo_cd" class="col-sm-2 col-form-label">企業</label>
            <div class="col-sm-5">   
                <select class="form-control searchable_select" id="kigyo_cd" name="kigyo_cd">
                    <option value="">&nbsp;</option>
                    @foreach($kigyo_master_list as $kigyo_master)
                        <option value="{{ $kigyo_master->kigyo_cd }}" {{ (old('kigyo_cd') && old('kigyo_cd')==$kigyo_master->kigyo_cd) ? 'selected' : '' }}>{{ $kigyo_master->kigyo_nm }}</option>
                    @endforeach
                </select>
            </div>
            <label for="included_deleted" class="col-sm-2 col-form-label text-right">削除も含む</label>
            <div class="col-sm-1">
                <div class="form-check col-form-label">
                    <input class="form-check-input" type="checkbox" name="included_deleted" value="1" id="included_deleted" {{ old('included_deleted') ? 'checked' : '' }}>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <a href="{{ url('manage/material/create') }}" class="btn btn-primary">新規登録</a>
            </div>
            <div class="col-8 text-right">
                <input type="submit" class="btn btn-primary" name="search_mode" value="検索">
                <button class="btn btn-warning btnClear">クリア</button>
            </div>
        </div>
    </form>

    <!-- top pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $material_list])

    <!-- search result -->
    <table class="search-result-table table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="width:10%">原料ID</th>
                <th scope="col" style="width:30%">商品名</th>
                <th scope="col" style="width:35%">一般名</th>
                <th scope="col" style="width:20%">原料資料</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($material_list as $material)
                <tr>
                    <th scope="row"><a class="btn btn-link" href="{{ url('/manage/material/'.$material->genryo_id.'/edit') }}">{{ $material->genryo_id }}</a></th>
                    <td>{{ $material->item_nm }}</td>
                    <td>{{ $material->ippan_nm }}</td>
                    <td>
                        @if(isset($material->path) && $material->path)
                            <a class="doc-url" href="{{url($material->path)}}" target="_blank">{{explode('.', $material->path, 2)[1]}}</a>
                        @endif
                    </td>
                    <td>{{ $material->del_flg ? '削除' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- bottom pagination bar -->
    @include('utils.pagination_nav', ['pagination_list' => $material_list])

    <div class="text-right">
        <a href="{{ url('manage') }}" class="btn btn-primary">戻る</a>
    </div>
</div>