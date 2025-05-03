<?php

namespace App\Services;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Models\Task;


// Логики пока нет, на будущее
class TaskService
{
    public function getAll(int $perPage = 15)
    {
        return Task::paginate($perPage);
    }

    public function create(CreateTaskDTO $data): Task
    {
        $task = Task::create($data->toArray());

        return $task;
    }

    public function getById(int $id): ?Task
    {
        $task = Task::find($id);

        if($task){
            return $task;
        }else{
            return null;
        }
    }

    public function update(UpdateTaskDTO $data, int $id): ?Task
    {
        $task = Task::find($id);

        if($task){
            $task->update($data->toArray());
            return $task;
        }else
        {
            return null;
        }
    }

    public function delete(int $id): bool
    {
        $task = Task::query()->find($id);

        if($task){
            $task->delete();
            return true;
        }else
        {
            return false;
        }
    }
}
