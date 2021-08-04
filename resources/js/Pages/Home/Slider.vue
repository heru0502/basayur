<template>
  <div class="content m-0">
    <Carousel :items-to-show="1.2" >
      <Slide v-for="slide in 10" :key="slide">
        <img class="carousel__item" src="/theme/images/pictures/8.jpg">
      </slide>

      <template #addons>
        <pagination />
      </template>
    </carousel>
  </div>
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  }
}

</script>

<style>
.carousel__item {
  min-height: 150px;
  width: 100%;
  background-color: #aaaaaa;
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