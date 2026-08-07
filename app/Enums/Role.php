<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Support = 'support';
    case Client = 'client';
}
