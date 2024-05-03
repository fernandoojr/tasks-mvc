<?php

namespace Project\Tasks\Repository;
use PDO;
use Project\Tasks\Entity\Task;

class TaskRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Task $task) : bool
    {
        $sql = 'INSERT INTO tasks (date, completed, description) VALUES (:date, :completed, :description);';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':date', $task->getDate());
        $statement->bindValue(':completed', $task->getCompleted());
        $statement->bindValue(':description', $task->getDescription());

        return $statement->execute();
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM tasks WHERE id = ?;';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }



    public function alterStatus(int $id, bool $status): bool
    {
        if($status === false){
            $newValue = 1;
        }else{
            $newValue = 0;
        }
        $sql = 'UPDATE tasks SET completed = :completed WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':completed', $newValue);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function update(Task $task): bool
    {
        $sql = "UPDATE tasks SET date = :date, description = :description WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date', $task->getDate());
        $stmt->bindValue(':description', $task->getDescription());
        $stmt->bindValue(':id', $task->id);
        return $stmt->execute();
    }

    public function find(int $id): Task
    {
        $sql = 'SELECT * FROM tasks WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydrateTask($stmt->fetch(PDO::FETCH_ASSOC));
    }

    
    public function all() : array
    {
        $taskList = $this->pdo->query('SELECT * FROM tasks')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateTask(...),
            $taskList
        );
    }

    private function hydrateTask(array $taskData) : Task
    {
        $task = new Task($taskData['id'], $taskData['description'], $taskData['date'], $taskData['completed']);
        return $task;
    }
}