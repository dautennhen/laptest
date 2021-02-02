<html>
<div>TO DO</div>
	{{ $list->count() }}
	{{ $list->first() }}
	<br />
	<h3>Looking for in current collection with id=2</h3>
	{{ $list->find(2) }}
	<br />
	------------ {{ $user->count() }}
</html>