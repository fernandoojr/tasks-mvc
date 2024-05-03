<?php

namespace Project\Tasks\Controller;

use Nyholm\Psr7\Response;
use Project\Tasks\Repository\TaskRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TaskStatusController implements RequestHandlerInterface
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {  
        $this->taskRepository = $taskRepository;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $id = filter_var($params['id'], FILTER_VALIDATE_INT);
        $status = filter_var($params['status'], FILTER_VALIDATE_BOOL);

        $this->taskRepository->alterStatus($id, $status);

        return new Response(
            status: 302,
            headers: ['Location' => '/']
        );
    }
}