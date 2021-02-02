<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class projectManagerController extends Controller {

    public function index() {
        return view('pm');
    }

    public function getItem($obj, $id) {
        if ($obj == 'user' || $obj == 'level') {
            $condition = ($obj == 'user') ? ['username' => $id] : ['id' => $id];
            return json_encode(DB::table($obj)->where($condition)->get());
        }
        return $this->getTask($id);
    }

    public function getTask($id) {
        $result = DB::table('task')->select('task.*', 'level.id as level_id', 'level.title as level_title')
                ->leftJoin('level_task', 'level_task.task_id', '=', 'task.id')
                ->leftJoin('level', 'level.id', '=', 'level_task.level_id')
                ->get();
        return json_encode($result);
    }

    public function getList($list) {
        if (method_exists($this, $list)) {
            return call_user_func_array(array($this, $list), array());
        }
        return '{}';
        //	return call_user_func_array(array($this, $action), array($param));
    }

    public function users() {
        return json_encode(DB::table('user')->get());
    }

    public function levels() {
        return json_encode(DB::table('level')->get());
    }

    public function tasks() {
        return json_encode(DB::table('task')->get());
    }

    public function adduser(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        try {
            DB::table('user')->insert([
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname
            ]);
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            return json_encode(array('status' => 0));
        }
    }

    public function addlevel(Request $request) {
        $parentid = $request->input('parentid');
        $title = $request->input('title');
        $desc = $request->input('desc');
        try {
            DB::table('level')->insert(
                    [
                        'parentid' => $parentid,
                        'title' => $title,
                        'desc' => $desc
                    ]
            );
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            return json_encode(array('status' => 0));
        }
    }

    public function updatelevel(Request $request) {
        $parentid = $request->input('parentid');
        $title = $request->input('title');
        $desc = $request->input('desc');
        $id = $request->input('id');
        try {
            DB::table('level')
                    ->where(['id' => $id])
                    ->update(
                            [
                                'parentid' => $parentid,
                                'title' => $title,
                                'desc' => $desc
                            ]
            );
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            return json_encode(array('status' => 0));
        }
    }

    public function updateuser(Request $request) {
        $id = $request->input('id');
        $username = $request->input('username');
        $password = $request->input('password');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        try {
            DB::table('user')
                    ->where(['username' => $username])
                    ->update(
                            [
                                'password' => $password,
                                'firstname' => $firstname,
                                'lastname' => $lastname
                            ]
            );
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            return json_encode(array('status' => 0));
        }
    }

    public function addtask(Request $request) {
        $title = $request->input('title');
        $levelId = $request->input('level_id');
        $assignee = $request->input('assignee');
        $duedate = $request->input('duedate');
        $est_hour = $request->input('est_hour');
        $desc = $request->input('desc');
        DB::beginTransaction();
        try {
            $taskId = DB::table('task')->insertGetId([
                'title' => $title,
                'assignee' => $assignee,
                'duedate' => $duedate,
                'est_hour' => $est_hour,
                'desc' => $desc
            ]);
            DB::table('level_task')->insert([
                'level_id' => $levelId,
                'task_id' => $taskId
            ]);
            DB::commit();
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(array('status' => 0));
        }
    }

    public function updatetask(Request $request) {
        $id = $request->input('id');
        $title = $request->input('title');
        $assignee = $request->input('assignee');
        $duedate = $request->input('duedate');
        $est_hour = $request->input('est_hour');
        $desc = $request->input('desc');
        $level_id = $request->input('level_id');
        DB::beginTransaction();
        try {
            DB::table('task')
                    ->where(['id' => $id])
                    ->update(
                            [
                                'title' => $title,
                                'assignee' => $assignee,
                                'duedate' => $duedate,
                                'est_hour' => $est_hour,
                                'desc' => $desc
                            ]
            );
            DB::table('level_task')
                    ->where(['task_id' => $id])
                    ->update(
                            ['level_id' => $level_id]
            );
            DB::commit();
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(array('status' => 0));
        }
    }

    public function deleteItem(Request $request) {
        $id = $request->input('id');
        $table = $request->input('table');
        if (!is_array($id)) {
            $id = (int) $id;
            $id = array($id);
        }
        if ($table == 'level') {
            return $this->deleleLevel($id);
        } elseif ($table == 'task') {
            return $this->deleteTask($id);
        } elseif ($table == 'user') {
            return $this->deleteUser($id);
        }
        //return call_user_func_array(array($this, 'delete'.$table), array($id));
    }

    public function deleteUser($id) {
        $affect = DB::table('user')
                ->whereIn('id', $id)
                ->delete();
        return json_encode(array('status' => 1));
    }

    public function deleteTask($id) {
        DB::beginTransaction();
        try {
            $result = DB::table('level_task')
                    ->whereIn('task_id', $id)
                    ->delete();
            $result = DB::table('task')
                    ->whereIn('id', $id)
                    ->delete();
            DB::commit();
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(array('status' => 0));
        }
    }

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parentid == $parentId) {
                if ($element->type == 'level') {
                    $children = $this->buildTree($elements, $element->id);
                    if ($children) {
                        $element->children = $children;
                    }
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function getAllNodes() {
        $result1 = DB::table('level')->select(DB::raw('id, title, parentid, concat("level") as type'));
        $result = DB::table('task')
                ->select(DB::raw('task.id, task.title, level_task.level_id as parentid, concat("task") as type'))
                ->leftJoin('level_task', 'level_task.task_id', '=', 'task.id')
                ->union($result1)
                ->orderBy('parentid', 'asc')
                ->get();
        $tree = $this->buildTree($result);
        return $tree;
    }

    public function getTreeLevels() {
        $result = DB::table('level')->select(DB::raw('id, title, parentid, concat("level") as type'))
                ->orderBy('parentid', 'asc')
                ->get();
        $tree = $this->buildTree($result);
        return $tree;
    }

    public function getAllChildLevel($id) {
        $id = (int) $id[0];
        $result = DB::select("SELECT @Ids := 
				( SELECT GROUP_CONCAT(`id` SEPARATOR ',') FROM `level` WHERE FIND_IN_SET(`parentid`, @Ids) ) id FROM `level` 
					JOIN (SELECT @Ids := ?) temp1 WHERE FIND_IN_SET(`parentid`, @Ids)", array($id));
        $result = array_map(function ($value) {
            return (int) $value->id;
        }, $result);
        return array_merge(array($id), $result);
    }

    public function deleleLevel($id) {
        DB::beginTransaction();
        try {
            $id = $this->getAllChildLevel($id);
            $ids = implode(',', $id);
            DB::table('task')->select(
                            "SELECT task.id FROM task, level_task 
				WHERE task.id = level_task.task_id and level_task.level_id in (?)", array($ids))
                    ->delete();
            DB::table('level_task')->whereIn('level_id', $id)->delete();
            DB::table('level')->whereIn('id', $id)->delete();
            DB::commit();
            return json_encode(array('status' => 1));
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(array('status' => 0));
        }
    }

}
