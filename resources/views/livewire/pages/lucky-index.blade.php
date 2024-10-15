<div>
    <form wire:submit="register">

        <input type="text" wire:model="name">
        <div>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="text" wire:model="phone">
        <div>
            @error('phone') <span class="error">{{ $message }}</span> @enderror
        </div>


        <button type="submit">Register</button>

        <span wire:loading>Saving...</span>
    </form>
</div>
