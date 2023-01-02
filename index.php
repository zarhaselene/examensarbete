<?php
// http://localhost:8081/exa/
require_once __DIR__ . "/classes/Template.php";
?>

<?php
Template::header('Matley sound');
?>
<!-- Hero section -->
<section class="hero">
    <!-- Swiper -->
    <div class="swiper mySwiper">
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
                        <a class="btn slider-btn" href="/exa/index.php">Shop Now</a>

                    </div>
                </div>

                <img class="hide-tablet" src="/exa/assets/img/hero_slider_1.jpg" alt="">
                <img class="show-tablet" src="/exa/assets/img/hero_slider_1_phone.jpg" alt="">

            </div>
            <div class="swiper-slide">
                <img class="hide-tablet" src="/exa/assets/img/hero_slider_2.jpg" alt="">
                <img class="show-tablet" src="/exa/assets/img/hero_slider_2_phone.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img class="hide-tablet" src="/exa/assets/img/hero_slider_3.jpg" alt="">
                <img class="show-tablet" src="/exa/assets/img/hero_slider_3_phone.jpg" alt="">
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>
    </div>
</section>
<section class="USP" style="height: 50vh;">

</section>
<?php
Template::footer();
