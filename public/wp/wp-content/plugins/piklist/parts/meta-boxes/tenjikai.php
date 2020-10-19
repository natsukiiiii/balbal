<?php
/*
Title: 展示会の情報
Post Type: tenjikai
*/

piklist('field', [
    'type' => 'select',
    'field' => 'area',
    'label' => '開催エリア',
    'choices' => [
        '国内' => [
            '札幌' => '札幌',
            '千葉' => '千葉',
            '東京' => '東京',
            '横浜' => '横浜',
            '金沢' => '金沢',
            '名古屋' => '名古屋',
            '長浜' => '長浜',
            '大阪' => '大阪',
            '京都' => '京都',
            '神戸' => '神戸',
            '福岡' => '福岡',
            '北九州' => '北九州',
            '熊本' => '熊本',
        ],
        '海外' => [
            '中国' => '中国',
            'アジア' => 'アジア',
            '中東' => '中東',
            '欧州' => '欧州',
            '北米' => '北米',
            '南米' => '南米',
        ],
    ],
    'columns' => 4,
]);

piklist('field', [
    'type' => 'datepicker',
    'field' => 'start_date',
    'label' => '開催日程開始日',
    'value' => date('Y年m月d日', time() + 604800), // set default value
    'options' => [
        'dateFormat' => 'yy年mm月dd日',
        'monthNames'=> ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        'monthNamesShort'=> ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        'dayNames'=> ['日','月','火','水','木','金','土'],
        'dayNamesShort'=> ['日','月','火','水','木','金','土'],
        'dayNamesMin'=> ['日','月','火','水','木','金','土'],
        'yearSuffix'=> '年',
        'weekHeader'=> '週',
        'showMonthAfterYear'=> true,
    ],
    'columns' => 3,
]);

piklist('field', [
    'type' => 'datepicker',
    'field' => 'end_date',
    'label' => '開催日程終了日',
    'value' => date('Y年m月d日', time() + 604800), // set default value
    'options' => [
        'dateFormat' => 'yy年mm月dd日',
        'monthNames'=> ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        'monthNamesShort'=> ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        'dayNames'=> ['日','月','火','水','木','金','土'],
        'dayNamesShort'=> ['日','月','火','水','木','金','土'],
        'dayNamesMin'=> ['日','月','火','水','木','金','土'],
        'yearSuffix'=> '年',
        'weekHeader'=> '週',
        'showMonthAfterYear'=> true,
    ],
    'columns' => 3,
]);

piklist('field', [
    'type' => 'text',
    'field' => 'event_time',
    'label' => '時間',
    'description' => '例: 10:00～17:00 （3日間）',
    'columns' => 12,
]);

piklist('field', [
    'type' => 'textarea',
    'field' => 'name',
    'label' => '展示会名称',
    'attributes' => [
        'rows' => 3,
        'cols' => 200,
    ]
]);

piklist('field', [
    'type' => 'url',
    'field' => 'home_page',
    'label' => '公式HP　ボタン',
    'columns' => 12,
]);

piklist('field', [
    'type' => 'url',
    'field' => 'test_page',
    'label' => '事前登録　ボタン',
    'columns' => 12,
]);