function openLoginPopup() {
    document.getElementById('login-popup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

function closeLoginPopup() {
    document.getElementById('login-popup').style.display = 'none';
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
