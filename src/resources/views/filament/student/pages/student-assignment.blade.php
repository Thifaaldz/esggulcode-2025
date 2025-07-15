<x-filament::page>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📝 Daftar Tugas Kelas</h2>

    <div class="space-y-6">
        @foreach ($assignments as $assignment)
            @php
                $submission = $this->getSubmission($assignment->id);
            @endphp

            <div class="bg-white border rounded-xl shadow-sm p-6">
                {{-- Judul & Deskripsi --}}
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $assignment->title }}</h3>
                    <span class="text-sm text-red-600 font-medium">
                        📅 Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}
                    </span>
                </div>
                <p class="mt-1 text-gray-600 text-sm">{{ $assignment->description }}</p>

                {{-- Status Upload --}}
                @if ($submission)
                    <div class="mt-4 bg-green-50 p-3 rounded text-sm text-green-700 border border-green-200">
                        ✅ Tugas telah dikumpulkan:
                        <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="underline text-blue-600">
                            Lihat File
                        </a>
                        <span class="block mt-1 text-xs text-gray-500">
                            Dikirim pada: {{ $submission->created_at->format('d M Y H:i') }}
                        </span>
                    </div>
                @endif

                {{-- Upload Form --}}
                <div class="mt-4 space-y-2">
                    <input 
                        type="file" 
                        wire:model.defer="files.{{ $assignment->id }}" 
                        class="block w-full text-sm text-gray-600 border border-gray-300 rounded p-2" 
                    />
                    
                    <x-filament::button 
                        wire:click="submit({{ $assignment->id }})"
                        color="{{ $submission ? 'secondary' : 'primary' }}"
                    >
                        {{ $submission ? '🔁 Update Tugas' : '📤 Upload Tugas' }}
                    </x-filament::button>

                    @error("files.$assignment->id")
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    {{-- Cek Sertifikat --}}
    @if ($this->hasPassedAllAssignments())
        <div class="p-6 mt-10 border rounded-xl bg-gradient-to-br from-green-100 via-green-50 to-white text-center shadow-md">
            <h2 class="text-xl font-bold text-green-700 mb-2">🎉 Selamat!</h2>
            <p class="text-sm text-gray-700">Anda telah menyelesaikan semua tugas dengan nilai minimal 80.</p>
            <x-filament::button tag="a" href="{{ route('student.certificate.download') }}" target="_blank" class="mt-4">
                🎓 Unduh Sertifikat
            </x-filament::button>
        </div>
    @endif
</x-filament::page>
