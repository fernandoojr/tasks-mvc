<?php

namespace Project\Tasks\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Project\Tasks\Entity\Task;
use Project\Tasks\Repository\TaskRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
class TaskFormController implements RequestHandlerInterface
{
    private Engine $templates;
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository, Engine $templates)
    {
        $this->taskRepository = $taskRepository;
        $this->templates = $templates;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = null;
        if(array_key_exists('id', $queryParams)){
            $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
        }
        if(is_null($id) || $id === false){
            $task = null;
        }else{
            $task = $this->taskRepository->find($id);
        }
        return new Response(
            status: 200,
            body: $this->templates->render('task-form', ['task' => $task])
        );
    }
}