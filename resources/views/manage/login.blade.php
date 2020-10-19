@include('manage.header')
<body>
    <div id="login">
        <h3 class="text-center text-info pt-5 pb-5">バルバル管理システム</h3>
        <div class="container">

        	@if (Session::has('error'))
   				<div class="alert alert-danger alert-dismissible">
					<button class="close" type="button" data-dismiss="alert">×</button>
					<strong>{{ Session::get('error') }}</strong>
				</div>
   			@endif

   			@if (count($errors) > 0)
			<div class="alert alert-danger">
     			<ul>
    				@foreach($errors->all() as $error)
    					<li>{{ $error }}</li>
    				@endforeach
     			</ul>
    		</div>
   			@endif

            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ url('/manage/login') }}" method="post">
                        	{{ csrf_field() }}
                            <div class="form-group">
                                <label for="user_id" class="text-info">ログインID</label><br>
                                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">パスワード</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group text-center pt-5">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="ログイン">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>