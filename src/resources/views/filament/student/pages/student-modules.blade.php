<x-filament::page>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Daftar Modul Kelas</h2>

    <div class="space-y-8">
        @forelse ($modules as $module)
            <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm text-gray-500">
                        Pertemuan {{ $module->meeting_number }} 
                        @if($module->meeting_datetime)
                            • {{ \Carbon\Carbon::parse($module->meeting_datetime)->translatedFormat('d F Y, H:i') }}
                        @endif
                    </div>
                    @if($module->ppt_path)
                        <a href="{{ Storage::url($module->ppt_path) }}" 
                           target="_blank" 
                           class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                            📥 Download PPT
                        </a>
                    @endif
                </div>

                {{-- Title & Description --}}
                <h3 class="text-lg font-semibold text-gray-800">{{ $module->title }}</h3>
                <p class="mt-1 text-gray-600 text-sm">{{ $module->description }}</p>

                {{-- Video & PPT --}}
                @if($module->video_url || $module->ppt_path)
                    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Video --}}
                        @if($module->video_url)
                            <div>
                                <iframe
                                    src="{{ $module->video_url }}"
                                    class="w-full h-64 rounded-lg border"
                                    frameborder="0"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endif

                        {{-- PPT Embed --}}
                        @if($module->ppt_path)
                            <div>
                                <iframe
                                    src="https://docs.google.com/gview?url={{ urlencode(Storage::url($module->ppt_path)) }}&embedded=true"
                                    class="w-full h-64 rounded-lg border"
                                    frameborder="0">
                                </iframe>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-500">
                Belum ada modul tersedia.
            </div>
        @endforelse
    </div>
</x-filament::page>
