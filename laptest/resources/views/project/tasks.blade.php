<html>
<h1>{{ $company }}</h1>
<div>Our Tasks</div>
<ul>
@foreach($tasks as $task)
  <li>{{ $task['name'] }}</li>
@endforeach
</ul>
</html>