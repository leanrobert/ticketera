<?php

use App\Models\Ticket;
use App\Models\User;

test('an admin sees app-wide ticket metrics on the dashboard', function () {
    $admin = User::factory()->admin()->create();
    $clientA = User::factory()->create();
    $clientB = User::factory()->create();

    Ticket::factory()->for($clientA)->create(['status' => 'open', 'priority' => 'urgent', 'assigned_to' => null]);
    Ticket::factory()->for($clientB)->create(['status' => 'closed', 'priority' => 'low', 'assigned_to' => $admin->id]);

    $this->actingAs($admin)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee(__('Tickets por estado'))
        ->assertSee(__('Sin asignar'))
        ->assertSee('1');
});

test('a client only sees their own tickets on the dashboard', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    Ticket::factory()->for($owner)->create(['title' => 'Mi ticket de conexión', 'status' => 'open']);
    Ticket::factory()->for($other)->create(['title' => 'Ticket de otro cliente']);

    $this->actingAs($owner)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('Mi ticket de conexión')
        ->assertDontSee('Ticket de otro cliente');
});

test('a client dashboard does not expose admin-only metrics', function () {
    $client = User::factory()->create();

    $this->actingAs($client)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertDontSee(__('Usuarios'))
        ->assertDontSee(__('Sin asignar'));
});
