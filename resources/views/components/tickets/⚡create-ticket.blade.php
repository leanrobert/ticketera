<?php

use App\Models\TicketImage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $priority;
    public $images = [];

    public function validateInput()
    {
        $this->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10',
            'priority' => 'required|in:low,medium,high,urgent',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|max:2048', // Each image must be an image file and not exceed 2MB
        ]);
    }

    public function save()
    {
        $this->validateInput();

        $ticket = auth()->user()->tickets()->create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
        ]);

        foreach ($this->images as $image) {
            TicketImage::create([
                'ticket_id' => $ticket->id,
                'image_path' => $image->store('tickets', 'public'),
            ]);
        }

        $this->reset(['title', 'description', 'priority', 'images']);

        session()->flash('message', 'Ticket created successfully!');
    }
};
?>

<div class="max-w-xl rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
    @if (session('message'))
        <div class="mb-4 rounded-lg bg-green-50 px-4 py-2 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-400">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="flex flex-col gap-5">
        <flux:field>
            <flux:label>Título</flux:label>
            <flux:input wire:model="title" placeholder="Título del ticket" />
            <flux:error name="title" />
        </flux:field>

        <flux:textarea label="Descripción" wire:model="description" placeholder="Descripción del problema o solicitud" />

        <flux:select wire:model="priority" label="Elige la prioridad">
            <flux:select.option value="">Selecciona una prioridad</flux:select.option>
            <flux:select.option value="low">Baja</flux:select.option>
            <flux:select.option value="medium">Media</flux:select.option>
            <flux:select.option value="high">Alta</flux:select.option>
            <flux:select.option value="urgent">Urgente</flux:select.option>
        </flux:select>

        <flux:field>
            <flux:label>Imágenes</flux:label>
            <input
                type="file"
                wire:model="images"
                multiple
                class="block w-full rounded-lg border border-zinc-200 text-sm text-zinc-600 file:mr-4 file:rounded-md file:border-0 file:bg-zinc-100 file:px-3 file:py-2 file:text-sm file:font-medium file:text-zinc-700 hover:file:bg-zinc-200 dark:border-zinc-700 dark:text-zinc-300 dark:file:bg-zinc-700 dark:file:text-zinc-200 dark:hover:file:bg-zinc-600"
            >
            <flux:error name="images" />
            <flux:error name="images.*" />
        </flux:field>

        <flux:button type="submit">Crear Ticket</flux:button>
    </form>
</div>
