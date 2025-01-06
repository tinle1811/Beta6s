<!-- Popup -->
<!-- Popup -->
<div id="login-popup" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100">Đăng Nhập</h3>
                <button type="button" class="btn-close" onclick="closeLoginPopup()" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-between pt-0">
                <div  class="d-flex align-items-center">
                    <img id="logo" src="{{asset('assets/img/logoBeta6s.jpg')}}"  class="">
                </div>
                <div class="form-section" style="flex: 1; padding: 1.5rem;">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" id="Email" name="Email" class="form-control" placeholder="Nhập email"
                             required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Mật khẩu</label>
                            <input type="password" id="Password" name="Password" class="form-control"
                                placeholder="Nhập mật khẩu" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                    </form>
                    <a href="#">Quên mật khẩu?</a>
                    <div class="register_link text-center mt-1">
                        <p>Bạn chưa có tài khoản?<a href="{{route("user.auth.register")}}" class="text-primary text-decoration-none">Đăng ký</a></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Overlay -->
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;" onclick="closeLoginPopup()"></div>
{{-- <script>
    function openLoginPopup() {
    const loginModal = new bootstrap.Modal(document.getElementById('login-popup'));
    loginModal.show();
    }

    function closeLoginPopup() {
        const loginModal = bootstrap.Modal.getInstance(document.getElementById('login-popup'));
        loginModal.hide();
    }

    // Xử lý gửi form
    document.getElementById('login-form').addEventListener('submit', async function (e) {
        e.preventDefault(); // Ngăn chặn reload trang

        const formData = new FormData(this);

        try {
            const response = await fetch("{{ route('login') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message);
                closeLoginPopup();
                window.location.reload(); // Reload trang nếu cần
            } else {
                alert(result.message);
            }
        } catch (error) {
            alert('Đã xảy ra lỗi! Vui lòng thử lại.');
        }
    });
</script> --}}
