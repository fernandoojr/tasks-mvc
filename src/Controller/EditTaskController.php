<?php

namespace Project\Tasks\Controller;

use Nyholm\Psr7\Response;
use Project\Tasks\Entity\Task;
use Project\Tasks\Repository\TaskRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditTaskController implements RequestHandlerInterface
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $paramId = $request->getQueryParams();
        $id = filter_var($paramId['id'], FILTER_VALIDATE_INT);
        $params = $request->getParsedBody();
        $date = filter_var($params['date']);
        $description = filter_var($params['description']);
        
        $task = new Task(
            id: $id,
            date: $date,
            description: $description,
            completed: false
        );

        if($this->taskRepository->update($task)){
            return new Response(
            status:302,
            headers: ['Location' => '/']
            );
        }
        return new Response(
            status:302,
            headers: ['Location' => '/erro']
            );
    }
}