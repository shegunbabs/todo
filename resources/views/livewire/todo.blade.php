<div class="bg-gradient-to-b from-green-400 sm:via-blue-400 to-blue-700 min-h-screen pt-10 sm:pt-40 pb-6">
{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="max-w-2xl mx-auto bg-white border-black">
        <div class="p-6 border">
            <h2 class="text-4xl font-bold">Todo App</h2>
            <div class="mt-10">
                <form wire:submit.prevent="saveTodo" class="relative">
                    <x-livewire-loading wire:target="saveTodo" class="opacity-90" />
                    <label for="email" class="sr-only block text-sm font-medium text-gray-700">Todo</label>
                    <div class="mt-1 flex p-2">
                        <div class="w-full">
                            <input wire:model="title" autofocus
                                type="text"
                                class="normal-case shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-lg border-gray-300 rounded h-14 text-sans px-4"
                                placeholder="Enter your Todo title">
                            {{ $due_date ? "Due by: ".$due_date : '' }}
                            <x-input-error for="title" />
                            <x-input-error for="due_date" />
                        </div>
                        <x-date-picker wire:model="due_date" type="button" class="w-14 h-14 bg-blue-600 text-white ml-2 flex items-center justify-center rounded">
                            <x-icons.calendar-solid class="w-9 h-9" />
                        </x-date-picker>
                        <button type="submit" class="bg-purple-700 h-14 w-14 text-white rounded flex-shrink-0 ml-2 flex items-center justify-center">
                            <x-icons.plus-solid class="text-white w-9 h-9" />
                        </button>
                    </div>
                </form>
                <div class="pt-1 pb-6" wire:poll.60000ms>
                    <ul class="space-y-8 sm:space-y-4 p-1 relative">
                        <x-livewire-loading wire:target="deleteTodo" class="opacity-60" />
                        @foreach($_todos as $todo)
                        <li class="rounded h-14 flex sm:items-center flex-col sm:flex-row relative {{ now()->greaterThan($todo->due_date) ? 'line-through' : '' }}">
                            <div class="w-full flex h-full rounded-l group sm:mr-2">
                                <div class="max-w-xs sm:max-w-md w-full bg-gray-100 px-4 text-xl h-full flex items-center rounded-l" title="{{ $todo->title }}">
                                    <span class="truncate overflow-ellipsis w-auto">{{ $todo->title }}</span>
                                </div>
                                <button onclick="confirm('Are you sure to remove todo item?') || event.stopImmediatePropagation()"
                                    wire:click.prevent="deleteTodo({{$todo->id}})"
                                    class="bg-gray-200 flex-shrink-0 h-14 w-14 rounded-tr rounded-br group-hover:bg-red-600 text-white flex items-center justify-center transition duration-500 ease-in-out">
                                    <x-icons.trash-solid class="text-white w-7 h-7"/>
                                </button>
                            </div>
                            <div class="font-medium text-blue-700 text-xs w-24 whitespace-normal">
                                <span class="sm:sr-only">Due By: </span>{{ $todo->due_date->diffForHumans() }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-4 text-xl flex items-center justify-between">
                <div>You have {{ count($_todos) }} pending tasks</div>
                <button wire:click.prevent="deleteTodo()"
                        class="capitalize bg-purple-600 px-3 py-2 rounded text-white font-medium whitespace-nowrap text-xs sm:text-sm">clear all</button>
            </div>
        </div>
    </div>
</div>
