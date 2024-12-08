@extends('admin.layouts.app')
{{--   --}}
@section('content')
  <main id="content" role="main" class="main"> 
      <!-- Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center mb-3">
          <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">{{$viewData['title']}} <span class="badge badge-soft-dark ml-2">72,031</span></h1>

            <div class="mt-2">
              <a class="text-body mr-3" href="javascript:;" data-toggle="modal" data-target="#exportProductsModal">
                <i class="tio-download-to mr-1"></i> Export
              </a>
              <a class="text-body" href="javascript:;" data-toggle="modal" data-target="#importProductsModal">
                <i class="tio-publish mr-1"></i> Import
              </a>
            </div>
          </div>

          <div class="col-sm-auto">
            <a class="btn btn-primary" href="ecommerce-add-product.html">Add product</a>
          </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <span class="hs-nav-scroller-arrow-prev" style="display: none;">
            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
              <i class="tio-chevron-left"></i>
            </a>
          </span>

          <span class="hs-nav-scroller-arrow-next" style="display: none;">
            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
              <i class="tio-chevron-right"></i>
            </a>
          </span>

          <!-- Nav -->
          <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#">All products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Archived</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Publish</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Unpublish</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
      </div>
      <!-- End Page Header -->

      <div class="row justify-content-end mb-3">
        <div class="col-lg">
          <!-- Datatable Info -->
          <div id="datatableCounterInfo" style="display: none;">
            <div class="d-sm-flex justify-content-lg-end align-items-sm-center">
              <span class="d-block d-sm-inline-block font-size-sm mr-3 mb-2 mb-sm-0">
                <span id="datatableCounter">0</span>
                Selected
              </span>
              <a class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 mr-2" href="javascript:;">
                <i class="tio-delete-outlined"></i> Delete
              </a>
              <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                <i class="tio-archive"></i> Archive
              </a>
              <a class="btn btn-sm btn-white mb-2 mb-sm-0 mr-2" href="javascript:;">
                <i class="tio-publish"></i> Publish
              </a>
              <a class="btn btn-sm btn-white mb-2 mb-sm-0" href="javascript:;">
                <i class="tio-clear"></i> Unpublish
              </a>
            </div>
          </div>
          <!-- End Datatable Info -->
        </div>
      </div>
      <!-- End Row -->

      <!-- Card -->
      <div class="card">
        <!-- Header -->
        <div class="card-header">
          <div class="row justify-content-between align-items-center flex-grow-1">
            <div class="col-md-4 mb-3 mb-md-0">
              <form>
                <!-- Search -->
                <div class="input-group input-group-merge input-group-flush">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="tio-search"></i>
                    </div>
                  </div>
                  <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                </div>
                <!-- End Search -->
              </form>
            </div>

            <div class="col-auto">
              <!-- Unfold -->
              <div class="hs-unfold mr-2">
                <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;" data-hs-unfold-options='{
                    "target": "#datatableFilterSidebar",
                    "type": "css-animation",
                    "animationIn": "fadeInRight",
                    "animationOut": "fadeOutRight",
                    "hasOverlay": true,
                    "smartPositionOff": true
                  }'>
                  <i class="tio-filter-list mr-1"></i> Filters
                </a>
              </div>
              <!-- End Unfold -->

              <!-- Unfold -->
              <div class="hs-unfold">
                <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;" data-hs-unfold-options='{
                    "target": "#showHideDropdown",
                    "type": "css-animation"
                  }'>
                  <i class="tio-table mr-1"></i> Columns <span class="badge badge-soft-dark rounded-circle ml-1">6</span>
                </a>

                <div id="showHideDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card" style="width: 15rem;">
                  <div class="card card-sm">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Product</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_product">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_product" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Type</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_type">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_type" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Vendor</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_vendor">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_vendor">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Stocks</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_stocks">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_stocks" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">SKU</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_sku">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_sku" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Price</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_price">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_price" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="mr-2">Quantity</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_quantity">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_quantity">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>

                      <div class="d-flex justify-content-between align-items-center">
                        <span class="mr-2">Variants</span>

                        <!-- Checkbox Switch -->
                        <label class="toggle-switch toggle-switch-sm" for="toggleColumn_variants">
                          <input type="checkbox" class="toggle-switch-input" id="toggleColumn_variants" checked="">
                          <span class="toggle-switch-label">
                            <span class="toggle-switch-indicator"></span>
                          </span>
                        </label>
                        <!-- End Checkbox Switch -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Unfold -->
            </div>
          </div>
          <!-- End Row -->
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
          <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                  "columnDefs": [{
                      "targets": [0, 4, 9],
                      "width": "5%",
                      "orderable": false
                    }],
                  "order": [],
                  "info": {
                    "totalQty": "#datatableWithPaginationInfoTotalQty"
                  },
                  "search": "#datatableSearch",
                  "entries": "#datatableEntries",
                  "pageLength": 12,
                  "isResponsive": false,
                  "isShowPaging": false,
                  "pagination": "datatablePagination"
                }'>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="table-column-pr-0">
                  <div class="custom-control custom-checkbox">
                    <input id="datatableCheckAll" type="checkbox" class="custom-control-input">
                    <label class="custom-control-label" for="datatableCheckAll"></label>
                  </div>
                </th>
                <th class="table-column-pl-0">Product</th>
                <th>Type</th>
                <th>Vendor</th>
                <th>Stocks</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Variants</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="table-column-pr-0">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="productsCheck1">
                    <label class="custom-control-label" for="productsCheck1"></label>
                  </div>
                </td>
                <td class="table-column-pl-0">
                  <a class="media align-items-center" href="ecommerce-product-details.html">
                    <img class="avatar avatar-lg mr-3" src="assets\img\400x400\img4.jpg" alt="Image Description">
                    <div class="media-body">
                      <h5 class="text-hover-primary mb-0">Photive wireless speakers</h5>
                    </div>
                  </a>
                </td>
                <td>Electronics</td>
                <td>Google</td>
                <td>
                  <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox1">
                    <input type="checkbox" class="toggle-switch-input" id="stocksCheckbox1" checked="">
                    <span class="toggle-switch-label">
                      <span class="toggle-switch-indicator"></span>
                    </span>
                  </label>
                </td>
                <td>2384741241</td>
                <td>$65</td>
                <td>60</td>
                <td>2</td>
                <td>
                  <div class="btn-group" role="group">
                    <a class="btn btn-sm btn-danger" href="ecommerce-product-details.html">
                      <i class="tio-edit"></i> Edit
                    </a>
                  <div class="btn-group" role="group">
                      <a class="btn btn-sm btn-success" href="ecommerce-product-details.html">
                        <i class="tio-trash"></i> delete
                      </a>
                    <!-- Unfold -->
                    {{-- <div class="hs-unfold btn-group">
                      <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-white dropdown-toggle dropdown-toggle-empty" href="javascript:;" data-hs-unfold-options='{
                          "target": "#productsEditDropdown1",
                          "type": "css-animation",
                          "smartPositionOffEl": "#datatable"
                        }'></a>

                      <div id="productsEditDropdown1" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                        <a class="dropdown-item" href="#">
                          <i class="tio-delete-outlined dropdown-item-icon"></i> Delete
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="tio-archive dropdown-item-icon"></i> Archive
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="tio-publish dropdown-item-icon"></i> Publish
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="tio-clear dropdown-item-icon"></i> Unpublish
                        </a>
                      </div>
                    </div> --}}
                    <!-- End Unfold -->
                  </div>
                </td>
              </tr>

          
            </tbody>
          </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
          <!-- Pagination -->
          <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
            <div class="col-sm mb-2 mb-sm-0">
              <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                <span class="mr-2">Showing:</span>

                <!-- Select -->
                <select id="datatableEntries" class="js-select2-custom" data-hs-select2-options='{
                          "minimumResultsForSearch": "Infinity",
                          "customClass": "custom-select custom-select-sm custom-select-borderless",
                          "dropdownAutoWidth": true,
                          "width": true
                        }'>
                  <option value="12" selected="">12</option>
                  <option value="14">14</option>
                  <option value="16">16</option>
                  <option value="18">18</option>
                </select>
                <!-- End Select -->

                <span class="text-secondary mr-2">of</span>

                <!-- Pagination Quantity -->
                <span id="datatableWithPaginationInfoTotalQty"></span>
              </div>
            </div>

            <div class="col-sm-auto">
              <div class="d-flex justify-content-center justify-content-sm-end">
                <!-- Pagination -->
                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
              </div>
            </div>
          </div>
          <!-- End Pagination -->
        </div>
        <!-- End Footer -->
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->


  </main>
@endsection

   