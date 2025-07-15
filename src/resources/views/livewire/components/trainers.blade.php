<section id="trainers-index" class="section trainers-index">
  <div class="container">
    <div class="row">
      @foreach ($trainers as $index => $trainer)
        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
          <div class="member">
            <img 
              src="https://i.pravatar.cc/300?u={{ $trainer->id }}" 
              class="img-fluid rounded" 
              alt="{{ $trainer->nama }}"
            >
            <div class="member-content">
              <h4>{{ $trainer->nama }}</h4>
              <span>{{ $trainer->position->nama ?? 'Instruktur' }}</span>
              <p>
                Instruktur berpengalaman dalam bidang {{ $trainer->division->nama ?? 'Teknologi' }}.
              </p>
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
