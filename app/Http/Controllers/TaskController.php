<?php

namespace App\Http\Controllers;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    private $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function getAll()
    {
        $perPage = request()->input('perPage', 15);
        $tasks = $this->taskService->getAll($perPage);

        return new TaskCollectionResource($tasks);
    }

    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();

        $dto = new CreateTaskDTO(
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending' // заменить на enum
        );
        $task = $this->taskService->create($dto);

        return new TaskResource($task);
    }

    public function getById(int $id)
    {
        $task = $this->taskService->getById($id);

        return new TaskResource($task);

    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $data = $request->validated();

        $data = new UpdateTaskDTO(
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['status'] ?? null
        );

        $task = $this->taskService->update($data, $id);

        return new TaskResource($task);
    }

    public function delete(int $id)
    {
        return $this->taskService->delete($id);
    }
}
