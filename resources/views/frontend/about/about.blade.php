@include('frontend.header')

<section class="ftco-about d-md-flex">
    <div class="one-half img" style="background-image: url({{ asset($about->foto_deskripsi) }});"></div>
    <div class="one-half ftco-animate">
        <div class="overlap">
            <div class="heading-section ftco-animate ">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Our Story</h2>
            </div>
            <div>
                <p>{{ $about->deskripsi }}</p>
            </div>
        </div>
    </div>
</section>


@include('backend.footer')
