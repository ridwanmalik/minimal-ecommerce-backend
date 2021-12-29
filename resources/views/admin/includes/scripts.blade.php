<script src="{{ asset('website/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
<!--[if lt IE 9]>
  <script src="{{ asset('website/assets/crossbrowserjs/html5shiv.js') }}"></script>
  <script src="{{ asset('website/assets/crossbrowserjs/respond.min.js') }}"></script>
  <script src="{{ asset('website/assets/crossbrowserjs/excanvas.min.js') }}"></script>
 <![endif]-->
<script src="{{ asset('website/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('website/assets/plugins/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('website/assets/js/theme/default.min.js') }}"></script>
<script src="{{ asset('website/assets/js/apps.min.js') }}"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
@yield('page-js')
<!-- ================== END PAGE LEVEL JS ================== -->

@livewireScripts
