@extends('admin.layouts.app')
@section('title', $viewData['title'])
@section('content')
<main id="content" role="main" class="main">
  <!-- Content -->
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col-sm mb-2 mb-sm-0">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter">
              <li class="breadcrumb-item"><a class="breadcrumb-link" href="ecommerce-products.html">Products</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add product</li>
            </ol>
          </nav>

          <h1 class="page-header-title">Cập Nhật Sản Phẩm </h1>
        </div>
      </div>
      <!-- End Row -->
    </div>
    <!-- End Page Header -->

    <div class="row">
      <div class="col-lg-8">
        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
          <!-- Header -->
          <div class="card-header">
            <h4 class="card-header-title">Thông Tin Sản Phẩm</h4>
          </div>
          <!-- End Header -->
          @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
        </ul>
        </div>
      @endif
          <form action="{{ route('admin.product.update', $product->MaSP)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF Token bảo mật cho form POST -->
            <!-- Body -->
            <div class="card-body">

              <!-- Tên sản phẩm -->
              <div class="form-group">
                <label for="productNameLabel" class="input-label">Tên Sản Phẩm <i
                    class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top"
                    title="Products are the goods or services you sell."></i></label>
                <input type="text" value="{{ $product->TenSP }}" class="form-control" name="TenSP" id="productNameLabel"
                  placeholder="Shirt, t-shirts, etc." aria-label="Shirt, t-shirts, etc." required>
              </div>

              <!-- Hình ảnh -->
              <div class="card mb-3 mb-lg-5">
                <div class="card-header">
                  <h4 class="card-header-title">Hình Ảnh</h4>
                </div>
                <div class="card-body">
                  <div id="attachFilesNewProjectLabel" class="js-dropzone dropzone-custom custom-file-boxed">
                    <div class="dz-message custom-file-boxed-label">
                      <input type="file" name="HinhAnh" id="productImage">
                      @if($product->HinhAnh)
              <img src="{{ asset('storage/' . $product->HinhAnh) }}" alt="{{ $product->TenSP }}"
              style="max-width: 100px; margin-top: 10px;">
            @endif

                    </div>
                  </div>
                </div>
              </div>

              <!-- Số lượng -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="quantityNameLabel" class="input-label">Số Lượng</label>
                    <input type="number" value="{{ $product->SoLuong }}" class="form-control" name="SoLuong"
                      id="quantityNameLabel" placeholder="0" min="0" required>
                  </div>
                </div>

                <!-- Giá -->
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="priceNameLabel" class="input-label">Giá</label>
                    <input type="number" value="{{ $product->Gia }}" class="form-control" name="Gia" id="priceNameLabel"
                      placeholder="0" min="0" step="0.01" required>
                  </div>
                </div>
              </div>

              <!-- Mô tả -->
              <div class="form-group">
                <label class="input-label">Mô Tả <span class="input-label-secondary">(Optional)</span></label>
                <textarea name="MoTa" class="form-control" rows="5"
                  placeholder="Nhập mô tả sản phẩm">{{ old('MoTa', $product->MoTa) }}</textarea>
              </div>

              <!-- Trạng thái sản phẩm -->
              <div class="form-group">
                <label for="TrangThai">Trạng thái</label>
                <select name="TrangThai" id="TrangThai" class="form-control">
                  <option value="1" {{ $product->TrangThai == 1 ? 'selected' : '' }}>Còn Hàng</option>
                  <option value="0" {{ $product->TrangThai == 0 ? 'selected' : '' }}>Hết Hàng</option>
                </select>
              </div>
              <div class="form-group">
                <label for="LoaiSP">Loại sản phẩm</label>
                <select name="LoaiSP" id="LoaiSP" class="form-control" required>
                  @foreach($categories as $category)
            <option value="{{ $category->MaLSP }}" {{ $product->LoaiSP == $category->MaLSP ? 'selected' : '' }}>
            {{ $category->TenLSP }}
            </option>
          @endforeach
                </select>
              </div>
              <!-- Nút Thêm -->
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
              </div>

            </div>
          </form>


        </div>
        <!-- Body -->
      </div>
      <!-- End Card -->
    </div>
  </div>
  <!-- End Row -->

  {{-- <div class="position-fixed bottom-0 content-centered-x w-100 z-index-99 mb-3" style="max-width: 40rem;">
    <!-- Card -->
    <div class="card card-sm bg-dark border-dark mx-2">
      <div class="card-body">
        <div class="row justify-content-center justify-content-sm-between">
          <div class="col">
            <button type="button" class="btn btn-ghost-danger">Delete</button>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-ghost-light mr-2">Discard</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- End Row -->
      </div>
    </div> --}}
    <!-- End Card -->
  </div>
  </div>
  @endsection