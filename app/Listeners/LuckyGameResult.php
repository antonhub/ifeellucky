<?php

namespace App\Listeners;

use App\Events\LuckyGameResult as EventsLuckyGameResult;
use App\Models\LuckyHistory;

class LuckyGameResult
{
    /**
     * Handle the event.
     *
     * @param  EventsLuckyGameResult  $event
     * @return void
     */
    public function handle(EventsLuckyGameResult $event)
    {
        // save lucky game history
        LuckyHistory::create([
            'link_hash' => $event->user->link_hash,
            'is_win' => $event->isWin,
            'won_amount' => $event->wonAmount,
        ]);
    }
}
