<div class="flex">
    <button type="button" wire:click="play()" wire:confirm="Lets play?" class="mx:8 sm:rounded-lg shadow-md border m-2 px-2">
        I'm feeling lucky
    </button>

    <button type="button" wire:click="showHistory()" class="mx:8 sm:rounded-lg shadow-md border m-2 px-2">
        History
    </button>

    <button type="button" wire:click="generateLink()" wire:confirm="Do you want to generate a new unique Lucky Link?" class="mx:8 sm:rounded-lg shadow-md border m-2 px-2">
        Generate new Lucky Link
    </button>

    <button type="button" wire:click="deactivateLink()" wire:confirm="Do you want to deactivate your Lucky Link?" class="mx:8 sm:rounded-lg shadow-md border m-2 px-2">
        Deactivate current Lucky Link
    </button>
</div>
