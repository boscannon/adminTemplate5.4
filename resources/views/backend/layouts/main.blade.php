<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title>{{ $subTitleData }} - {{ __(env('APP_NAME')) }}</title>

  <meta name="description" content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
  <meta name="author" content="pixelcave">
  <meta name="robots" content="noindex, nofollow">


  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Open Graph Meta -->
  <meta property="og:title" content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework">
  <meta property="og:site_name" content="Codebase">
  <meta property="og:description" content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
  <meta property="og:type" content="website">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

  <!-- Modules -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.css') }}">
    @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" href="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
    <link href="{{ asset('plugins/filepond/dist/filepond.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/plugins/vakata-jstree/themes/default/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    <style>
        .table-bordered thead th{
            border-bottom: 2px solid #e4e7ed;
        }
        .img-lightbox img{
            height: 100%;
        }
        .img-lightbox:hover {
            transform: scale(1.4);
            opacity: 0.75;
        }
        .select2-results__option[aria-disabled=true]{
            display: none;
        }
        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
        }
        .nav-main li{
            display: none;
        }
    </style>
    @if(!auth()->user()->can("create $permissionsData"))
        <style>
            a[href*={{ $permissionsData }}][href*=create]{
                display: none;
            }
        </style>
    @endif
    @if(!auth()->user()->can("edit $permissionsData"))
        <style>
            a[href*={{ $permissionsData }}][href*=edit]{
                display: none;
            }
        </style>
    @endif
    @if(!auth()->user()->can("delete $permissionsData"))
        <style>
            a.delete{
                display: none;
            }
        </style>
    @endif

    @stack('css')
    <!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>



    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/codebase/themes/corporate.scss', 'resources/js/codebase/app.js']) --}}
</head>

