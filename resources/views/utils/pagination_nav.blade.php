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
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            @if ($current_page > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page - 1)) }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                </li>
            @endif
            @for ($i = $from; $i <= $to; $i++)
                @if ($i == $current_page)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $i)) }}">{{ $i }}</a></li>
                @endif
            @endfor
            @if ($current_page < $total_page)
                <li class="page-item">
                    <a class="page-link" href="{{ url()->current() }}?{{ http_build_query(array_add(array_except(Request::query(), 'page'), 'page', $current_page + 1)) }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                </li>
            @endif
        </ul>
    </nav>
@endif