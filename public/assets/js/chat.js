function toggleChat() {
    const chatPopup = document.getElementById('chatPopup');
    chatPopup.style.display = chatPopup.style.display === 'none' || chatPopup.style.display === '' ? 'flex' : 'none';
}

function sendMessage() {
    const chatInput = document.getElementById('chatInput');
    const chatBody = document.getElementById('chatBody');

    if (chatInput.value.trim() !== '') {
        const messageDiv = document.createElement('div');
        messageDiv.textContent = chatInput.value;
        messageDiv.style.marginBottom = '10px';
        messageDiv.style.padding = '10px';
        messageDiv.style.backgroundColor = '#f1f1f1';
        messageDiv.style.borderRadius = '10px';

        chatBody.appendChild(messageDiv);
        chatBody.scrollTop = chatBody.scrollHeight;

        chatInput.value = '';
    }
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Ngăn hành vi mặc định của phím Enter
        sendMessage(); // Gọi hàm gửi tin nhắn
    }
}