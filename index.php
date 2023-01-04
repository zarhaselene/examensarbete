<?php
// http://localhost:8081/exa/
require_once __DIR__ . "/classes/Template.php";
?>

<?php
Template::header('Matley sound');
?>
<!-- Hero section -->
<section class="hero">
    <div class="slider">
        <!-- Swiper -->
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="hero-container">
                        <div class="hero-text">
                            <div class="headings">
                                <h3 class="color-white">Find Best</h3>
                                <h1 class="color-light-pink">Matley </h1>
                                <h2 class="color-white">Sound</h2>
                            </div>
                            <p class="color-white">Stylish, folded design with active noise cancellation
                                for crystal clear audio 3.5mm Wired or Bluetooth wireless
                                conncectivity</p>
                            <a class="btn full-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>

                        </div>
                    </div>

                    <img class="hide-tablet" src="/exa/assets/img/hero/hero_slider_1.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero/hero_slider_1_phone.jpg" alt="">

                </div>
                <div class="swiper-slide">
                    <div class="hero-container">
                        <div class="hero-text">
                            <div class="headings">
                                <h3 class="color-white">Live Smart </h3>
                                <h1 class="color-light-pink">Hear </h1>
                                <h2 class="color-white">Smart</h2>
                            </div>
                            <p class="color-white">You bring the music, we bring the quality. Make music a pleasant experience. </p>
                            <a class="btn full-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>
                        </div>
                    </div>
                    <img class="hide-tablet" src="/exa/assets/img/hero/hero_slider_2.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero/hero_slider_2_phone.jpg" alt="">
                </div>
                <div class="swiper-slide">
                    <div class="hero-container">
                        <div class="hero-text">
                            <div class="headings">
                                <h3 class="color-white">Less Noice </h3>
                                <h1 class="color-light-pink">More </h1>
                                <h2 class="color-white">Sound</h2>
                            </div>
                            <p class="color-white">Headphones that make you forget everything around. Make music come to life. </p>
                            <a class="btn full-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>
                        </div>
                    </div>
                    <img class="hide-tablet" src="/exa/assets/img/hero/hero_slider_3.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero/hero_slider_3_phone.jpg" alt="">
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    </div>
</section>
<!-- USP section -->
<section class="p-standard USP">
    <div class="container display-flex direction-column align-items-center justify-center">

        <div class="intro-section row p-t-120 p-b-80">
            <div class="floaties">
                <div class="rectangle-shape small"></div>
                <div class="circle-shape large"></div>
            </div>


            <div class="text col-12 col-24-tablet p-r-4">
                <h4 class="heading p-t-5 m-b-4">Loud & Clear
                    <br>
                    Music
                </h4>
                <p class="m-b-2 color-grey">
                    Hendrerit gravida rutrum quisque non tellus orci ac. Tellus molestie nunc non blandit massa enim nec.
                    Et netus et malesuada fames ac turpis egestas sed tempus. Sit amet risus nullam eget felis eget nunc.
                    Viverra justo nec ultrices dui sapien eget mi proin.
                </p>
                <a class="btn corner-btn text-uppercase color-black" href=""><span>Shop now</span></a>
            </div>
            <div class="intro-slider col-12 hide-tablet p-l-4">
                <div class="slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/sliders/blackheadphones.jpg" alt="Woman with black overear headphones">
                            </div>
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/sliders/blueheadphones.jpg" alt="Woman with blue overear headphones">

                            </div>
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/sliders/whiteheadphones.jpg" alt="Woman with white overear headphones">

                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="intro-section row p-t-120 p-b-80">
            <div class="floaties">
                <div class="rectangle-shape very-small"></div>
                <div class="rectangle-shape medium"></div>
                <div class="rectangle-shape large"></div>
            </div>
            <div class="intro-slider col-12 hide-tablet p-r-4">
                <div class="slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/sliders/blueheadphones.jpg" alt="Woman with blue overear headphones">
                            </div>
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/sliders/redheadphones.jpg" alt="Woman with red overear headphones">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <div class="text col-12 col-24-tablet p-l-4">
                <h4 class="heading p-t-5 m-b-4">Get in the Zone with your favorite music</h4>
                <p class="m-b-2 color-grey">
                    Mattis aliquam faucibus purus in massa tempor nec. Pulvinar etiam non quam lacus.
                    Volutpat ac tincidunt vitae semper quis lectus nulla at volutpat.
                    Non blandit massa enim nec dui nunc mattis enim. Donec enim diam vulputate ut pharetra sit amet aliquam id.
                </p>
                <a class="btn corner-btn text-uppercase color-black" href=""><span>Shop now</span></a>
            </div>
        </div>

    </div>
