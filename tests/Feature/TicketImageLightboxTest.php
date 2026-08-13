<?php

use App\Enums\Role;
use App\Models\Ticket;
use App\Models\User;

test('a ticket with images renders a thumbnail and lightbox modal for each image', function () {
    $user = User::factory()->create(['role' => Role::Client]);
    $ticket = Ticket::factory()->for($user)->create();

    $firstImage = $ticket->images()->create(['image_path' => 'images/tickets/first.jpg']);
    $secondImage = $ticket->images()->create(['image_path' => 'images/tickets/second.jpg']);

    $this->actingAs($user)
        ->get(route('ticket.show', $ticket))
        ->assertOk()
        ->assertSee($firstImage->image_url, false)
        ->assertSee($secondImage->image_url, false)
        ->assertSee('ticket-image-'.$firstImage->id, false)
        ->assertSee('ticket-image-'.$secondImage->id, false);
});

test('a ticket with no images renders no thumbnail or lightbox markup', function () {
    $user = User::factory()->create(['role' => Role::Client]);
    $ticket = Ticket::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('ticket.show', $ticket))
        ->assertOk()
        ->assertDontSee('ticket-image-', false);
});
