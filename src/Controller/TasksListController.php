<?php

namespace Project\Tasks\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Project\Tasks\Repository\TaskRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TasksListController implements RequestHandlerInterface
{
    private Engine $templates;
    private TaskRepository $taskRepository;
    public function __construct(Engine $templates, TaskRepository $taskRepository)
    {
        $this->templates = $templates;
        $this->taskRepository = $taskRepository;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $taskList = $this->taskRepository->all();
        return new Response(
            status: 200,
            body: $this->templates->render(
                'tasks-list',
                ['taskList' => $taskList])
        );
    }
}