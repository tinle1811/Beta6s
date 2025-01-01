<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Products - E-commerce | Front - Admin &amp; Dashboard Template</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assetsAdmin\css\vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('assetsAdmin\vendor\icon-set\style.css')}}">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assetsAdmin\css\theme.min.css?v=1.0')}}">
    <!-- CSS Category -->
    <link rel="stylesheet" href="{{asset('CssAdmin\category.css')}}">
  </head>
  <body class="footer-offset">
    <script src="{{asset('assetsAdmin\vendor\hs-navbar-vertical-aside\hs-navbar-vertical-aside-mini-cache.js')}}"></script>

    <!-- Builder -->
    @include('admin.layouts.builder')
      <!-- End Builder -->
      <!-- Builder Toggle -->
    @include('admin.layouts.toggle')
      <!-- End Builder Toggle -->
      <!-- JS Preview mode only -->
    @include("admin.layouts.navbar")
    @include('admin.layouts.header')
    @include("admin.layouts.sidebar")

      <script src="{{asset('assetsAdmin\js\demo.js')}}"></script>
    
    <!-- END ONLY DEV -->
    @yield('content')
    @include('admin.layouts.footer')
    <!-- JS Implementing Plugins -->
    <script src="{{asset('assetsAdmin\js\vendor.min.js')}}"></script>
    <!-- JS Front -->
    <script src="{{asset('assetsAdmin\js\theme.min.js')}}"></script>
    <!-- JS Plugins Init. -->
    <script>
      $(document).on('ready', function () {
        // ONLY DEV
        // =======================================================
        
          if (window.localStorage.getItem('hs-builder-popover') === null) {
            $('#builderPopover').popover('show')
              .on('shown.bs.popover', function () {
                $('.popover').last().addClass('popover-dark')
              });

            $(document).on('click', '#closeBuilderPopover' , function() {
              window.localStorage.setItem('hs-builder-popover', true);
              $('#builderPopover').popover('dispose');
            });
          } else {
            $('#builderPopover').on('show.bs.popover', function () {
              return false
            });
          }

        // END ONLY DEV
        // =======================================================
        // BUILDER TOGGLE INVOKER
        // =======================================================
        $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
          $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
        });
          // INITIALIZATION OF MEGA MENU
          // =======================================================
          var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
            desktop: {
              position: 'left'
            }
          }).init();    
        // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
        // =======================================================
        var sidebar = $('.js-navbar-vertical-aside').hsSideNav();
        // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
        // =======================================================
        $('.js-nav-tooltip-link').tooltip({ boundary: 'window' })

        $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
          if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
            return false;
          }
        });

        
        // INITIALIZATION OF UNFOLD
        // =======================================================
        $('.js-hs-unfold-invoker').each(function () {
          var unfold = new HSUnfold($(this)).init();
        });

        
        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        $('.js-form-search').each(function () {
          new HSFormSearch($(this)).init()
        });


        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        $('.js-nav-scroller').each(function () {
          new HsNavScroller($(this)).init()
        });

        
        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function () {
          var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        
        // INITIALIZATION OF DATATABLES
        // =======================================================
        var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
          select: {
            style: 'multi',
            selector: 'td:first-child input[type="checkbox"]',
            classMap: {
              checkAll: '#datatableCheckAll',
              counter: '#datatableCounter',
              counterInfo: '#datatableCounterInfo'
            }
          },
          language: {
            zeroRecords: '<div class="text-center p-4">' +
                '<img class="mb-3" src="./assetsAdmin/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                '<p class="mb-0">No data to show</p>' +
                '</div>'
          }
        });

        $('.js-datatable-filter').on('change', function() {
          var $this = $(this),
            elVal = $this.val(),
            targetColumnIndex = $this.data('target-column-index');

          datatable.column(targetColumnIndex).search(elVal).draw();
        });

        $('#datatableSearch').on('mouseup', function (e) {
          var $input = $(this),
            oldValue = $input.val();

          if (oldValue == "") return;

          setTimeout(function(){
            var newValue = $input.val();

            if (newValue == ""){
              // Gotcha
              datatable.search('').draw();
            }
          }, 1);
        });

        $('#toggleColumn_product').change(function (e) {
          datatable.columns(1).visible(e.target.checked)
        })

        $('#toggleColumn_type').change(function (e) {
          datatable.columns(2).visible(e.target.checked)
        })

        datatable.columns(3).visible(false)

        $('#toggleColumn_vendor').change(function (e) {
          datatable.columns(3).visible(e.target.checked)
        })

        $('#toggleColumn_stocks').change(function (e) {
          datatable.columns(4).visible(e.target.checked)
        })

        $('#toggleColumn_sku').change(function (e) {
          datatable.columns(5).visible(e.target.checked)
        })

        $('#toggleColumn_price').change(function (e) {
          datatable.columns(6).visible(e.target.checked)
        })

        datatable.columns(7).visible(false)

        $('#toggleColumn_quantity').change(function (e) {
          datatable.columns(7).visible(e.target.checked)
        })

        $('#toggleColumn_variants').change(function (e) {
          datatable.columns(8).visible(e.target.checked)
        })

        
        // INITIALIZATION OF TAGIFY
        // =======================================================
        $('.js-tagify').each(function () {
          var tagify = $.HSCore.components.HSTagify.init($(this));
        });
      });
    </script>
    <!-- IE Support -->
    <script>
      if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="./assetsAdmin/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
  </body>
</html>
