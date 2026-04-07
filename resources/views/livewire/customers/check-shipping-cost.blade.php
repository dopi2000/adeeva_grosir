<div>
    <div class="">
        <label for="keyword">Cari tujuan pegiriman</label>
        <input type="text" wire:model.live.debounce.250="keyword" id="keyword">
    </div>
    <br>
    @if (!empty($data[0]['data']))
    @foreach ($data[0]['data'] as $destination)
        <div class="items-center">
            <span>
               id: {{ $destination['id'] }}
            </span>
            <span>
               label: {{ $destination['label'] }}
            </span>
        </div>
    @endforeach
    @else
    <span>Not Location</span>
    @endif
</div>
