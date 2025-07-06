<div class="container">
    <h2 class="mb-4">Bootcamp Unggulan Kami</h2>
    <div class="row">
        @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <p class="text-muted">{{ $course->category }}</p>
                        <p class="text-primary">Rp{{ number_format($course->price, 0, ',', '.') }}</p>
                    </div>
                    <a 
                    href="{{ route('register.bootcamp', $course->id) }}"
                    class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Daftar
                </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
