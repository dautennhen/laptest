<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher as Event;
//use App\Events\Event;
//use Illuminate\Support\Facades\Event as Event;
//use App\Listeners\UserEventSubscriber;

use App\Events\OrderEvent as OrderEvent;
//use Illuminate\Http\Response;
//use App\Http\Controllers\Controller;
use App\Models\Todolist as Todolist;
//use App\Models\Profile as Profile;
use App\Models\User as User;
use App\Models\Item as Item;
//use App\Models\Todoitem as Todoitem;
use App\Models\Workingday as Workingday;

/* class FooBar {
  public function __construct(Baz $baz) {
  $this->baz = $baz;
  }
  } */

class toDoController extends BaseController {

    public function __construct() {
        $this->middleware('iplogger');
        /* App::bind('cuser', function($app) {
          return new Todoitem;
          }); 
        App::singleton('cuser', function() {
            return new Todoitem;
        });*/
        //$request->session()->put('key', 'value');
        $event = new Event;
        $event->fire('testmoreevent', array(['user'=>'noone']));
    }

    public function toDoList() {
        $data = [
            'name' => 'ghjk',
            'description' => 'Things to do before leaving for vacation'
        ];
        $obj = new Todolist($data);
        $error = $obj->validate();
        if (empty($error)) {
            $obj->save();
        }
        return json_encode([
            'status' => !$error,
            'message' => $error,
            'data' => ''
        ]);
    }

    public function allTodoList() {
        $obj = new Todolist();
        $objUser = new User();
        //$list = $obj->all();
        $list = $obj->paginate(3);
        $user = $objUser->paginate(3);
        //Todolist::take(5)->orderBy('created_at', 'desc')->get();
        //$user = $objUser->find(1);//->username;
        //var_dump($user);
        //exit()
        return view('todo.todo')
                        ->with('list', $list)
                        ->with('user', $user);
    }

    public function addUserProfile() {
        $list = new Todolist();

        $item = new Item;
        $item->telephone = '614-867-5309';
        $item->name = 'the name';

        $anList = $list->find(2);
        $result = $anList->item()->save($item);
        return $result;
    }

    public function removeUserProfile() {
        $list = new Todolist;
        //$item = new Item;

        $anList = Todolist::find(1);
        return $anList->item()->delete();
    }

    public function getTodolistbyItem() {
        //$item = new Item;
        //$email = $item->where('telephone', '614-867-5309')
        //	->get()->first();//->todolist->name;
        $email = Item::where('telephone', '614-867-5309')
                        ->get()->first(); //->todolist->name;
        return $email->name;
    }

    public function createTodoitem() {
        $list = Todolist::find(1);
        
        //$item = new Todoitem;
        $item = App::make('cuser');

        $item->name = 'Walk the dog';
        $item->description = 'Walk Barky the Mutt';
        $list->multiItem()->save($item);

        /* $item->name = 'Do that';
          $item->description = 'Make it fun';
          $list->multiItem()->save($item); */
        return '';
    }

    public function findList() {
        $list = Todolist::find(1);
        return $list->multiItem;
    }

    public function manymany() {
        $aList = Todolist::find(1);

        $aDay = new Workingday(array('unknown' => 'Vacation'));

        $aList->workingdays()->save($aDay);
        return $aDay;
    }

    public function manymanyrevert() {
        $aDay = Workingday::find(1);

        $aList = new Todolist([
            'name' => 'ghjk',
            'description' => 'Things to do before leaving for vacationhaha dd'
        ]);

        $result = $aDay->todolists()->save($aList);
        return $result;
    }

    public function detachattachmanymany() {
        $aList = Todolist::find(1);
        $aDay = Workingday::find(1);
        //return $aList->workingdays()->detach(Workingday::find(2));
        //return $aDay->todolists()->detach([6,7,8]);
        //$list->categories()->attach(5);
        //$list->categories()->attach([3,4]);
        //$list->categories()->save($category);
        //return $aDay;
        return count($aList->workingdays);
    }

    public function updateTodolist($id, ListFormRequest $request) {
        $list = Todolist::find($id);
        $list->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        return \Redirect::route('lists.edit', array($list->id))->with('message', 'Your list has been updated!');
    }

    //Todolist::destroy($id);

    public function createForm() {
        echo session('variableName', 'dddddd');
        return view('todo.form');
    }

    public function editForm($id) {
        $data = Workingday::find($id);
        //return $data;
        return view('todo.formedit')->with('data', $data);
    }

    public function storeForm(Request $request) {
        $data = [
            'unknown' => $request->input('unknown')
        ];
        $obj = new Workingday($data);
        $error = $obj->validate();
        if (empty($error)) {
            $obj->save();
            $message = 'Good job';
        } else {
            $message = implode('<br />', $error);
        }
        return \Redirect::route('createform')
                        ->with('message', $message);
    }

    public function checkResponse() {
        $content = json_encode(['a' => 'value']);
        return response($content, 404)
                        ->header('Content-Type', 'haha type');
    }
    
    public function testEvent() {
        $item = App::make('cuser');
        $item = $item->find(1);
        event(new OrderEvent($item));
        return 'do that';
    }
    
    public function testMoreEvent(Event $event) {
        $item = App::make('subscriber');
        echo $item->subscribe($event);
        
        
        
        /*$array = array('foo' => 'bar');
        $array = array_add($array, 'key', 'value');
        
        print_r($array);
        */
        $array = array('abc1'=>'abc','names' => array('joe' => array('programmer')));
        //$array = array_forget($array, 'names.joe');
        //$value = array_get($array, 'names.joe');
        $value = array_set($array, 'names.editor', 'Taylor');
        //dd($value);
        $camel = camel_case('foo bar');
        $value = ends_with('This is my name name1', 'name');
        //dd($value);
        echo '<br />';
        $url = action('toDoController@createForm', ['name'=>'unknown']);
        echo  $url;
        echo '<br />';
        echo secure_url('foo/bar',['name'=>'unknown']);
        echo '<br />';
        
        $urlaa = value(function() { return 'bar'; });
        echo $urlaa;
        echo '<br />--';
        
        $value = with(new Todolist)->attributes;
        dd($value);
        return 'do that again';
    }

}