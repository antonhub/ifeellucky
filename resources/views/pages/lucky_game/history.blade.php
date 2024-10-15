<div>

@if (! isset($history) || $history->isEmpty())
    <h4 class="text-md font-bold"> You've not played yet </h4>
@else
<h4 class="text-md font-bold">Lucky game history</h4>
    <table class="text-center">
        <tr>
            <th>id</th>
            <th>win/lose</th>
            <th>score</th>
            <th>date</th>
        </tr>
        {{-- <tr wire:key="{{ $item->id }}"> --}}
        @foreach ($history as $item)
            <tr wire:key="history-item-{{ $item->id }}" border="1" bordercolor="#008000">
                <td>{{ $item->id }}</td>
                <td>@if ($item->is_win) Win @else Lose @endif</td>
                <td>{{ $item->won_amount }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </table>
@endif
</div>
