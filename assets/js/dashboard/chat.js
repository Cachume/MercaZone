let currentOrderId = null;
const baseURL = `${window.location.protocol}//${window.location.hostname}/MercaZone/`;

$(document).ready(function() {
    $(document).on("click", ".wapisimo", function(){
        $('.dashboard-orders').hide();
        $(".dashboard-purchases").hide();
        $('.dashboard-chat').css('display', 'flex');
        currentOrderId = $(this).data("id");
        loadMessages(currentOrderId);
        setInterval(() => {
            loadMessages(currentOrderId);
        }, 3000);
    });

    $('#send-message').on('click', function(){
        const messageText = $('#chat-message-input').val().trim();
        if(messageText === '' || !currentOrderId) return;
        const formData = new FormData();
        formData.append('order_id', currentOrderId);
        formData.append('message', messageText);
        fetch(`${baseURL}dashboard/sendChatMessage`, {
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

    })

    $('#chat-text').on('keypress', function(e){
        if(e.which === 13){ // Enter
            $('#send-message').click();
            e.preventDefault();
        }
    });



});

function loadMessages(orden){
    fetch(`${baseURL}dashboard/getChatMessage`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                order_id: orden,
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                const chatMessages = $('#chat-messages');
                var localuser = data.localuser
                chatMessages.empty(); 
                data.messages.forEach(msg => {
                    const messageType = (msg.id_usuario === localuser) ? 'sent' : 'received';
                    if(msg.id_usuario != localuser){
                        $(".chat-userdata-name").text(msg.sender_name)
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
            }
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}