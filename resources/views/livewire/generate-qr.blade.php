<div>
    <div class="text-center">
        <button class="mt-5 bg-green-500 text-white p-3 rounded shadow" wire:click='generate'>Generate QR</button>
    </div>
    @if ($string != 'Welcome')
        <div class="mt-5 flex justify-center items-center">
            {{-- {!! $qrcode !!} --}}

            {{ $qrcode }}
        </div>
        <div class="text-center mt-5">
            <span class="text-semibold text-xl">{{ $formattedString }}</span>
        </div>
    @else
        <div class="text-center mt-5">
            <span class="text-semibold text-xl">Please Generate Code</span>
        </div>
    @endif



</div>
