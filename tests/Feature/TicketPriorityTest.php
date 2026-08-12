<?php

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

test('an urgent ticket has the Urgente label', function () {
    $ticket = Ticket::factory()->create(['priority' => 'urgent']);

    expect($ticket->priorityLabel())->toBe('Urgente');
});

test('a client can create a ticket with urgent priority', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('tickets.create-ticket')
        ->set('title', 'El servicio está totalmente caído')
        ->set('description', 'No hay conexión en toda la oficina desde hace una hora.')
        ->set('priority', 'urgent')
        ->set('images', [UploadedFile::fake()->image('evidencia.jpg')])
        ->call('save')
        ->assertHasNoErrors();

    expect(Ticket::where('priority', 'urgent')->count())->toBe(1);
});

test('sorting tickets by priority descending surfaces urgent before high', function () {
    $admin = User::factory()->admin()->create();
    $urgent = Ticket::factory()->create(['priority' => 'urgent']);
    $high = Ticket::factory()->create(['priority' => 'high']);

    $this->actingAs($admin);

    Livewire::test('tickets.admin-ticket-list')
        ->call('sort', 'priority')
        ->call('sort', 'priority')
        ->assertViewHas('tickets', function ($tickets) use ($urgent, $high) {
            $ids = $tickets->pluck('id')->all();

            return array_search($urgent->id, $ids, true) < array_search($high->id, $ids, true);
        });
});
