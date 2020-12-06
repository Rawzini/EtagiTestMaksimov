<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('subordinates')->get();
        return $users;
    }

    public function getSubordinatesIds($id)
    {
        $ids = User::select('id')
            ->where('leader_id', $id)
            ->get();

        $idsArray = [];
        foreach ($ids as $item){
            $idsArray[] = $item['id'];
        }
        return $idsArray;
    }

    public function getAllSubordinatesIds($id, &$idsArray = null)
    {
        $ids = User::select('id')
            ->where('leader_id', $id)
            ->get();

        static $idsArray = [];
        foreach ($ids as $item){
            $this->getAllSubordinatesIds($item['id'], $idsArray);
            $idsArray[] = $item['id'];
        }
        return $idsArray;
    }

    public function getAllSubordinates($id, &$idsArray = null)
    {
        $ids = User::select('id', 'name', 'surname')
            ->where('leader_id', $id)
            ->get();

        static $idsArray = [];
        foreach ($ids as $item){
            $this->getAllSubordinatesIds($item['id'], $idsArray);
            $idsArray[$item['id']] = $item['surname'].' '.$item['name'];
        }
        return $idsArray;
    }

    public function info($id)
    {
        $info = $this->getAllSubordinates($id);

        if (count($info)) {
            $result['isHead'] = true;
        } else {
            $result['isHead'] = false;
        }

        $user = User::find($id);
        $info[$id] = $user['surname'].' '.$user['name'];
        $result['creatable'] = $info;

        $headId = $user->leader_id;
        $taskConditions = [
            ['creator_id', '=', $headId],
            ['responsible_id', '=', $id],
        ];
        $headTasks = Task::where($taskConditions)
            ->get();

        $headTasksIdArray = [];
        foreach ($headTasks as $hT)
            $headTasksIdArray[] = $hT->id;

        $result['headTasksIds'] = $headTasksIdArray;

        return response()
            ->json($result, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
