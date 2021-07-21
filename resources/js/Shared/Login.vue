<template>
  <div>
    <img class="img-fluid px-5" src="/theme/images/login-2.png">
    <p class="text-center mb-3">
      Anda harus login terlebih dahulu untuk melanjutkan.<br>
      Silahkan login menggunakan akun Google atau Facebook.
    </p>

    <div class="row ms-5 me-5 mt-0 mb-0">
      <a href="/auth/google/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-google text-uppercase font-900 mb-2"><i class="fab fa-google text-center"></i>Login/Register Google</a>
      <a href="/auth/facebook/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-facebook text-uppercase font-900"><i class="fab fa-facebook-f text-center"></i>Login/Register Facebook</a>
    </div>
  </div>
</template>