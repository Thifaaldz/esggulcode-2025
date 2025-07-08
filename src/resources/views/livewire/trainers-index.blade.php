<section id="trainers-index" class="section trainers-index">
    <div class="container">
        <div class="row">
            @foreach ($employees as $index => $employee)
                <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                    <div class="member">
                        <img src="{{ asset('front/assets/img/trainers/trainer-' . (($index % 3) + 1) . '.jpg') }}" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>{{ $employee->nama }}</h4>
                            <span>{{ $employee->position->name ?? 'Full Stack Development' }}</span>
                            <p>{{ $employee->branch->name ?? 'Tidak ada deskripsi' }}</p>
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
