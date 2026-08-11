<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['ticket_id', 'image_path'])]
class TicketImage extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
