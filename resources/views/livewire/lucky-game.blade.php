<div class="flex flex-col justify-center">

    <div class="text-md font-bold">
    @if (!$isAccessible)
        <h2>The link is inactive</h2>
    @elseif ($isWon)
        <h3>Number: {{ $randomNum }}</h3>
        <h2>You Win:) {{ $score }} points</h3>
            {{-- <h2></h2> --}}
        @elseif (isset($randomNum))
            <h3>Number: {{ $randomNum }}</h3>
            <h2>You Lose :`(</h2>
    @endif
    </div>

    @if ($isAccessible)
        @include('pages.lucky_game.buttons')
    @endif

    @if ($this->isHistoryShown)
        @include('pages.lucky_game.history')
    @endif

</div>
