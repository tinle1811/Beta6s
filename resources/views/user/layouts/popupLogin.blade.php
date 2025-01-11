<div id="login-popup" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100">Đăng Nhập</h3>
                <button type="button" class="btn-close" onclick="closeLoginPopup()" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-between pt-0">
                <div class="d-flex align-items-center">
                    <img id="logo" src="{{ asset('storage/logos/' . $websiteInfo->logo) }}" class="">
                </div>
                <div class="form-section" style="flex: 1; padding: 1.5rem;">
                    <form id="loginForm">
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
                        <div id="error-message" class="text-danger" style="display: none;"></div>
                        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                    </form>
                    <a href="#">Quên mật khẩu?</a>
                    <div class="register_link text-center mt-1">
                        <p>Bạn chưa có tài khoản?<a href="{{ route('user.auth.register') }}"
                                class="text-primary text-decoration-none">Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Overlay -->
<div id="overlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;"
    onclick="closeLoginPopup()"></div>


<script>
    // Biến đếm số lần đăng nhập thất bại
    let failedLoginAttempts = localStorage.getItem('failedLoginAttempts') || 0;

    document.getElementById('loginForm').addEventListener('submit', function (e) {
        // ngăn reload trang
        e.preventDefault();


        // tạo form để lấy dữ liệu
        let formData = new FormData(this);
        fetch('{{ route('login') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData // chứa dữ liệu từ form
        })
            // xử lý phản hồi
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Đăng nhập thành công, reset số lần thất bại
                    localStorage.setItem('failedLoginAttempts', 0);
                    window.location.href = data.redirect;
                } else {
                    failedLoginAttempts++;
                    localStorage.setItem('failedLoginAttempts', failedLoginAttempts);

                    document.getElementById('error-message').style.display = 'block';
                    document.getElementById('error-message').innerText = data.error;

                    if (failedLoginAttempts >= 3) {
                        alert("Bạn đã đăng nhập thất bại! Bạn có muốn đổi mật khẩu không?");
                        // window.location.href = '';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    });


    // Ẩn popup và lớp phủ (overlay) khi người dùng nhấn nút đóng hoặc bên ngoài popup.
    function closeLoginPopup() {
        document.getElementById('login-popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>