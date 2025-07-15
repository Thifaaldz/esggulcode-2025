@php use Illuminate\Support\Str; @endphp

<div class="container my-5">
    <h2 class="mb-4 text-center">Bootcamp Unggulan Kami</h2>

    <div class="row">
        @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded overflow-hidden">
                    @php
                        $image = $course->image;
                        $image = Str::startsWith($image, ['http://', 'https://'])
                            ? $image
                            : asset($image ?: 'images/default-course.jpg');
                    @endphp

                    <img 
                        src="{{ $image }}" 
                        class="card-img-top" 
                        alt="{{ $course->title }}" 
                        style="height: 200px; object-fit: cover;"
                        onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=No+Image';"
                    >

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text text-muted mb-2" style="font-size: 14px;">
                            {{ Str::limit($course->description, 100) }}
                        </p>

                        <ul class="list-unstyled small mb-3 text-muted">
                            <li><strong>Kategori:</strong> {{ $course->category }}</li>
                            <li><strong>Periode:</strong> 
                                {{ \Carbon\Carbon::parse($course->start_date)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}
                            </li>
                        </ul>

                        <p class="text-primary fw-bold mb-3">
                            Rp{{ number_format($course->price, 0, ',', '.') }}
                        </p>

                        <a 
                            href="{{ route('register.bootcamp', $course->id) }}"
                            class="btn btn-success mt-auto w-100"
                        >
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
