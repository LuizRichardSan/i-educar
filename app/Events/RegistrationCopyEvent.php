<?php

namespace App\Events;

use App\Models\LegacyRegistration;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistrationCopyEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public LegacyRegistration $newRegistration, public LegacyRegistration $oldRegistration)
    {
    }
}
