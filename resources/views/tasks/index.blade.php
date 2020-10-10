<!doctype html>
<html lang="ja">
  <head>
    <title>Jum Todoリスト</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" style="margin-top:50px;">
    <h1>タスク追加</h1>
    <form action='{{ url('/tasks')}}' method="post">
      {{csrf_field()}}
  <div class="form-group">
    <input type="text" name="title"class="form-control" style="max-width:1000px;">
  </div>
  <button type="submit" class="btn btn-primary">追加</button>  </form>

    <h1 style="margin-top:50px;">タスク一覧</h1>
    <table class="table table-striped" style="max-width:1000px; margin-top:20px;">
  <tbody>
      <tr>
          <td></td>
          <td>作成日</td>
          <td>更新日</td>
      </tr>
    @foreach ($tasks as $task)
    <tr>
      <td>{{$task->title}}</td>
      <td>{{$task->created_at->format('Y年m月d日') }}</td>
      <td>{{$task->updated_at->format('Y年m月d日') }}</td>
      <td><form action="{{ action('App\Http\Controllers\TasksController@edit', $task) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('get') }}
          <button type="submit" class="btn btn-primary">編集</button>
      </form>
      </td>

      <td><form action="{{url('/tasks', $task->id)}}" method="post">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <button type="submit" class="btn btn-danger">削除</button>
      </form>
      </td>


    </tr>
    @endforeach
  </table>
</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>

</script>
  </body>
</html>
