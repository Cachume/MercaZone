let currentOrderId = null;

$(document).ready(function() {
    $(document).on("click", ".wapisimo", function(){
        $('.dashboard-orders').hide();
        $(".dashboard-purchases").hide();
        $('.dashboard-chat').css('display', 'flex');
        currentOrderId = $(this).data("id");
        console.log(currentOrderId);
        loadMessages(currentOrderId);

        // 🔄 Recargar mensajes cada 3 segundos
        setInterval(() => {
            loadMessages(currentOrderId);
        }, 3000);
    });

    // ✉️ Enviar mensaje
    $('#send-message').on('click', function(){
        const messageText = $('#chat-message-input').val().trim();
        if(messageText === '' || !currentOrderId) return;

        const formData = new FormData();
        formData.append('order_id', currentOrderId);
        formData.append('message', messageText);

        fetch(`/dashboard/sendChatMessage`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                $('#chat-message-input').val('');
                loadMessages(currentOrderId); 
            } else {
                console.error("Error al enviar:", data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});

// 💬 Cargar mensajes del chat
function loadMessages(orden){
    fetch(`/dashboard/getChatMessage`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ order_id: orden })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            const chatMessages = $('#chat-messages');
            var localuser = data.localuser;

            chatMessages.empty(); 

            data.messages.forEach(msg => {
                const messageType = (msg.id_usuario === localuser) ? 'sent' : 'received';
                
                // Actualiza datos del otro usuario (nombre e imagen)
                if(msg.id_usuario != localuser){
                    $(".chat-userdata-name").text(msg.sender_name+" "+msg.sender_lastname);
                    $("#chat_user_img").attr("src","/"+msg.sender_photo);
                }
                
                const messageUser = msg.sender_name;
                const messageText = msg.mensaje;
                const messageTime = msg.time;

                const messageHTML = `
                    <div class="message">
                        <div class="message-container ${messageType}">
                            <span class="message-user">${messageUser}</span>
                            <p class="message-text">${messageText}</p>
                            <span class="message-time">${messageTime}</span>
                        </div>
                    </div>
                `;
                chatMessages.append(messageHTML);
            });

            // ✅ Mantener scroll al final del chat
            chatMessages.scrollTop(chatMessages[0].scrollHeight);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
