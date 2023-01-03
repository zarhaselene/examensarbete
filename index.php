<?php
// http://localhost:8081/exa-test/
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
                            <a class="btn hero-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>

                        </div>
                    </div>

                    <img class="hide-tablet" src="/exa/assets/img/hero_slider_1.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero_slider_1_phone.jpg" alt="">

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
                            <a class="btn hero-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>
                        </div>
                    </div>
                    <img class="hide-tablet" src="/exa/assets/img/hero_slider_2.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero_slider_2_phone.jpg" alt="">
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
                            <a class="btn hero-btn hide-lg-phone" href="/exa/index.php">Shop Now</a>
                        </div>
                    </div>
                    <img class="hide-tablet" src="/exa/assets/img/hero_slider_3.jpg" alt="">
                    <img class="show-tablet" src="/exa/assets/img/hero_slider_3_phone.jpg" alt="">
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    </div>
</section>
<section class="p-standard USP">
    <div class="container display-flex direction-column align-items-center justify-center">
        <div class="intro-section row">
            <div class="text col-12 col-24-tablet">
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
            <div class="intro-slider col-12 hide-tablet">
                <div class="slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/blackheadphones.jpg" alt="Woman with black overear headphones">
                            </div>
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/blueheadphones.jpg" alt="Woman with blue overear headphones">

                            </div>
                            <div class="swiper-slide">
                                <img src="/exa/assets/img/whiteheadphones.jpg" alt="Woman with white overear headphones">

                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php
Template::footer();
