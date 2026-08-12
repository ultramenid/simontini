<?php

namespace App\Mail\Concerns;

use Illuminate\Mail\Mailables\Headers;
use Illuminate\Support\Str;

trait HasUniqueEmailReference
{
    public function headers(): Headers
    {
        return new Headers(
            text: ['X-Entity-Ref-ID' => (string) Str::uuid()],
        );
    }
}
