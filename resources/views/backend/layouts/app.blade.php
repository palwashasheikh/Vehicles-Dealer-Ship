<!doctype html>
<html lang="en" dir="ltr">

<head>
    @include('backend.layouts.partials.head')

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('backend/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('backend.layouts.partials.header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            {{-- @include('backend.layouts.partials.sidebar') --}}
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            <div class="main-content card-content mt-0 ml-1">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container">

                        <!-- PAGE-HEADER -->
                        @yield('breadcrumb')
                        <!-- PAGE-HEADER END -->

                        @yield('content')

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <!-- FOOTER -->
        @include('backend.layouts.partials.footer')
        <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <div class="modal fade" id="ajax_model" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="ajax_model_title">Modal title</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="ajax_model_content">

                    </div>
                    <div id="ajax_model_spinner">
                        <div class="modal-body">
                            <div id="loader" class="background">
                                <div class="dots container">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.layouts.partials.scripts')
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- Common Js --}}
    <script src="{{ asset('backend/js/common.js') }}"></script>

    @stack('scripts')
    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
