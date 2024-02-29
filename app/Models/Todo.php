<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = "todo";
    protected $fillable = ['title', 'content'];

    public function createTodo(array $attributes)
    {
        return self::create($attributes);
    }

    public function getTodoById(int $id)
    {
        return self::findOrFail($id);
    }

    public function getAllTodos()
    {
        return self::all();
    }

    public function updateTodoById(int $id, array $attributes)
    {
        $todo = $this->getTodoById($id);
        $todo->update($attributes);
        return $todo;
    }

    public function deleteTodoById(int $id)
    {
        $todo = $this->getTodoById($id);
        $todo->delete();
        return $todo;
    }
}
