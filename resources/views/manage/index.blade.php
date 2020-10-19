@include('manage.header')
@include('manage.navi')
<div class="container">
	@if (@$msg)
		<div class="alert alert-success">
			<button class="close" type="button" data-dismiss="alert">×</button>
			<strong>Success!</strong> {{ @$msg }}.
		</div>
	@endif
	<div class="row mt-4">
		<div class="col-sm text-center">
			<a href="{{ url('manage/company') }}" class="btn btn-primary btn-block">企業マスタ</a>
    	</div>
	    <div class="col-sm text-center">
	    	<a href="{{ url('manage/material') }}" class="btn btn-primary btn-block">原料マスタ</a>
	    </div>
	    <div class="col-sm text-center">
	     	<a href="{{ url('manage/functionality') }}" class="btn btn-primary btn-block">機能性表示食品マスタ</a>
	    </div>
    </div>
    <div class="row mt-4">
		<div class="col-sm text-center">
			<a href="{{ url('manage/benchmark') }}" class="btn btn-primary btn-block">ベンチマークマスタ</a>
    	</div>
	    <div class="col-sm text-center">
	    	<a href="{{ url('wp/wp-admin') }}" class="btn btn-danger btn-block">Wordrpess</a>
	    </div>
		<div class="col-sm text-center">
			<a href="{{ url('https://user.list-finder.jp/login') }}" class="btn btn-primary btn-block">List Finder</a>
    	</div>
	</div>
	<div class="row mt-4">
		<div class="col-sm text-center">
			<a href="{{ url('https://www12.webcas.net/mail/menu') }}" class="btn btn-primary btn-block">WEBCAS</a>
    	</div>
	    <div class="col-sm text-center">&nbsp;</div>
	    <div class="col-sm text-center">&nbsp;</div>
    </div>
</div>