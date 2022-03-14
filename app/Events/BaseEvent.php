<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }
}
