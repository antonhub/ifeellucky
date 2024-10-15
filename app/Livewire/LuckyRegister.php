<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\LuckyUser;

#[Title('Lucky User Register Page')]
class LuckyRegister extends Component
{
    // todo move the validation parameters to config file
    #[Validate('required|min:5|max:20')]
    public $name = '';

    // todo move the validation parameters to config file
    #[Validate('required|numeric|digits_between:9,14')]
    public $phone = '';

    public function register()
    {
        $this->validate();

        $user = LuckyUser::whereName(strtolower($this->name))->wherePhone($this->phone)->first();

        if ($user !== null) {
            return $this->goToLuckyGamePage($user);
        }

        $user = LuckyUser::whereName(strtolower($this->name))->orWhere('phone', $this->phone)->first();

        if ($user !== null) {
            session()->flash('error', 'User name or phone number already in use');

            return $this->redirectRoute('lucky-index');
        }

        $user = LuckyUser::create(
            $this->only(['name', 'phone'])
        );

        return $this->goToLuckyGamePage($user);
    }

    public function goToLuckyGamePage(LuckyUser $user)
    {
        session()->flash('status', 'Lucky User was successfully registered and now you can check how lucky you are.');


        return $this->redirectRoute('lucky-game', ['hash' => $user->link_hash]);
    }

    #[Layout('layouts.guest')]
    #[Title('Lucky User Register Page')]
    public function render()
    {
        return view('livewire.pages.lucky-index');
    }
}
