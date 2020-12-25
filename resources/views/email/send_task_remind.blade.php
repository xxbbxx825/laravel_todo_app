@isset($overDueTask)
<p>以下のタスクの期限がすぎています。</p>
<p>タスク名：{{ $overDueTask->title }}</p>
<p>期限：{{ $overDueTask->due }}</p>

@endisset
@isset($nearDueTask)
<p>以下のタスクは明日が期限日です。</p>
<p>タスク名：{{ $nearDueTask->title }}</p>
<p>期限：{{ $nearDueTask->due }}</p>
@endisset
