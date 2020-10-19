<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{ url('manage/') }}">バルバル管理システム</a></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <div class="p-2 text-dark" href="#">ログインID: {{ Auth::user()->name }}</div>
  </nav>
  <a class="btn btn-outline-primary" href="{{ url('manage/logout') }}">ログアウト</a>
</div>