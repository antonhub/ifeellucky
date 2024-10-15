<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\LuckyUser;

class LuckyGameResult
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LuckyUser $user;
    public bool $isWin;
    public ?float $wonAmount;

    /**
     * @param \App\Models\LuckyUser $user
     * @return void
     */
    public function __construct(LuckyUser $user, bool $isWin, ?float $amount)
    {
        $this->user = $user;
        $this->isWin = $isWin;
        $this->wonAmount = $amount;
    }
}
