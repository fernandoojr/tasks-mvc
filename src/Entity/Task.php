<?php

namespace Project\Tasks\Entity;

class Task
{
    public readonly ?int $id;
    private string $description;
    private string $date;
    private bool $completed;

    public function __construct(?int $id, string $description, string $date, bool $completed)
    {
        $this->id = $id;
        $this->description = $description;
        $this->date = $date;
        $this->completed = $completed;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    public function setDate(string $newDate)
    {
        $this->date = $newDate;
    }
    public function setDescription(string $newDescription)
    {
        $this->description = $newDescription;
    }
    public function getDate() : string
    {
        return $this->date;
    }

    public function getCompleted() : bool
    {
        return $this->completed;
    }

    public function getDescription() : string
    {
        return $this->description;
    }
}