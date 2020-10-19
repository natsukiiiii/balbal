<?php
return [
	'cache_timeout' => 2592000, // 30 days

	'quick_basic_auth' => collect([
		['balbal_user','bal-bal'],
   ]),

	'seibun_mei_map' => [
		'あ' => ['あ','い','う','え','お'],
		'か' => ['か','き','く','け','こ'],
		'さ' => ['さ','し','す','せ','そ'],
		'た' => ['た','ち','つ','て','と'],
		'な' => ['な','に','ぬ','ね','の'],
		'は' => ['は','ひ','ふ','へ','ほ'],
		'ま' => ['ま','み','む','め','も'],
		'や' => ['や','ゆ','よ'],
		'ら' => ['ら','り','る','れ','ろ'],
		'わ' => ['わ','を','ん'],
	],

	'flg' => [
		'yes' => 1,
		'no' => 0,
	],

	'material' => [
		'search_by_text' => [
			'default' => '原料一覧',
			'suffix' => ' に分類される原料とその販売企業一覧',
		],
		'search_from' => [
			'default' => '原料探す',
			'sokyukoka' => '訴求効果から探す',
			'sokyubui' => '訴求部位から探す',
			'seibunmei' => '成分名から探す',
			'yoto' => '用途から探す',
			'keyword' => 'キーワードから探す',
		],
	],

	'food' => [
		'search_by_text' => [
			'default' => '',
			'suffix' => ' に分類される機能性表示食品一覧',
		],
	],

	'benchmark' => [
		'search_by_text' => [
			'default' => '',
			'suffix' => ' に関連するサプリメント⼀覧',
		],
	],

	'session_key' => [
		'material_search_from_breadcrumb_text' => 'material_search_from_breadcrumb_text',
		'material_last_search_url' => 'material_last_search_url',
	],
];