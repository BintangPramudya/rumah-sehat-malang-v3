<div class="text-sm space-y-1">
    <div>
        <span class="font-semibold">Nama Pasien:</span>
        {{ $record->patient?->full_name ?? '-' }}
    </div>

    <div>
        <span class="font-semibold">Tanggal Upload:</span>
        {{ $record->created_at->format('d M Y H:i') }}
    </div>
</div>
