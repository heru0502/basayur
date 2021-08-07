<template>
  <div>
    <div class="header header-fixed header-transparent header-logo-center">
      <inertia-link href="/" v-if="event === 'skip'" class="header-icon color-theme header-icon-4 me-2">Lewati</inertia-link>
      <a href="#" v-if="event === 'back'" onclick="window.history.back();" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content pb-0 bg-theme header-clear-medium">

      <div class="card mb-0 map-full" data-card-height="cover">
      <Carousel  :autoplay="2000">
        <Slide v-for="slide in 10" :key="slide">
          <div class="content mt-n5">
            <img class="carousel__item" src="/theme/images/undraw/1.svg">
            <h1 class="mb-0 font-30"> StickyMobile 3.0</h1>
            <p class="mt-n1 color-highlight font-12">Simply the Best Mobile Webkit on Envato</p>
            <p class="boxed-text-xl">
              Powered by Boostrap 4.4 with AJAX Transitions providing full
              PWA, RTL and Dark Mode integrations!
            </p>
          </div>
        </slide>

        <template #addons>
          <pagination />
        </template>
      </carousel>

      <div class="row mx-3" style="position: fixed; bottom: 70px">
        <a href="/auth/google/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-google text-uppercase font-900 mb-2"><i class="fab fa-google text-center"></i>Login/Register Google</a>
        <a href="/auth/facebook/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-facebook text-uppercase font-900"><i class="fab fa-facebook-f text-center"></i>Login/Register Facebook</a>
      </div>
      </div>
    </div>
  </div>

</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'

import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  layout: LayoutWithoutFooter,
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  props: {
    event: String
  },
  mounted() {
    this.cardExtender()
  },
  methods: {
    cardExtender() {
      //Card Extender
      const cards = document.getElementsByClassName('card');
      function card_extender(){
        var headerHeight, footerHeight, headerOnPage;
        var headerOnPage = document.querySelectorAll('.header:not(.header-transparent)')[0];
        var footerOnPage = document.querySelectorAll('#footer-bar')[0];

        headerOnPage ? headerHeight = document.querySelectorAll('.header')[0].offsetHeight : headerHeight = 0
        footerOnPage ? footerHeight = document.querySelectorAll('#footer-bar')[0].offsetHeight : footerHeight = 0

        for (let i = 0; i < cards.length; i++) {
          if(cards[i].getAttribute('data-card-height') === "cover"){
            if (window.matchMedia('(display-mode: fullscreen)').matches) {var windowHeight = window.outerHeight;}
            if (!window.matchMedia('(display-mode: fullscreen)').matches) {var windowHeight = window.innerHeight;}
            var coverHeight = windowHeight - headerHeight - footerHeight + 'px';
          }
          if(cards[i].hasAttribute('data-card-height')){
            var getHeight = cards[i].getAttribute('data-card-height');
            cards[i].style.height= getHeight +'px';
            if(getHeight === "cover"){
              var totalHeight = getHeight
              cards[i].style.height =  coverHeight
            }
          }
        }
      }

      if(cards.length){
        card_extender();
        window.addEventListener("resize", card_extender);
      }
    }
  }
}
</script>

<style>
.carousel__item {
  min-height: 350px;
  width: 100%;
  /*background-color: #aaaaaa;*/
  color:  var(--carousel-color-white);
  font-size: 20px;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
  background-color: #E9573F;
}

.carousel__pagination-button {
  background-color: rgba(212, 149, 136, 0.64);
}

.carousel__pagination-button--active {
  background-color: #E9573F;
}

.carousel__pagination-button {
  width: 10px;
  height: 10px;
  border-radius: 50%;
}
</style>