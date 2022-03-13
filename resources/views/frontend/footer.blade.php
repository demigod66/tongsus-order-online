<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h1>Tentang Kami</h1>
                <p>{{ $about->deskripsi }}</p>
                <a href="./about.html">Read more &rarr;</a>
            </div>
            <div class="col-md-4  col-sm-6">
                <h1>Recent post</h1>
                <div class="footer-blog clearfix">
                    <a href="./blog_right_sidebar.html">
                        <img src="img/thumb8.png" class="img-responsive footer-photo" alt="blog photos">
                        <p class="footer-blog-text">Hand picked ingredients for our best customers</p>
                        <p class="footer-blog-date">29 may 2015</p>
                    </a>
                </div>
                <div class="footer-blog clearfix last">
                    <a href="./blog_right_sidebar.html">
                        <img src="img/thumb9.png" class="img-responsive footer-photo" alt="blog photos">
                        <p class="footer-blog-text">Daily special foods that you will going to love</p>
                        <p class="footer-blog-date">29 may 2015</p>
                    </a>
                </div>
            </div>

            <div class="col-md-4  col-sm-6">
                <h1>Reach us</h1>
                <div class="footer-social-icons">
                    <a href="http://www.facebook.com">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="http://www.twitter.com">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="http://plus.google.com">
                        <i class="fa fa-google"></i>
                    </a>
                    <a href="http://www.youtube.com">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                    <a href="http://www.vimeo.com">
                        <i class="fa fa-vimeo"></i>
                    </a>
                    <a href="http://www.pinterest.com">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                    <a href="http://www.linkedin.com">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </div>
                <div class="footer-address">
                    <p><i class="fa fa-map-marker"></i>28 Seventh Avenue, Neew York, 10014</p>
                    <p><i class="fa fa-phone"></i>Phone: (415) 124-5678</p>
                    <p><i class="fa fa-envelope-o"></i>support@restaurant.com</p>
                </div>
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
