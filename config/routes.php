<?php

use Project\Tasks\Controller\DeleteTaksController;
use Project\Tasks\Controller\EditTaskController;
use Project\Tasks\Controller\NewTaskController;
use Project\Tasks\Controller\TaskFormController;
use Project\Tasks\Controller\TasksListController;
use Project\Tasks\Controller\TaskStatusController;

return[
    'GET|/' => TasksListController::class,
    'GET|/excluir' => DeleteTaksController::class,
    'GET|/status' => TaskStatusController::class,
    'GET|/nova' => TaskFormController::class,
    'GET|/editar' => TaskFormController::class,
    'POST|/nova' => NewTaskController::class,
    'POST|/editar' => EditTaskController::class
];