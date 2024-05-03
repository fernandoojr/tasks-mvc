<?php

namespace Project\Tasks\Controller;

use Nyholm\Psr7\Response;
use Project\Tasks\Repository\TaskRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteTaksController implements RequestHandlerInterface
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
        if($id === null || $id === false){
            return new Response(
                status: 302,
                headers: ['Location' => '/'] 
            );
        }
        if($this->taskRepository->delete($id)){
            return new Response(
                status: 302,
                headers: ['Location' => '/'] 
            );
        }
        return new Response(
            status: 302,
            headers: ['Location' => '/'] 
        );
    }
}