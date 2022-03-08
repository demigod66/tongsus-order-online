<section class="home-slider owl-carousel">
    @foreach ($slider as $sl)
        <div class="slider-item" style="background-image: url( '{{ asset($sl->foto_slider) }}' );">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                    <div class="col-md-8 col-sm-12 text-center ftco-animate">
                        <span class="subheading">Welcome</span>
                        <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
                        <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with
                            the
                            necessary regelialia.</p>
                        <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Sekarang</a> <a href="#"
                                class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Lihat Menu</a></p>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</section>
