<?php

namespace App\Livewire;

use App\Events\LuckyGameResult;
use App\Models\LuckyHistory;
use App\Models\LuckyUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Im feeling lucky!')]
class LuckyGame extends Component
{
    #[Locked]
    public string $hash;
    public ?LuckyUser $user;

    public string $randomNum;
    public bool $isWon = false;
    public string $score;
    public bool $isAccessible;

    // public bool $showHistory = false;
    public ?Collection $history;

    #[Computed]
    public function isHistoryShown()
    {
        return false;
    }

    public function mount(): void
    {
        // get user by his unique link hash
        $this->user = LuckyUser::whereLinkHash($this->hash)->first();

        // @todo move it to the separate service
        $this->isAccessible = $this->user !== null
            && $this->user->is_link_active
            && now()->isAfter(Carbon::parse($this->user->link_expires_at));
    }

    public function rendering()
    {
        // is it still not expired?
        $this->isAccessible = $this->user !== null
            && $this->user->is_link_active
            && now()->isAfter(Carbon::parse($this->user->link_expires_at));
    }

    public function render()
    {
        return view('livewire.lucky-game')->layout('layouts.guest');
    }

    //@todo move the logic to the separate service, and parameters -- to the config file
    public function calculatePercentage(int $num): int
    {
        return match (true) {
            $num <= 300 => 10,
            $num <= 600 => 30,
            $num <= 900 => 50,
            default => 70,
        };
    }

    public function play()
    {
        //@todo move it to config
        $this->randomNum = rand(1, 1000);

        //@todo move it to the separate service
        // it's not an even number
        if ($this->randomNum & 1) {
            $this->isWon = false;

            //@event to store the history
            LuckyGameResult::dispatch($this->user, false, null);

            return;
        }

        $this->isWon = true;

        $percentage = $this->calculatePercentage($this->randomNum);
        $this->score = $this->randomNum * $percentage / 100;

        //@event to store the history
        LuckyGameResult::dispatch($this->user, true, $this->score);
    }

    public function showHistory()
    {
        // show history table
        $this->isHistoryShown = true;

        $this->history = LuckyHistory::where('link_hash', $this->user->link_hash)->orderBy('created_at', 'DESC')->limit(3)->get();
    }

    public function generateLink()
    {
        // @todo move it to the separate hash service
        $linkExpiresAt = now()->addDays(config('lucky_user.link_expiration_days'));
        // @todo move it to the separate hash service
        $linkHash = md5($this->user->name . $linkExpiresAt);

        // updating user's unique link hash data
        $this->user->link_expires_at = $linkExpiresAt;
        $this->user->link_hash = $linkHash;

        $this->user->save();

        // the current link is not accessible anymore because we have another link now
        $this->isAccessible = false;

        session()->flash('status', 'Your unique link was successfully regenerated. The old link is not accessible anymore.');

        return $this->redirectRoute('lucky-game', ['hash' => $linkHash]);
    }

    public function deactivateLink()
    {
        $this->user->is_link_active = false;

        $this->user->save();
    }
}
