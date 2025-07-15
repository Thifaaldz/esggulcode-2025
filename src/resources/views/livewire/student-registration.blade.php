<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    background-color: #f9f9f9;
">
    <div style="
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 500px;
    ">
        <h2 style="text-align: center; margin-bottom: 24px; color: #333;">Formulir Pendaftaran</h2>

        <form wire:submit.prevent="register">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: bold;">Nama</label>
                <input type="text" wire:model="name" placeholder="Nama lengkap"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                @error('name') <span style="color:red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: bold;">Email</label>
                <input type="email" wire:model="email" placeholder="Alamat email aktif"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                @error('email') <span style="color:red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: bold;">Nomor WhatsApp</label>
                <input type="text" wire:model="phone" placeholder="Contoh: 081234567890"
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                @error('phone') <span style="color:red; font-size: 14px;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: bold;">Kelas</label>
                <input type="text" value="{{ $eventCourse->title }}" readonly
                    style="width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <button type="submit"
                style="width: 100%; padding: 12px; background-color: #4CAF50; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer;">
                Daftar & Bayar
            </button>
        </form>
    </div>
</div>
