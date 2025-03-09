<?php

namespace App\Services;

class TaskService {
    protected array $tasks = [];

    public function add(string $task): void {
        $this->tasks[] = $task;
    }

    public function getAllTasks(): array {
        return $this->tasks;
    }
}
