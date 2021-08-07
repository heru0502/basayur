<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Bantuan</a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="mb-">
        <button class="btn accordion-btn no-effect" data-bs-toggle="collapse" data-bs-target="#collapse1">
          <i class="fa fa-heart color-red-dark me-2"></i>
          Accordion Title 1
          <i class="fa fa-plus font-10 accordion-icon"></i>
        </button>
        <div id="collapse1" class="collapse" data-parent="#accordion-1">
          <div class="pt-1 pb-2 ps-3 pe-3">
            <p>This is the accordion content. You can add any content you want to it. Really, anything! Add images, text, lists, captions or any element you want.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  layout: Layout
}
</script>