</section>
<!-- Banner section -->
<section class="p-standard banner display-flex direction-column justify-center align-items-start">
    <div class="text">
        <h4 class="heading p-t-5 m-b-4">Go to <span class="laptop-pink">Adventures</span> You've
            <br> Only Dreamt of...
        </h4>
        <p class="m-b-2 color-grey">
            Aliquet sagittis id consectetur purus ut.
            Orci ac auctor augue mauris augue neque gravida in fermentum.
            Elit eget gravida cum sociis natoque penatibus.
        </p>
        <a class="btn full-btn color-white" href="">Learn More</a>
    </div>
</section>
<!-- Music section -->
<section class="p-standard music position-relative">
    <div class="content-standard">
        <div class="floaties">
            <div class="rectangle-shape medium"></div>
            <div class="circle-shape large"></div>
        </div>
        <div class="row">
            <div class="col-12 col-24-tablet">
                <h4 class="heading">Sterlined Headphone
                    <br> Style 2022
                </h4>
                <div class="illustration">
                    <img src="/exa/assets/img/illustrations/headphone-illustration.png" alt="Orange headphone illustration with the text Music lives on">
                </div>
            </div>
            <div class="col-12 col-24-tablet display-flex direction-column justify-end">
                <div class="text-block-md">
                    <p class="color-grey">
                        Blandit aliquam etiam erat velit.
                        Mi proin sed libero enim sed faucibus.
                        Faucibus pulvinar elementum integer enim neque volutpat.
                        Euismod in pellentesque massa placerat duis ultricies lacus sed turpis.
                        Aliquet porttitor lacus luctus accumsan tortor posuere.
                        Nisl purus in mollis nunc sed id semper risus.
                        Ultrices neque ornare aenean.
                    </p>
                    <a class="btn corner-btn text-uppercase color-black" href=""><span>Shop now</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features section -->
<section class="p-standard">
    <div class="content-standard">
        <div class="row">
            <div class="col-12 col-24-tablet m-h-2">
                <div class="text-block-md">
                    <h4>
                        Wear it with ease and
                        <br>
                        comfort ever.
                    </h4>
                    <p class="features-text color-grey">
                        At risus viverra adipiscing at.
                        Iaculis urna id volutpat lacus laoreet non curabitur.
                        Enim lobortis scelerisque fermentum dui faucibus in.
                        Nisl suscipit adipiscing.
                    </p>
                </div>

                <div class="features-image">
                    <img src="/exa/assets/img/feature_image.png" alt="">
                </div>
            </div>
            <div class="col-12 col-24-tablet m-h-2 features display-flex justify-end align-items-center">
                <div class="features-container">
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="icon fa-solid fa-wifi"></i>
                        </div>
                        <h5 class="m-b-1">Wireless</h5>
                        <p class="color-grey">
                            Nisl suscipit adipiscing bibendum est.
                            <br> Tempus imperdiet nulla malesuada.
                        </p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="icon fa-solid fa-volume-xmark"></i>
                        </div>
                        <h5 class="m-b-1">Noise Cancelling</h5>
                        <p class="color-grey">
                            Posuere sollicitudin aliquam ultrices
                            <br> sagittis orci a. Eleifend donec pretium.
                        </p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="icon fa-solid fa-headphones"></i>
                        </div>
                        <h5 class="m-b-1">Perfect Sound</h5>
                        <p class="color-grey">
                            Leo urna molestie at elementum eu
                            <br> facilisis sed odio fringilla est.
                        </p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="icon fa-brands fa-bluetooth-b"></i>
                        </div>
                        <h5 class="m-b-1">Bluetooth</h5>
                        <p class="color-grey">
                            Adipiscing vitae proin sagittis nisl.
                            <br> Posuere ac ut consequat semper.
                        </p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="icon fa-solid fa-microphone"></i>
                        </div>
                        <h5 class="m-b-1">Microphone</h5>
                        <p class="color-grey">
                            Varius duis at consectetur lorem
                            <br> donec massa sapien faucibus et.
                        </p>
                    </div>
                    <div class="feature-block">
                        <div class="feature-icon m-b-6 display-flex direction-column justify-center align-items-center">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <h5 class="m-b-1">Water-resistant</h5>
                        <p class="color-grey">
                            Posuere ac ut faucibus semper.
                            <br> Facilisis sed odio fring.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
Template::footer();
