<?php

namespace Native\Desktop\Events\App;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationClosing
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct() {}
}
