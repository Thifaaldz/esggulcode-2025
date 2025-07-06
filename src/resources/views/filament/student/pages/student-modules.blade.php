<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Modul Kelas</h2>

    <div class="space-y-4">
        @foreach ($modules as $module)
            <div class="border p-4 rounded-lg shadow-sm">
                <h3 class="font-semibold">{{ $module->meeting_number }}. {{ $module->title }}</h3>
                <p class="text-sm text-gray-600">{{ $module->description }}</p>

                @if($module->ppt_path)
                    <a href="{{ Storage::url($module->ppt_path) }}" class="text-blue-500 underline" target="_blank">📄 Download PPT</a>
                @endif

                @if($module->video_url)
                    <div class="mt-2">
                        <iframe width="100%" height="315"
                            src="{{ $module->video_url }}"
                            frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-filament::page>
