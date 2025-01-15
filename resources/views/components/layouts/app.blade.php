<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>
    @livewireStyles

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.7/css/froala_editor.pkgd.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/modules/prism/prism.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <style>
        .letter-format {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .paragraph-height {
            line-height: 1;
        }

        #fr-logo {
            display: none;
        }
    </style>
    <!-- /END GA -->
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <x-navigation.navbar />

            <div class="main-content">
                <section class="section">
                    <x-alert.success />
                    {{ $slot }}
                </section>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="/assets/modules/jquery.min.js"></script>
    <script src="/assets/modules/popper.js"></script>
    {{-- <script src="/assets/modules/tooltip.js"></script> --}}
    <script data-navigate-once src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/modules/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.7/js/froala_editor.pkgd.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/swal.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{ $script ?? '' }}
    <script>
        new FroalaEditor('#editor');
    </script>


    <!-- Template JS File -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>

</html>