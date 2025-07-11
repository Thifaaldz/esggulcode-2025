<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <form wire:submit.prevent="register">
        <div class="mb-4">
            <label class="block font-medium">Nama</label>
            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded px-3 py-2" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium">Nomor WhatsApp</label>
            <input type="text" wire:model="phone" class="w-full border rounded px-3 py-2" />
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        
        <div class="mb-4">
            <label class="block font-medium">Kelas</label>
            <input type="text" class="form-control" value="{{ $eventCourse->title }}" readonly>
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Daftar & Bayar
        </button>
    </form>
</div>
