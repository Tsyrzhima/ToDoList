<?php

namespace App\Http\Controllers;

use App\DTO\CreateTaskDTO;
use App\DTO\UpdateTaskDTO;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
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

        return new TaskCollection($tasks);
    }

    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();

        $dto = new CreateTaskDTO(
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? 'pending'
        );
        $task = $this->taskService->create($dto);

        return new TaskResource($task);
    }

    public function getById(int $id)
    {
        $task = $this->taskService->getById($id);

        if ($task) {
            return new TaskResource($task);
        }
        return response()->json(['message' => 'Задача не найдена']);

    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        $data = $request->validated();

        $task = $this->taskService->getById($id);
        if($task) {
            $dto = new UpdateTaskDTO(
                $data['title'] ?? null,
                $data['description'] ?? null,
                $data['status'] ?? null
            );
            $task = $this->taskService->update($dto, $id);
            return new TaskResource($task);
        }
        return response()->json(['message' => 'Задача не найдена']);
    }

    public function delete(int $id)
    {
        $result = $this->taskService->delete($id);

        if($result){
            return response()->json(['message' => 'Задача удалена']);
        }else{
            return response()->json(['message' => 'Задача не найдена']);
        }
    }
}
