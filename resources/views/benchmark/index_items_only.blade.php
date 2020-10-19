@foreach ($benchmark_list as $benchmark)
	<li>
		<a href="{{ url('benchmark/detail/'.$benchmark->bench_cd) }}" draggable="true" ondragstart="drag(event)" id="drag_id_{{ $benchmark->bench_cd }}">
			<div class="listTitle">&nbsp;@include('utils.data_list', ['object' => @$benchmark, 'name' => 'zaikei', 'master_obj_list' => $zaikei_bench_master_list, 'master_key' => 'code', 'master_value' => 'code_nm', 'delimiter' => '・'])</div>
			<div class="imgArea">
				<img src="{{ isset($benchmark->top_pic) && $benchmark->top_pic ? url(config('app.upload_image_folder').'/'.$benchmark->top_pic) : url('/img/manage/no-image.jpg') }}" alt="{{ $benchmark->item_nm }}" id="drag_id_{{ $benchmark->bench_cd }}">
				<p class="date">掲載⽇ {{ $benchmark->keisai_date }}</p>
			</div>
			<div class="txtBox">
				<p class="foodName">{{ $benchmark->item_nm }}</p>
				<p class="itemName">主成分</p>
				<p class="itemTxt">{!! nl2br(e($benchmark->shuseibun)) !!}</p>
				<p class="officeName">{{ $benchmark->hanbai_nm }}</p>
			</div>
		</a>
	</li>
@endforeach