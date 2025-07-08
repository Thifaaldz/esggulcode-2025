<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Formulir Pendaftaran</h2>
                        <form wire:submit.prevent="register">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" wire:model="name" id="name" class="form-control" />
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model="email" id="email" class="form-control" />
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor WhatsApp</label>
                                <input type="text" wire:model="phone" id="phone" class="form-control" />
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kelas</label>
                                <input type="text" class="form-control" value="{{ $eventCourse->title }}" readonly />
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                Daftar & Bayar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
