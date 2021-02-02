<html>
<div>Users</div>
<ul>
@foreach($users as $user)
  <li>{{ $user->name }}</li>
@endforeach
</ul>
</html>