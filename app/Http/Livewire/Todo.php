<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo as TodoModel;

class Todo extends Component
{

    public $todos;
    public $title;
    public $due_date;

    public function saveTodo()
    {
        $this->resetValidation('title');
        $validated = $this->validate([
            'title' => 'required|string',
            'due_date' => ['required', 'date', "after:".today()->format('Y-m-d')]
        ]);

        //dd($validated);

        TodoModel::create($validated);
        $this->reset('title', 'due_date');
    }


    public function deleteTodo($todo_id = null)
    {
        $this->resetValidation('title');
        if ($todo_id) {
            TodoModel::find($todo_id)->delete();
            return;
        }
        TodoModel::truncate();
    }


    public function updating($name, $value)
    {
        if ($name === 'title' && $value)
        {
            $this->resetValidation('title');
        }
        if ($name === 'due_date' && $value)
        {
            $this->resetValidation('due_date');
        }
    }



    private function getTodos()
    {
        return TodoModel::orderBy('due_date')->get();
    }


    public function render()
    {
        return view('livewire.todo', ['_todos' => $this->getTodos()]);
    }
}
