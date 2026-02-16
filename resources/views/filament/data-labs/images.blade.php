<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach (($record->images ?? []) as $path)
        <a
            href="{{ asset('storage/' . ltrim($path, '/')) }}"
            target="_blank"
            class="group block"
        >
            <img
                src="{{ asset('storage/' . ltrim($path, '/')) }}"
                class="w-full h-48 object-cover rounded-lg border shadow-sm
                       transition-transform group-hover:scale-105"
            >
        </a>
    @endforeach
</div>