<body>
  <form id="logoutForm" action="{{route('backend.logout')}}" method="POST">@csrf</form>
  <!-- Page Container -->
  <!--
    Available classes for #page-container:

    SIDEBAR & SIDE OVERLAY

      'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
      'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
      'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
      'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
      'sidebar-dark'                              Dark themed sidebar

      'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
      'side-overlay-o'                            Visible Side Overlay by default

      'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

      'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

      ''                                          Static Header if no class is added
      'page-header-fixed'                         Fixed Header

    HEADER STYLE

      ''                                          Classic Header style if no class is added
      'page-header-modern'                        Modern Header style
      'page-header-dark'                          Dark themed Header (works only with classic Header style)
      'page-header-glass'                         Light themed Header with transparency by default
                                                  (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
      'page-header-glass page-header-dark'        Dark themed Header with transparency by default
                                                  (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

    MAIN CONTENT LAYOUT

      ''                                          Full width Main Content if no class is added
      'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
      'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

    DARK MODE

      'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
  -->
  <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
    <!-- Side Overlay-->
    <aside id="side-overlay">
      <!-- Side Header -->
      <div class="content-header">
        <!-- User Avatar -->
        <a class="img-link me-2" href="javascript:void(0)">
          <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
        </a>
        <!-- END User Avatar -->

        <!-- User Info -->
        <a class="link-fx text-body-color-dark fw-semibold fs-sm" href="javascript:void(0)">
          John Smith
        </a>
        <!-- END User Info -->

        <!-- Close Side Overlay -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <button type="button" class="btn btn-sm btn-alt-danger ms-auto" data-toggle="layout" data-action="side_overlay_close">
          <i class="fa fa-fw fa-times"></i>
        </button>
        <!-- END Close Side Overlay -->
      </div>
      <!-- END Side Header -->

      <!-- Side Content -->
      <div class="content-side">
        <p>
          Content..
        </p>
      </div>
      <!-- END Side Content -->
    </aside>
    <!-- END Side Overlay -->

    <!-- Sidebar -->
    <!--
      Helper classes

      Adding .smini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
      Adding .smini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .no-transition along with one of the previous 2 classes

      Adding .smini-hidden to an element will hide it when the sidebar is in mini mode
      Adding .smini-visible to an element will show it only when the sidebar is in mini mode
      Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar">
      <!-- Sidebar Content -->
      @include('backend.partials.sidebar')
      <!-- Sidebar Content -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
      <!-- Header Content -->
      <div class="content-header">
        <!-- Left Section -->
        <div class="space-x-1">
          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button>
          <!-- END Toggle Sidebar -->

          <!-- Open Search Section -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="header_search_on">
            <i class="fa fa-fw fa-search"></i>
          </button>
          <!-- END Open Search Section -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="space-x-1">
          <!-- User Dropdown -->
          <div class="dropdown d-inline-block">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user d-sm-none"></i>
              <span class="d-none d-sm-inline-block fw-semibold">{{ Auth::user()->name }}</span>
              <i class="fa fa-angle-down opacity-50 ms-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
              <div class="px-2 py-3 bg-body-light rounded-top">
                <h5 class="h6 text-center mb-0">
                  {{ Auth::user()->name }}
                </h5>
              </div>
              <div class="p-2">
                <!-- <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="javascript:void(0)">
                  <span>Profile</span>
                  <i class="fa fa-fw fa-user opacity-25"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                  <span>Inbox</span>
                  <i class="fa fa-fw fa-envelope-open opacity-25"></i>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="javascript:void(0)">
                  <span>Invoices</span>
                  <i class="fa fa-fw fa-file opacity-25"></i>
                </a>
                <div class="dropdown-divider"></div> -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="{{ route('backend.edit_password.index') }}">
                  <span>{{ __('edit_password') }}</span>
                  <i class="fa fa-fw fa-wrench opacity-25"></i>
                </a>
                <!-- END Side Overlay -->

                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="javascript:void(0)" onclick="$('#logoutForm').submit()">
                  <span>{{ __('sign_out') }}</span>
                  <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- END User Dropdown -->

          <!-- Notifications -->
          <div class="dropdown d-inline-block">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-flag"></i>
              <span class="text-primary">&bull;</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications">
              <div class="px-2 py-3 bg-body-light rounded-top">
                <h5 class="h6 text-center mb-0">
                  Notifications
                </h5>
              </div>
              <ul class="nav-items my-2 fs-sm">
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-check text-success"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <p class="fw-medium mb-1">You’ve upgraded to a VIP account successfully!</p>
                      <div class="text-muted">15 min ago</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <p class="fw-medium mb-1">Please check your payment info since we can’t validate them!</p>
                      <div class="text-muted">50 min ago</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-times text-danger"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <p class="fw-medium mb-1">Web server stopped responding and it was automatically restarted!</p>
                      <div class="text-muted">4 hours ago</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <p class="fw-medium mb-1">Please consider upgrading your plan. You are running out of space.</p>
                      <div class="text-muted">16 hours ago</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-plus text-primary"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <p class="fw-medium mb-1">New purchases! +$250</p>
                      <div class="text-muted">1 day ago</div>
                    </div>
                  </a>
                </li>
              </ul>
              <div class="p-2 bg-body-light rounded-bottom">
                <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                  <i class="fa fa-fw fa-flag opacity-50 me-1"></i> View All
                </a>
              </div>
            </div>
          </div>
          <!-- END Notifications -->

          <!-- Toggle Side Overlay -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <!-- <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="side_overlay_toggle">
            <i class="fa fa-fw fa-stream"></i>
          </button> -->
          <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
      </div>
      <!-- END Header Content -->

      <!-- Header Search -->
      <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
          <form class="w-100" action="/dashboard" method="POST">
            @csrf
            <div class="input-group">
              <!-- Close Search Section -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                <i class="fa fa-fw fa-times"></i>
              </button>
              <!-- END Close Search Section -->
              <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
              <button type="submit" class="btn btn-secondary">
                <i class="fa fa-fw fa-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
      <!-- END Header Search -->

      <!-- Header Loader -->
      <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header">
          <div class="w-100 text-center">
            <i class="far fa-sun fa-spin text-white"></i>
          </div>
        </div>
      </div>
      <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      <div class="content">
        @yield('content')
      </div>
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer">
      <div class="content py-3">
        <div class="row fs-sm">
          <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
          </div>
          <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
            <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Codebase</a> &copy; <span data-toggle="year-copy"></span>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->
  </div>
  <!-- END Page Container -->
    <!-- Codebase Core JS -->
    <script src="{{ asset('/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('plugins/filepond/dist/filepond.js') }}"></script>
    <script src="{{ asset('plugins/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js') }}"></script>
    <script src="{{ asset('plugins/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('plugins/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js') }}"></script>
    <script src="{{ asset('plugins/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js') }}"></script>
    <script src="{{ asset('js/plugins/vakata-jstree/jstree.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script>
        function decodeEntities(encodedString) {
            var div = document.createElement('div');
            div.innerHTML = encodedString;
            return div.textContent;
        }
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ajax: 1
                }
            });

            $( document ).ajaxError(function( event, jqxhr, settings, thrownError ) {
                if(thrownError === 'abort'){
                    return;
                }
                var meessage = [];
                if(jqxhr.responseJSON && jqxhr.responseJSON.errors){
                    $.each(jqxhr.responseJSON.errors,function(key,value){
                        meessage.push(value.shift());
                    })
                }else if(jqxhr.responseJSON && jqxhr.responseJSON.message){
                    meessage.push(jqxhr.responseJSON.message);
                }else{
                    meessage.push(thrownError);
                }
                Swal.fire({ html: meessage.join('<br />'), icon: 'error' })
            });

            $.extend( true, $.fn.dataTable.defaults, {
                language: { url: '{{ asset('zh-Hant.json') }}' },
                fnDrawCallback: function () {
                    Codebase.helpers('magnific-popup');
                },
            } );

            Codebase.helpers(['summernote']);
            Codebase.helpers('magnific-popup');
            Codebase.helpers('select2');
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateType,
                FilePondPluginFileEncode
            );
            FilePond.setOptions({
                server: {
                  process: '{{ route('backend.tmp_files.store') }}',
                  revert: '{{ route('backend.tmp_files.destroy') }}',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                },
                allowPaste: false
            });

            $('.summernote').each(function(){
                let _this = $(this);
                _this.summernote({
                    callbacks: {
                        onImageUpload: function(files,editor) {
                            var form_data = new FormData();
                            form_data.append('image', files[0]);
                            $.ajax({
                                data: form_data,
                                type: "POST",
                                url: '{{ route('backend.upload.store') }}',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    var url = data.path;
                                    var image = $('<img>').attr('src', url);
                                    _this.summernote("insertNode", image[0]);
                                    // $summernote.summernote('insertNode', url);
                                    // $(this).summernote('editor.insertImage', url);
                                }
                            });

                        }
                    }
                });
            });

            $('form .css-switch input[type="checkbox"]').change(function(){
                var status = $(this).prop('checked') ? 1 : 0;
                $(this).next().val(status);
            })

            function chageLanguage(change = ''){
                var language_id = $('select[name="language_id"]').val() ;
                $('.js-select2:not([not-language])').find(`option, optgroup`).attr('disabled', 'disabled');
                $('.js-select2:not([not-language])').find(`option[data-language_id=${ language_id }], optgroup[data-language_id=${ language_id }]`).attr('disabled', false);
                if(change){
                    $('.js-select2').val([]).trigger('change');
                }
            }

            $('select[name="language_id"]').change(function() {
                chageLanguage(true);
            })

            // chageLanguage(false);

            function checkMenu(menus) {
                var check = false;
                menus.each(function() {
                    let menu = $(this);
                    let child = $(this).children('ul').children('li');
                    if(child.length > 0){
                        child.each(function() {
                            if($(this).children('a:not(.nav-submenu)').length > 0) {
                                menu.show();
                                $(this).show();
                                check = true;
                            }
                            if($(this).children('a.nav-submenu').length > 0) {
                                if(checkMenu($(this))){
                                    menu.show();
                                    $(this).show();
                                    check = true;
                                }
                            }
                        })
                    }else{
                        $(this).show();
                        check = true;
                    }
                })

                return check;
            }

            checkMenu($('.nav-main > li'));

            $('.js-select2[data-ajax--url]').each(function(){
                    let name = $(this).attr('name');
                    $(this).select2({
                        allowClear: true,
                        ajax: {
                            processResults: function(data, page) {
                                return {
                                    results: data.map(item => { return {
                                        id: item.id,
                                        text: item.name || item.no
                                    } })
                                }
                            },
                        }
                    });
                })

                //show
                @isset($show)
                    $("#form-edit [name]").attr('disabled', 'disabled');
                    $("#form-edit [type='submit']").hide();
                    $("#form-edit .css-switch").addClass('disabled');
                @endisset

        });
    </script>
        <script>
          {{--
            function getNotify() {
                $.ajax({
                    url: `{{route('backend.notify.index')}}`,
                    type: "GET",
                    dataType: "JSON",
                    success: function(result) {
                        $('#message_count').text(result.count);
                        let str = '';
                        result.messages.map((item) => {
                            str += `<li>
                                <a class="text-body-color-dark media mb-15" href="{{route('backend.messages.index')}}/${item.id}">
                                    <div class="ml-5 mr-15">
                                        <i class="fa fa-fw fa-inbox text-success"></i>
                                    </div>
                                    <div class="media-body pr-10">
                                        <p class="mb-0">${item.title}</p>
                                        <div class="text-muted font-size-sm font-italic">${item.created_at}</div>
                                    </div>
                                </a>
                            </li>`
                        });
                        $('#message_content').html(str);
                        if(result.new) {
                            result.new.map((item) => {
                                let d = new Date(item.created_at)
                                Codebase.helpers('notify', {
                                    align: 'right',             // 'right', 'left', 'center'
                                    from: 'top',                // 'top', 'bottom'
                                    type: 'warning',               // 'info', 'success', 'warning', 'danger'
                                    icon: 'fa fa-info mr-5',    // Icon class
                                    message: `[${d.toLocaleString()}] - ${item.title}`
                                });

                            })
                        }

                    }
                })
            }
            // setInterval("getNotify()", 5000);
          --}}

          function successFunc(data, path){
            Swal.fire({ text: data.message, icon: 'success' }).then(function() {
                // location.href = path;
            });
          }          
        </script>
    @stack('scripts')
</body>

</html>
