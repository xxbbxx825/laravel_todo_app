<!doctype html>
<html lang="ja">
  <head>
    <title>todo_app</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body>
    <div class="container" style="margin-top:50px;">
    <h1>タスク編集</h1>

    <form action='{{ url('/tasks',$task->id) }}' method="post">
      {{csrf_field()}}
      {{ method_field('patch')}}
  <div class="form-group">
    <input type="text" name="title"class="form-control" value="{{ $task->title }}" style="max-width:1000px;">
    <p>ステータス</p>
    <label><input type="radio" name="state" value="完了" class="form-control" style="max-width:1000px;">完了</label><br>
    <label><input type="radio" name="state" value="未了" class="form-control" style="max-width:1000px;">未了</label>
  </div>
  <button type="submit" class="btn btn-primary">更新</button>
</form>

</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>

</script>
  </body>
</html>
