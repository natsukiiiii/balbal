<?php
    $total_page = $pagination_list->lastPage();
    $current_page = $pagination_list->currentPage();
    $number_show = min(5, $total_page);
    $from = $current_page - floor($number_show / 2);
    $to = $from + $number_show - 1;
    if ($from < 1) {
        $from = 1;
        $to = $number_show;
    } elseif ($to > $total_page) {
        $to = $total_page;
        $from = $to - $number_show + 1;
    }
?>
@if ($pagination_list->total() > 0 && $total_page > 1)
    <ul class="pageList pc">
        @if ($current_page > 1)
            <li class="next">
                <a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page - 1)) }}">&lt;<br class="pc"><span class="pc">前へ</span></a>
            </li>
        @endif
        @for ($i = $from; $i <= $to; $i++)
            @if ($i == $current_page)
                <li class="active">{{ $i }}</li>
            @else
                <li><a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $i)) }}">{{ $i }}</a></li>
            @endif
        @endfor
        @if ($current_page < $total_page)
            <li class="next">
                <a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page + 1)) }}">&gt;<br class="pc"><span class="pc">次へ</span></a>
            </li>
        @endif
    </ul>
    <ul class="pageList sp">
        @if ($current_page > 1)
            <li class="last"><a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', 1)) }}">&lt;&lt;</a></li>
            <li class="next"><a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page - 1)) }}">&lt;</a></li>
        @endif
        <li class="nowPage">ページ{{ $current_page }}</li>
        @if ($current_page < $total_page)
            <li class="next"><a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page + 1)) }}">&gt;</a></li>
            <li class="last"><a href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $total_page)) }}">&gt;&gt;</a></li>
        @endif
    </ul>
@endif