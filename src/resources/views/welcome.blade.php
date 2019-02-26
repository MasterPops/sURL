<!DOCTYPE HTML>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Short To Url`s</title>
	       <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body
            {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Open Sans', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .top-right
            {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .links > a
            {
                color: #488042;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
       </style>
    </head>
    <body>
		    <header>
            <div class="flex-center position-ref full-height">
              @if (Route::has('login'))
                  <div class="top-right links">
                      @auth
                          <a href="{{ url('/home') }}">Кабинет</a>
                      @else
                          <a href="{{ route('login') }}">Авторизация</a>
                          @if (Route::has('register'))
                              <a href="{{ route('register') }}">Регистрация</a>
                          @endif
                      @endauth
                  </div>
                @endif
                <div class="jumbotron text-center">
                    <h1>Short To Url`s</h1>
                    <p>Просто. Быстро. Коротко.</p>
                </div>
            </header>
            <div class="wrapper container">
	    	    <div class="heading"></div>
                      <form action="/" method="post">
                        <input class="form-control" type='hidden' name='_token' value = "<?php echo csrf_token(); ?>">
                        @if (Route::has('login'))
                          @auth
                        <input class="form-control" type='hidden' name='user_id' value = '{{ Auth::user()->id }}'>
                        @else
                          <input class="form-control" type='hidden' name='user_id' value = '0'>
                          @endauth
                        @endif
		                    <div class="row">
                            <div class="col-md-11">
                                      <div class="form-group">
                                            <input class="form-control" type='text' id='SendLink' name='url' placeholder="Введите ссылку и мы ее быстро сократим">
                                      </div>
		                        </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success">Get Link!</button>
                            </div>
                        </div>
                    </form>
                    @if ($res != 0)
                    <script type="text/javascript">
                    $(window).on('load',function(){
                      $('#myModal').modal('show');
                    });
                  </script>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            @if ($res == 1)
                              <h5 class="modal-title" id="exampleModalLabel">Ссылка добавлена!</h5>
                            @elseif ($res == 2)
                            <h5 class="modal-title" id="exampleModalLabel">Ошибка!</h5>
                            @endif
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @if ($res == 1)
                            Новая ссылка добавлена!<br>
                            <div class="form-group">
                              <input class="form-control" type="text" id="copyText" value='<?php echo url('/');?>/{{$ssurl}}'><br>
                              <center><button type="button" onclick="copyText()" class="btn btn-primary">Копировать ссылку</button><center>
                                <script type="text/javascript">
                                function copyText()
                                {
                                  var copyText = document.getElementById("copyText");
                                  copyText.select();
                                  document.execCommand("copy");
                                }
                              </script>
                              </div>
                            @elseif ($res == 2)
                            Ваша ссылка пустая, как будто в ней души нет...
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    @if (Route::has('login'))
                      @auth
                      <br><center>Ваши последние сокращенные ссылки</center><br>
                        <div class="row">
                          <div class="col-md-8 offset-md-2">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Ссылка</th>
                                  <th><center>Сокращение</center></th>
                                  <th>Переходы</th>
                                </tr>
                              </thead>
                            <tbody>
                      <?php
                          $lastUserPosts = DB::table('urls')
                                                        ->select('url','surl', 'hits')
                                                        ->where('user_id', '=', Auth::user()->id)
                                                        ->orderBy('id', 'desk')
                                                        ->limit(5)
                                                        ->get();

                          foreach ($lastUserPosts as $post)
                          {
                            echo '<tr>
                              <th scope="row">';
                            echo urldecode($post->url);
                            echo '</th>
                              <td>';
                            echo '<a href="' . '/' . $post->surl . '">' . url('/') . '/' . $post->surl . '</a>';
                            echo '</td>
                            <td>';
                          echo '<center>' . $post->hits . '</center>';
                          echo '</td>
                            </tr>';
                          }
                       ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                      @endauth
                    @endif
                    <center>Мы уже сократили {{$count}} url</center>
	            </div>
            </div>
    </body>
</html>
