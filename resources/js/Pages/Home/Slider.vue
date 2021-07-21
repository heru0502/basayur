<template>
  <div>
    <div class="splide single-slider slider-arrows slider-no-dots" id="single-slider-3">
      <div class="splide__track">
        <div class="splide__list">
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-18 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Splendid Simplicity</h2>
                <p class="under-heading color-white">A new generation of Mobile Kits.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-14 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Top Notch Quality</h2>
                <p class="under-heading color-white">Flexibility, Speed, Ease of Use.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-14 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Perfectly Organized</h2>
                <p class="under-heading color-white">Mobile Website, or App or PWA Ready.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    var splide = document.getElementsByClassName('splide');
    if(splide.length) {
      var singleSlider = document.querySelectorAll('.single-slider');
      if (singleSlider.length) {
        singleSlider.forEach(function (e) {
          var single = new Splide('#' + e.id, {
            type: 'loop',
            autoplay: true,
            interval: 4000,
            perPage: 1,
          }).mount();
          var sliderNext = document.querySelectorAll('.slider-next');
          var sliderPrev = document.querySelectorAll('.slider-prev');
          sliderNext.forEach(el => el.addEventListener('click', el => {
            single.go('>');
          }));
          sliderPrev.forEach(el => el.addEventListener('click', el => {
            single.go('<');
          }));
        });
      }
    }
  }
}

</script>