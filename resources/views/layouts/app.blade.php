<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title> Greenovent - Accounts </title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="{{ asset('/public/assets/media/logos/greenovent.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('/public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="wrapper d-flex flex-column flex-row-fluid pt-15" id="kt_wrapper">
                <x-header />
                <div class="content d-flex flex-column flex-column-fluid mt-5" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-fluid">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">2022©</span>
                            <a href="{{ url('/') }}" target="_blank"
                                class="text-gray-800 text-hover-primary">Greenovent</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-script />

    {{ $script ?? '' }}


</body>

</html>
