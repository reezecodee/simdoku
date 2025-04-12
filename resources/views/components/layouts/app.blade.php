<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>
    @livewireStyles

    <link rel="shortcut icon" href="faviocn.ico" type="image/x-icon">

    <link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.7/css/froala_editor.pkgd.min.css">

    <link rel="stylesheet" href="/assets/modules/prism/prism.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
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
            font-size: 12pt;
        }

        .paragraph-height {
            line-height: 1;
        }

        trix-editor {
            min-height: 10rem;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 60px;
            height: 60px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #6777EF;
            border-radius: 50%;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <x-navigation.navbar />

            <div class="main-content">
                <section class="section">
                    <x-alert.success />
                    <x-alert.failed />
                    {{ $slot }}
                </section>
            </div>
        </div>
    </div>

    @livewireScripts
    <script data-navigate-once src="/assets/modules/jquery.min.js"></script>
    <script data-navigate-once src="/assets/modules/popper.js"></script>
    <script data-navigate-once src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script data-navigate-once src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script data-navigate-once src="/assets/modules/moment.min.js"></script>
    <script data-navigate-once src="/assets/js/stisla.js"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script data-navigate-once src="/js/swal.js"></script>
    <script data-navigate-once src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{ $script ?? '' }}
    <script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    <script data-navigate-once src="/assets/js/scripts.js"></script>
    <script data-navigate-once src="/assets/js/custom.js"></script>
</body>

</html>