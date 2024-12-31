<div class="popup-container popup-login">
    <div id="boxes" class="popup-container-inner">
        <div id="dialog" class="window">
            <div id="popup-close">
                <span>X</span>
            </div>
            <div class="box">
                <div class="popup-title">
                    <h2>Đăng nhập</h2>
                </div>
                <div class="popup-content">
                    <form action="#" method="POST">
                        @csrf
                        <p>
                            <label>Email: </label>
                            <input type="email" name="email" required placeholder="Nhập địa chỉ email tại đây">
                        </p>
                        <p>
                            <label>Mật Khẩu: </label>
                            <input type="password" name="password" required placeholder="Nhập mật khẩu tại đây">
                        </p>
                        <div class="login_submit">
                            <a href="#">Quên mật khẩu</a>
                            <label for="remember">
                                <input id="remember" type="checkbox"> Nhớ mật khẩu
                            </label>
                            <div class="submit-button">
                                <button type="submit">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
