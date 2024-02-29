<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:15',
            'content' => 'required|string|max:150',
        ]);

        $todo = $this->todo->createTodo($request->all());
        return response()->json($todo);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'string|max:15',
            'content' => 'string|max:150',
        ]);

        try {
            $todo = $this->todo->updateTodoById($id, $request->all());
            return response()->json($todo);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }

    public function get($id)
    {
        try {
            $todo = $this->todo->getTodoById($id);
            return response()->json($todo);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => "Todo item not found"], 404);
        }
    }

    public function gets()
    {
        $todos = $this->todo->getAllTodos();
        return response()->json($todos);
    }

    public function delete($id)
    {
        try {
            $todo = $this->todo->deleteTodoById($id);
            return response()->json(["msg" => "Todo deleted successfully"]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }
}
