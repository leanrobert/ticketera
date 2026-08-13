<?php

use App\Enums\Role;
use App\Models\Ticket;
use App\Models\User;

test('a client sees only their own closed tickets in the closed tickets view', function () {
    $user = User::factory()->create(['role' => Role::Client]);

    $closedTicket = Ticket::factory()->for($user)->create(['status' => 'closed']);
    $openTicket = Ticket::factory()->for($user)->create(['status' => 'open']);

    $this->actingAs($user)
        ->get(route('ticket.closed'))
        ->assertOk()
        ->assertSee($closedTicket->title)
        ->assertDontSee($openTicket->title);
});

test('a client with no closed tickets sees an empty state', function () {
    $user = User::factory()->create(['role' => Role::Client]);
    Ticket::factory()->for($user)->create(['status' => 'open']);

    $this->actingAs($user)
        ->get(route('ticket.closed'))
        ->assertOk()
        ->assertSee(__('No tienes tickets cerrados.'));
});

test('a client cannot see another client\'s closed tickets', function () {
    $owner = User::factory()->create();
    $ownerClosedTicket = Ticket::factory()->for($owner)->create(['status' => 'closed']);

    $intruder = User::factory()->create(['role' => Role::Client]);

    $this->actingAs($intruder)
        ->get(route('ticket.closed'))
        ->assertOk()
        ->assertDontSee($ownerClosedTicket->title);
});

test('the in-progress tickets view still excludes closed tickets', function () {
    $user = User::factory()->create(['role' => Role::Client]);

    $openTicket = Ticket::factory()->for($user)->create(['status' => 'open']);
    $closedTicket = Ticket::factory()->for($user)->create(['status' => 'closed']);

    $this->actingAs($user)
        ->get(route('ticket.index'))
        ->assertOk()
        ->assertSee($openTicket->title)
        ->assertDontSee($closedTicket->title);
});
