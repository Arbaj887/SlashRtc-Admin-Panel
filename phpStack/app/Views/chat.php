<?php
@include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="h-screen flex bg-gray-100">
        <nav class="w-80 bg-white border-r border-gray-200 flex-none">
            <div class="p-4 border-b border-gray-200">
                <h1 class="text-xl font-semibold text-gray-800">Contacts</h1>
            </div>
            <div class="overflow-y-auto h-[calc(100vh-73px)]">
                <div class="contact hover:bg-gray-50 p-4 cursor-pointer border-b border-gray-100 flex items-center space-x-4">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde" alt="Contact 1" class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800">John Smith</h3>
                        <p class="text-sm text-gray-500 truncate">Hey, how are you doing?</p>
                    </div>
                </div>
                <div class="contact hover:bg-gray-50 p-4 cursor-pointer border-b border-gray-100 flex items-center space-x-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" alt="Contact 2" class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800">Sarah Wilson</h3>
                        <p class="text-sm text-gray-500 truncate">Let's meet tomorrow!</p>
                    </div>
                </div>
                <div class="contact hover:bg-gray-50 p-4 cursor-pointer border-b border-gray-100 flex items-center space-x-4">
                    <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36" alt="Contact 3" class="w-12 h-12 rounded-full object-cover">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800">Mike Johnson</h3>
                        <p class="text-sm text-gray-500 truncate">Thanks for your help!</p>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 flex flex-col">
            <header class="bg-white border-b border-gray-200 p-4 flex items-center space-x-4">
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde" alt="Current chat" class="w-12 h-12 rounded-full object-cover">
                <div class="flex-1">
                    <h2 class="font-medium text-gray-800">John Smith</h2>
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="text-sm text-gray-500">Online</span>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50" id="messages">

            </div>

            <footer class="bg-white border-t border-gray-200 p-4">
                <div class="flex space-x-4 items-center">
                    <input type="text" id="message" placeholder="Type a message..." class="flex-1 rounded-full border border-gray-300 px-4 py-2 focus:outline-none focus:border-blue-500" aria-label="Type a message">
                    <button class="bg-blue-500 text-white rounded-full p-3 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" onclick="sendMessage()">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </footer>
        </main>
    </div>
    <!-- --------------------------------------------script--------------------------------------------------------------------- -->
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js" integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+" crossorigin="anonymous"></script>
    <script>
        const socket = io("http://localhost:8000");

        async function socketConnection() {
            try {
                //---------------------fetch--stored--message--from--db------------------------------------------
                const result = await fetch('http://localhost:8000/getmessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify({ from:"<?= session()->get('user')->email ?>"}) //-----get--message where user is from value


            })

            const message=await result.json();
            console.log(message)
            const messagesDiv = document.getElementById('messages');
            message.messages.forEach((message,i)=>{
                let messageElement = document.createElement('div');
                messageElement.id=i;
                messageElement.className = 'flex items-end justify-end space-x-2 ';
                messageElement.innerHTML = `<div class="max-w-md bg-green-200 rounded-lg p-3 shadow-sm ">
                                            <p class="text-gray-800 text-pretty">${message.message}</p>
                                            <span class="text-xs text-gray-500">Just now</span>
                                        </div>`;
                messagesDiv.appendChild(messageElement);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            })
                



                socket.emit('join', {
                    data: "<?= session()->get('user')->email ?>"
                });
            } catch (err) {
                console.log(err);
            }
        }
        socketConnection();

        socket.on('receive_message', (message) => {

            const messagesDiv = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.className = 'flex items-end space-x-2';
            messageElement.innerHTML = `<div class="max-w-md bg-white rounded-lg p-3 shadow-sm">
                                            <p class="text-gray-800">${message}</p>
                                            <span class="text-xs text-gray-500">Just now</span>
                                        </div>`;
            messagesDiv.appendChild(messageElement);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            console.log(message)
        });

        async function sendMessage() {
            const message = document.getElementById('message').value;
            if (message !== "") {
                socket.emit('send_message', {
                    message: message
                });
                const messagesDiv = document.getElementById('messages');
                const messageElement = document.createElement('div');
                messageElement.className = 'flex items-end justify-end space-x-2 ';
                messageElement.innerHTML = `<div class="max-w-md bg-green-200 rounded-lg p-3 shadow-sm ">
                                            <p class="text-gray-800 text-pretty">${message}</p>
                                            <span class="text-xs text-gray-500">Just now</span>
                                        </div>`;
                messagesDiv.appendChild(messageElement);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
                console.log(message)
                document.getElementById('message').value = "";
            }
            // ------------------------sending--mongodb---------------------------------------
            const result = await fetch('http://localhost:8000/sendmessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify({ sender:"<?= session()->get('user')->email ?>",message})


            })
        }
    </script>
</body>

</html>


