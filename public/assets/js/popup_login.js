function openLoginPopup() {
    console.log('openLoginPopup đã được gọi');
    const modalElement = document.getElementById('login-popup');
    if (!modalElement) {
        console.error('Không tìm thấy modal');
        return;
    }
    const loginModal = new bootstrap.Modal(modalElement);
    loginModal.show();
    document.getElementById('overlay').style.display = 'block';
    console.log('overlay đã được gọi');

}


function closeLoginPopup() {
    const loginModal = bootstrap.Modal.getInstance(document.getElementById('login-popup'));
    loginModal.hide();
    document.getElementById('overlay').style.display = 'none';
}


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
