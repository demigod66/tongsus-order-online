<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h1>Tentang Kami</h1>
                <p>{!! $about->deskripsi !!}</p>
            </div>
        </div>
    </div>


    <!-- Footer - Copyright -->
    <div class="footer-copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> 2020. Designed <i class="fa fa-heart primary-color"></i> by
                        Tongsus Pekanbaru</p>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

</div>

<!-- Javascript -->
<script src="{{ asset('frontend/js/vendor/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/spectragram.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/velocity.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/velocity.ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/animation.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/vegas/vegas.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.mb.YTPlayer.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/jquery.stellar.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/mc/jquery.ketchup.all.min.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/mc/main.js') }}"></script>
<script src="{{ asset('frontend/js/vendor/validate.js') }}"></script>
<script src="{{ asset('frontend/js/reservation.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script src="{{ asset('vendor/sweetalert/sweetalert2.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>

</body>

</html>
