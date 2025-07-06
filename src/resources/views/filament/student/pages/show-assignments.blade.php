<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Daftar Tugas</h2>

    @forelse ($assignments as $assignment)
        <div class="p-4 mb-4 bg-white shadow rounded-md">
            <h3 class="text-lg font-semibold">{{ $assignment->title }}</h3>
            <p class="text-sm text-gray-600 mb-2">
                Modul: {{ $assignment->module->title }} | Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}
            </p>
            <p>{{ $assignment->description }}</p>
        </div>
    @empty
        <p>Tidak ada tugas yang tersedia.</p>
    @endforelse
</x-filament::page>
