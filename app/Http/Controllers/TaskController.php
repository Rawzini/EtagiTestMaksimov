<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
            'description' => 'required|string',
            'expirationDate' => 'required|date_format:d-m-Y H:i:s',
            'priority' => 'max:255|string',
            'status' => 'max:255|string',
            'creator_id' => 'required|integer',
            'responsible_id' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $task = Task::create([
            'title' => $validatedData->validated()['title'],
            'description' => $validatedData->validated()['description'],
            'expirationDate' => $validatedData->validated()['expirationDate'],
            'priority' => $validatedData->validated()['priority'],
            'status' => $validatedData->validated()['status'],
            'creator_id' => $validatedData->validated()['creator_id'],
            'responsible_id' => $validatedData->validated()['responsible_id'],
        ]);

        $task->save();

        return response()->json('Task created. Id: '.$task->id, 201);
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()
                ->json('Not found task with Id: '.$id, 404);
        }

        $validatedData = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
            'description' => 'required|string',
            'expirationDate' => 'required|date_format:d-m-Y H:i:s',
            'priority' => 'max:255|string',
            'status' => 'max:255|string',
            'creator_id' => 'required|integer',
            'responsible_id' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }


        $task->title = $validatedData->validated()['title'];
        $task->description = $validatedData->validated()['description'];
        $task->expirationDate = $validatedData->validated()['expirationDate'];
        $task->priority = $validatedData->validated()['priority'];
        $task->status = $validatedData->validated()['status'];
        $task->creator_id = $validatedData->validated()['creator_id'];
        $task->responsible_id = $validatedData->validated()['responsible_id'];


        $task->save();

        return response('',204);
    }

    public function getTasks(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            'time' => 'integer|nullable',
            'subordinate' => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $time = $validatedData->validated()['time'] ?? null;
        $subordinate = $validatedData->validated()['subordinate'] ?? null;

        $selectString = [
            'tasks.id as id',
            'title',
            'description',
            'priority',
            'expirationDate as date',
            'surname',
            'name',
            'patronymic',
            'status',
            'responsible_id',
            'updateDate'
        ];

        $groupByFuncName = '';

        $tasksBuilder = Task::leftJoin('users', 'tasks.responsible_id', '=', 'users.id')
            ->select($selectString)
            ->orderByDesc('updateDate');

        if ($time !== null) {
            $tasksBuilder = $tasksBuilder
                ->where('expirationDate', '>=', Carbon::now());

            $groupByFuncName .= 'bydate';

            if ($time !== 0) {
                $tasksBuilder = $tasksBuilder
                    ->where('expirationDate', '<=', Carbon::now()->addDays($time));
            }
        }

        $whereInConditions = [$id];

        switch ($subordinate) {
            case 'subordinates':
                $whereInConditions = app(UserController::class)->getSubordinatesIds($id);
                $groupByFuncName .= 'byname';
                break;
            case 'all':
                array_push($whereInConditions, app(UserController::class)->getAllSubordinatesIds($id));
                break;
            case 'my':
                break;
            default:
                return response()
                    ->json('Second variable should be \'my\', \'all\', or \'subordinates\'', 400);
                break;
        }

        $tasksBuilder = $tasksBuilder
            ->whereIn('responsible_id', $whereInConditions);

        $tasks = $tasksBuilder->get();

        function bydatebyname($item) {
            return $item->groupBy([
                function ($item) {
                    return Carbon::parse($item->date)->format('d-m-Y');
                },
                function ($item) {
                    return $item['surname'].' '.$item['name'].' '.$item['patronymic'];
                }
            ], $preserveKeys = true);
        }

        function byname($item) {
            return $item->groupBy([
                function ($item) {
                    return $item['surname'].' '.$item['name'].' '.$item['patronymic'];
                }
            ], $preserveKeys = true);
        }

        function bydate($item) {
            return $item->groupBy([
                function ($item) {
                    return Carbon::parse($item->date)->format('d-m-Y');
                }
            ], $preserveKeys = true);
        }

        switch ($groupByFuncName) {
            case 'bydatebyname':
                $tasks = bydatebyname($tasks);
                break;
            case 'byname':
                $tasks = byname($tasks);
                break;
            case 'bydate':
                $tasks = bydate($tasks);
                break;
        }

        if ($tasks->isEmpty())
            return response()->json('Data not found', 404);

        return response()
            ->json($tasks, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

