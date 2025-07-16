<x-filament::page>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Daftar Modul Kelas</h2>

    <div class="space-y-8">
        @forelse ($modules as $module)
            @php
                // Konversi YouTube ke embed
                $videoEmbed = null;
                if ($module->video_url) {
                    if (\Illuminate\Support\Str::contains($module->video_url, 'watch?v=')) {
                        parse_str(parse_url($module->video_url, PHP_URL_QUERY), $query);
                        $videoEmbed = isset($query['v']) ? 'https://www.youtube.com/embed/' . $query['v'] : null;
                    } elseif (\Illuminate\Support\Str::contains($module->video_url, 'youtu.be')) {
                        $videoEmbed = 'https://www.youtube.com/embed/' . basename($module->video_url);
                    }
                }

                // Embed PPT via Google Docs Viewer
                $pptEmbed = null;
                if ($module->ppt_path) {
                    $pptEmbed = 'https://docs.google.com/gview?url=' . urlencode(Storage::url($module->ppt_path)) . '&embedded=true';
                }
            @endphp

            <div class="bg-white border p-6 rounded-xl shadow">
                <div class="flex justify-between text-sm text-gray-500 mb-2">
                    <div>Pertemuan {{ $module->meeting_number }}
                        @if($module->meeting_datetime)
                            • {{ \Carbon\Carbon::parse($module->meeting_datetime)->translatedFormat('d F Y, H:i') }}
                        @endif
                    </div>
                    @if($module->ppt_path)
                        <a href="{{ Storage::url($module->ppt_path) }}" class="text-blue-600 hover:underline" target="_blank">📥 Download PPT</a>
                    @endif
                </div>

                <h3 class="text-lg font-semibold text-gray-800">{{ $module->title }}</h3>
                <p class="text-sm text-gray-600 mb-4">{{ $module->description }}</p>

                @if($videoEmbed || $pptEmbed)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        @if($videoEmbed)
                            <iframe src="{{ $videoEmbed }}" class="w-full h-64 border rounded" frameborder="0" allowfullscreen></iframe>
                        @endif

                        @if($pptEmbed)
                            <iframe src="{{ $pptEmbed }}" class="w-full h-64 border rounded" frameborder="0"></iframe>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-500">Belum ada modul tersedia.</div>
        @endforelse
    </div>
</x-filament::page>
