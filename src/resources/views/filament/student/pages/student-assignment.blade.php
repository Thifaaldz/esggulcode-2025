<x-filament::page>
    @foreach ($assignments as $assignment)
        @php
            $submission = $this->getSubmission($assignment->id);
        @endphp

        <div class="border p-4 rounded mb-4 shadow-sm">
            <h3 class="font-semibold">{{ $assignment->title }}</h3>
            <p class="text-sm text-gray-600">{{ $assignment->description }}</p>
            <p class="text-sm text-red-500 mt-1">
                Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}
            </p>

            @if ($submission)
                <div class="mt-2 text-sm text-green-600">
                    ✅ Sudah diupload:
                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="underline text-blue-600">
                        Lihat File
                    </a>
                    ({{ $submission->created_at->format('d M Y H:i') }})
                </div>
            @endif

            <div class="mt-3">
                <input type="file" wire:model.defer="files.{{ $assignment->id }}" />
                <x-filament::button wire:click="submit({{ $assignment->id }})" class="mt-2">
                    {{ $submission ? 'Update Tugas' : 'Upload Tugas' }}
                </x-filament::button>

                @error("files.$assignment->id") 
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    @endforeach

    @php
    $canPrint = \App\Models\AssignmentsSubmissions::where('student_id', auth()->user()->student->id)
        ->whereBetween('assignment_id', [1, 8])
        ->pluck('grade');

    $eligible = $canPrint->count() === 8 && $canPrint->every(fn ($grade) => $grade >= 80);
@endphp
@if ($this->hasPassedAllAssignments())
    <div class="p-6 mt-6 border rounded bg-green-100 text-center">
        <h2 class="text-xl font-bold text-green-700 mb-2">Selamat! 🎉</h2>
        <p class="mb-4">Anda telah menyelesaikan seluruh tugas dengan nilai minimal 80.</p>
        <x-filament::button tag="a" href="{{ route('student.certificate.download') }}" target="_blank">
            🎓 Cetak Sertifikat
        </x-filament::button>
    </div>
@endif

</x-filament::page>
