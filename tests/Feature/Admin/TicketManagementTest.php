<?php

use App\Models\Ticket;
use App\Models\User;
use Livewire\Livewire;

test('an admin can view the tickets list', function () {
    $admin = User::factory()->admin()->create();
    Ticket::factory()->count(2)->create();

    $this->actingAs($admin)
        ->get(route('admin.tickets'))
        ->assertOk();
});

test('a client cannot view the admin tickets list', function () {
    $client = User::factory()->create();

    $this->actingAs($client)
        ->get(route('admin.tickets'))
        ->assertForbidden();
});

test('an admin can assign a ticket to another admin user', function () {
    $admin = User::factory()->admin()->create();
    $otherAdmin = User::factory()->admin()->create();
    $ticket = Ticket::factory()->create();

    $this->actingAs($admin);

    Livewire::test('tickets.admin-ticket-list')
        ->call('assign', $ticket->id, (string) $otherAdmin->id);

    expect($ticket->refresh()->assigned_to)->toBe($otherAdmin->id);
});

test('an admin can unassign a ticket', function () {
    $admin = User::factory()->admin()->create();
    $otherAdmin = User::factory()->admin()->create();
    $ticket = Ticket::factory()->create(['assigned_to' => $otherAdmin->id]);

    $this->actingAs($admin);

    Livewire::test('tickets.admin-ticket-list')
        ->call('assign', $ticket->id, '');

    expect($ticket->refresh()->assigned_to)->toBeNull();
});

test('a client cannot assign a ticket', function () {
    $client = User::factory()->create();
    $admin = User::factory()->admin()->create();
    $ticket = Ticket::factory()->create();

    $this->actingAs($client);

    Livewire::test('tickets.admin-ticket-list')
        ->call('assign', $ticket->id, (string) $admin->id)
        ->assertForbidden();

    expect($ticket->refresh()->assigned_to)->toBeNull();
});
