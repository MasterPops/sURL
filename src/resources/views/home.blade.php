@extends('layouts.app')

@section('content')
 <style>
 .button-box {
   text-align:center;
   margin-top:20px;
}
 </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Панель пользователя</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <center>Ваши ссылки:</center><br>
                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Ссылка</th>
                              <th><center>Сокращение</center></th>
                              <th><center>Переходы</center></th>
                              <th><center>Действие</center></th>
                            </tr>
                          </thead>
                        <tbody>
                  <?php
                      $lastUserPosts = DB::table('urls')
                                                    ->select('url','surl', 'hits','id')
                                                    ->where('user_id', '=', Auth::user()->id)
                                                    ->orderBy('id', 'desk')
                                                    ->get();

                      foreach ($lastUserPosts as $post)
                      {
                        echo '<tr><th scope="row">';
                        echo urldecode($post->url);
                        echo '</th><td>';
                        echo '<a href="' . '/' . $post->surl . '">' . url('/') . '/' . $post->surl . '</a>';
                        echo '</td><td>';
                        echo '<center>' . $post->hits . '</center>';
                        echo '</td><td>
                        <center>
                          <form action="'.url("/", [$post->id]) .'" method="post">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                          </form>
                          </center>
                        </td></tr>
                        ';
                      }

                   ?>

                        </tbody>
                      </table>



                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
