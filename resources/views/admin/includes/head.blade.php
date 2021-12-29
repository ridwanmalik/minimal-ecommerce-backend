<meta charset="utf-8" />
<title>Baker's | {{ $pageName1 }}</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{ asset('website/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
<link href="{{ asset('website/assets/plugins/animate/animate.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/css/default/style.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/css/default/style-responsive.min.css') }}" rel="stylesheet" />
<link href="{{ asset('website/assets/css/default/theme/default.css') }}" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
@yield('page-css')
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('website/assets/plugins/pace/pace.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<script>
    function previewFile(input) {
        var file = $("input#banner").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#previewImg").attr("src", reader.result);
                $(".previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    function previewFile2(input) {
        var file2 = $("input#image").get(0).files[0];
        console.log(file2);

        if (file2) {
            var reader2 = new FileReader();

            reader2.onload = function() {
                $("#previewImg2").attr("src", reader2.result);
                $(".previewImg2").attr("src", reader2.result);
            }

            reader2.readAsDataURL(file2);
        }
    }
</script>

@livewireStyles
