// Kiểm tra trạng thái đăng nhập của người dùng
function isUserLoggedIn() {
    return localStorage.getItem('isLoggedIn') === 'true'; 
}
// Hiển thị popup login
function showLoginPopup() {
    document.querySelector('.popup-login').style.display = 'flex';

}

// Đóng popup 
function closePopup() {
    document.querySelector('.popup-container').style.display = 'none';
}
// Hàm xử lý thêm vào giỏ hàng
function addToCart() {
    if (!isUserLoggedIn()) {
        showLoginPopup();
    } else {
        alert('Thêm vào giỏ hàng thành công');
    }
}

// Hàm xử lý thêm vào danh sách yêu thích
function addToWishlist() {
    if (!isUserLoggedIn()) {
        showLoginPopup();
    } else {
        alert('Thêm vào danh sách yêu thích thành công');
    }
}

// Đóng popup khi người dùng nhấn vào "X"
document.getElementById('popup-close').addEventListener('click', closePopup);

// Đóng popup khi người dùng nhấn ngoài vùng popup
window.addEventListener('click', function (event) {
    if (event.target === document.querySelector('.popup-container')) {
        closePopup();
    }
});

