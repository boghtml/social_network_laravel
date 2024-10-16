import { database } from './firebase';
import { ref, onChildAdded, push, set, serverTimestamp } from "firebase/database";

document.addEventListener('DOMContentLoaded', () => {
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    const chatUserIdMeta = document.querySelector('meta[name="chat-user-id"]');
    const userId = userIdMeta ? userIdMeta.getAttribute('content') : null;
    const chatUserId = chatUserIdMeta ? chatUserIdMeta.getAttribute('content') : null;
    const chatBox = document.querySelector('.chat-box');
    const form = document.querySelector('form');
    const input = document.querySelector('input[name="content"]');

    if (chatBox && form && input && userId && chatUserId) {
        const chatId = [userId, chatUserId].sort().join('_');
        const messagesRef = ref(database, 'messages/' + chatId);
        
        onChildAdded(messagesRef, (snapshot) => {
            const message = snapshot.val();
            addMessageToChat(message, message.sender_id == userId);
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const content = input.value.trim();
            if (!content) return;

            try {
                const newMessageRef = push(messagesRef);
                await set(newMessageRef, {
                    content: content,
                    sender_id: userId,
                    created_at: serverTimestamp()
                });
                input.value = '';
            } catch (error) {
                console.error('Помилка відправки повідомлення:', error);
            }
        });
    }

    function addMessageToChat(message, isSender = true) {
        if (!chatBox) return;

        const messageHtml = `
            <div class="${isSender ? 'text-end' : ''} mb-2">
                <div class="d-inline-block ${isSender ? 'bg-primary text-white' : 'bg-light'} p-2 rounded">
                    ${message.content}
                </div>
                <small class="text-muted d-block">${new Date(message.created_at).toLocaleString()}</small>
            </div>
        `;
        chatBox.insertAdjacentHTML('beforeend', messageHtml);
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});