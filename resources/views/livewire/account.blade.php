<div>
  @include('components.stickymobile.footer-bar')

  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Akun</a>
  </div>

  <div class="page-content header-clear-medium">

    @unless(auth()->guard('customer')->check())
      <div class="card bg-transparent" data-card-height="cover">
        <div class="card-center text-center">
          <img class="img-fluid px-5" src="{{ asset('theme/images/login-2.png') }}">
{{--          <i class="fa fa-exclamation-triangle fa-8x color-red-dark"></i>--}}
{{--          <h1 class="fa-6x mt-5 font-900">404</h1>--}}
{{--          <h4 class="mb-5 mt-3">Page not Found</h4>--}}
          <p>
            Anda harus login terlebih dahulu untuk melanjutkan.<br>
            Silahkan login menggunakan akun Google atau Facebook.
          </p>

          <div class="row ms-5 me-5 mt-5 mb-0">
            <a href="/auth/google/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-google text-uppercase font-900 mb-2"><i class="fab fa-google text-center"></i>Login/Register Google</a>
            <a href="/auth/facebook/redirect" class="btn btn-icon btn-m btn-full rounded-xl shadow-l bg-facebook text-uppercase font-900"><i class="fab fa-facebook-f text-center"></i>Login/Register Facebook</a>
          </div>
        </div>
      </div>
    @else
      <div class="card card-style">
        <div class="d-flex content">
          <div class="flex-grow-1">
            <div>
              <h1 class="font-700 mb-1">{{ $customer->name }}</h1>
              <p class="mb-0 pb-1 pe-3">
                087815932909
              </p>
            </div>
          </div>
          <div>
            <img src="{{ asset($customer->profile_photo_path) }}"  width="80" class="rounded-circle mt- shadow-xl preload-img">
          </div>
        </div>
      </div>

      <div class="card card-style">
      <div class="content">

        <a href="#" style="color: inherit; text-decoration: inherit;">
          <div class="d-flex mb-2">
            <div>
              Voucher Saya
            </div>
            <div class="flex-fill text-end color-highlight">
              <i class="fa fa-chevron-right"></i>
            </div>
          </div>
        </a>
        <div class="divider divider-margins mb-2"></div>

        <a href="#" style="color: inherit; text-decoration: inherit;">
          <div class="d-flex mb-2">
            <div>
              Alamat Saya
            </div>
            <div class="flex-fill text-end color-highlight">
              <i class="fa fa-chevron-right"></i>
            </div>
          </div>
        </a>
        <div class="divider divider-margins mb-2"></div>

        <a href="#" style="color: inherit; text-decoration: inherit;">
          <div class="d-flex mb-2">
            <div>
              Privasi dan Kebijakan
            </div>
            <div class="flex-fill text-end color-highlight">
              <i class="fa fa-chevron-right"></i>
            </div>
          </div>
        </a>
        <div class="divider divider-margins mb-2"></div>

        <a href="#" style="color: inherit; text-decoration: inherit;">
          <div class="d-flex mb-2">
            <div>
              Bantuan
            </div>
            <div class="flex-fill text-end color-highlight">
              <i class="fa fa-chevron-right"></i>
            </div>
          </div>
        </a>
        <div class="divider divider-margins mb-2"></div>

        <a href="#" style="color: inherit; text-decoration: inherit;">
          <div class="d-flex mb-2">
            <div>
              Chat
            </div>
            <div class="flex-fill text-end color-highlight">
              <i class="fa fa-chevron-right"></i>
            </div>
          </div>
        </a>
        <div class="divider divider-margins mb-2"></div>

        <form method="POST" action="{{ route('logout-customer') }}">
          @csrf
          @method('DELETE')

          <a href="#" style="color: inherit; text-decoration: inherit;" onclick="event.preventDefault();this.closest('form').submit();">
            <div class="d-flex mb-2">
              <div>
                Logout
              </div>
              <div class="flex-fill text-end color-highlight">
                <i class="fa fa-chevron-right"></i>
              </div>
            </div>
          </a>
        </form>
      </div>
    </div>
    @endunless
  </div>
</div>
