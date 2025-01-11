<button class="toggle-chat" onclick="toggleChat()" style="z-index: 9999;">💬</button>

<div class="chat-popup" id="chatPopup">
    <div class="chat-header" onclick="toggleChat()">Chat với chúng tôi</div>
    <div class="chat-body" id="chatBody"></div>
    <div class="chat-footer">
        <input type="text" id="chatInput" placeholder="Nhập nội dung..." onkeydown="handleKeyPress(event)">
        <button onclick="sendMessage()">Gửi</button>
    </div>
</div>