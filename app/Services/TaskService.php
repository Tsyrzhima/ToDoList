<?php

namespace App\Services;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Models\Task;


// Логики пока нет, на будущее

class TaskService
{
    public function getAll(int $perPage)
    {
        return Task::paginate($perPage);
    }

    public function create(CreateTaskDTO $data): Task
    {
        return Task::create($data->toArray());
    }

    public function getById(int $id): ?Task
    {
        return Task::query()->findOrFail($id);
    }

    public function update(UpdateTaskDTO $data, int $id): Task
    {
        $task = Task::query()->findOrFail($id);
        $task->update($data->toArray());
        return $task;
    }

    public function delete(int $id)
    {
        return Task::destroy($id);
    }
}
