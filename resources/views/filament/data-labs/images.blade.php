<div class="grid grid-cols-3 gap-4">
    @foreach ($getState() ?? [] as $image)
        <a href="{{ asset('storage/' . $image) }}" target="_blank">
            <img src="{{ asset('storage/' . $image) }}"
                class="rounded-lg shadow cursor-pointer hover:scale-105 transition">
        </a>
    @endforeach
</div>
