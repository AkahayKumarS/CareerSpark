<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Main Chat Elements */
        .chat-toggle-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #1a76c7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
            transition: all 0.3s ease;
        }

        .chat-toggle-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(52, 152, 219, 0.5);
        }

        .chat-icon-wrapper {
            font-size: 24px;
            animation: pulse 2s infinite;
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #e74c3c;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 2px solid white;
        }

        .career-chat-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            height: 500px;
            background: white;
            border-radius: 15px;
            display: none;
            flex-direction: column;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            z-index: 999;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Chat Header */
        .chat-header {
            background: linear-gradient(135deg, #3498db, #1a76c7);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 15px 15px 0 0;
        }

        .chat-header-left {
            display: flex;
            align-items: center;
        }

        .chat-avatar {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 20px;
        }

        .chat-title {
            display: flex;
            flex-direction: column;
        }

        .chat-title h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .status-indicator {
            font-size: 12px;
            opacity: 0.8;
            display: flex;
            align-items: center;
        }

        .status-indicator:before {
            content: "";
            width: 8px;
            height: 8px;
            background-color: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .chat-header-actions {
            display: flex;
        }

        .action-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 5px;
            transition: background-color 0.2s;
        }

        .action-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Chat Messages */
        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f8fafc;
            position: relative;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            max-width: 80%;
        }

        .bot-message {
            align-self: flex-start;
        }

        .user-message {
            align-self: flex-end;
            margin-left: auto;
        }

        .message-content {
            padding: 12px 16px;
            border-radius: 18px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            word-break: break-word;
        }

        .bot-message .message-content {
            background-color: white;
            border-bottom-left-radius: 5px;
        }

        .user-message .message-content {
            background-color: #3498db;
            color: white;
            border-bottom-right-radius: 5px;
        }

        .message-time {
            font-size: 10px;
            opacity: 0.7;
            margin-top: 5px;
            align-self: flex-end;
        }

        .welcome-message .message-content {
            background-color: rgba(52, 152, 219, 0.1);
            border: 1px solid rgba(52, 152, 219, 0.2);
        }

        /* Typing indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            background-color: white;
            border-radius: 18px;
            width: fit-content;
            margin-bottom: 15px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .typing-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #b0b0b0;
            margin: 0 2px;
            animation: typingBounce 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: 0s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typingBounce {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-5px);
            }
        }

        /* Quick Replies */
        .quick-replies {
            padding: 10px 15px;
            display: flex;
            gap: 10px;
            overflow-x: auto;
            background-color: #f8fafc;
            border-top: 1px solid #eaeaea;
            scrollbar-width: none;
        }

        .quick-replies::-webkit-scrollbar {
            display: none;
        }

        .quick-reply-btn {
            white-space: nowrap;
            padding: 8px 12px;
            border-radius: 18px;
            background-color: white;
            border: 1px solid #e0e5eb;
            color: #3498db;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .quick-reply-btn i {
            margin-right: 5px;
        }

        .quick-reply-btn:hover {
            background-color: #f0f7ff;
            border-color: #3498db;
            transform: translateY(-2px);
        }

        /* Input Area */
        .chat-input-container {
            padding: 15px;
            display: flex;
            align-items: center;
            background-color: white;
            border-top: 1px solid #eaeaea;
        }

        .input-wrapper {
            flex: 1;
            background-color: #f0f2f5;
            border-radius: 20px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
        }

        #chat-input {
            flex: 1;
            border: none;
            padding: 8px 0;
            font-size: 14px;
            background-color: transparent;
            outline: none;
        }

        .emoji-btn {
            background: none;
            border: none;
            color: #888;
            cursor: pointer;
            padding: 5px;
            font-size: 16px;
            transition: color 0.2s;
        }

        .emoji-btn:hover {
            color: #3498db;
        }

        .send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            margin-left: 10px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(46, 204, 113, 0.3);
            transition: all 0.2s;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 10px rgba(46, 204, 113, 0.4);
        }

        /* Animations */
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .career-chat-window {
                width: calc(100% - 40px);
                height: 70vh;
                bottom: 80px;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Chat Icon Button -->
    <div id="chat-toggle" class="chat-toggle-btn">
        <div class="chat-icon-wrapper">
            <i class="fas fa-comments"></i>
        </div>
        <span class="notification-badge">1</span>
    </div>

    <!-- Chat Window -->
    <div id="chat-window" class="career-chat-window">
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="chat-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="chat-title">
                    <h3>CareerBot</h3>
                    <span class="status-indicator">Online</span>
                </div>
            </div>
            <div class="chat-header-actions">
                <button class="action-btn minimize-btn">
                    <i class="fas fa-minus"></i>
                </button>
                <button class="action-btn close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div id="chat-box" class="chat-messages">
            <div class="message bot-message welcome-message">
                <div class="message-content">
                    <p>
                        👋 Hi there! I'm CareerBot, your personal career advisor. How can
                        I help you today?
                    </p>
                    <span class="message-time">Just now</span>
                </div>
            </div>
        </div>

        <div class="quick-replies">
            <button class="quick-reply-btn" onclick="sendQuickReply('What careers match my skills?')">
                <i class="fas fa-briefcase"></i> Career matches
            </button>
            <button class="quick-reply-btn" onclick="sendQuickReply('Help me with my resume')">
                <i class="fas fa-file-alt"></i> Resume help
            </button>
            <button class="quick-reply-btn" onclick="sendQuickReply('Interview tips')">
                <i class="fas fa-comment-dots"></i> Interview tips
            </button>
        </div>

        <div class="chat-input-container">
            <div class="input-wrapper">
                <input type="text" id="chat-input" placeholder="Ask CareerBot..." />
                <button class="emoji-btn">
                    <i class="far fa-smile"></i>
                </button>
            </div>
            <button id="send-btn" onclick="sendMessage()" class="send-btn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Elements
            const chatToggle = document.getElementById("chat-toggle");
            const chatWindow = document.getElementById("chat-window");
            const chatBox = document.getElementById("chat-box");
            const chatInput = document.getElementById("chat-input");
            const sendBtn = document.getElementById("send-btn");
            const minimizeBtn = document.querySelector(".minimize-btn");
            const closeBtn = document.querySelector(".close-btn");
            const notificationBadge = document.querySelector(".notification-badge");

            // Toggle chatbot visibility
            chatToggle.addEventListener("click", () => {
                if (chatWindow.style.display === "flex") {
                    chatWindow.style.opacity = "0";
                    setTimeout(() => {
                        chatWindow.style.display = "none";
                    }, 300);
                } else {
                    chatWindow.style.display = "flex";
                    setTimeout(() => {
                        chatWindow.style.opacity = "1";
                        chatInput.focus();
                    }, 10);
                    notificationBadge.style.display = "none";
                }
            });

            // Initialize
            chatWindow.style.opacity = "0";
            chatWindow.style.transform = "translateY(20px)";

            // Add minimize functionality
            minimizeBtn.addEventListener("click", () => {
                chatWindow.style.opacity = "0";
                chatWindow.style.transform = "translateY(20px)";
                setTimeout(() => {
                    chatWindow.style.display = "none";
                    chatWindow.style.transform = "translateY(0)";
                }, 300);
            });

            // Add close functionality
            closeBtn.addEventListener("click", () => {
                chatWindow.style.opacity = "0";
                setTimeout(() => {
                    chatWindow.style.display = "none";
                }, 300);
            });

            // Send message with Enter key
            chatInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    sendMessage();
                }
            });

            // Format timestamp
            function formatTime() {
                const now = new Date();
                let hours = now.getHours();
                let minutes = now.getMinutes();
                const ampm = hours >= 12 ? "PM" : "AM";

                hours = hours % 12;
                hours = hours ? hours : 12;
                minutes = minutes < 10 ? "0" + minutes : minutes;

                return `${hours}:${minutes} ${ampm}`;
            }
        });

        // Send message to backend
        async function sendMessage() {
            const input = document.getElementById("chat-input");
            const message = input.value.trim();
            if (!message) return;

            const chatBox = document.getElementById("chat-box");
            const timestamp = formatTime();

            // Add user message with animation
            const userMessageElement = document.createElement("div");
            userMessageElement.className = "message user-message";
            userMessageElement.style.opacity = "0";
            userMessageElement.style.transform = "translateY(10px)";
            userMessageElement.innerHTML = `
          <div class="message-content">
            <p>${escapeHtml(message)}</p>
            <span class="message-time">${timestamp}</span>
          </div>
        `;
            chatBox.appendChild(userMessageElement);

            // Animate the message in
            setTimeout(() => {
                userMessageElement.style.transition = "all 0.3s ease";
                userMessageElement.style.opacity = "1";
                userMessageElement.style.transform = "translateY(0)";
            }, 10);

            input.value = "";
            chatBox.scrollTop = chatBox.scrollHeight;

            // Show typing indicator
            const typingIndicator = document.createElement("div");
            typingIndicator.className = "typing-indicator";
            typingIndicator.innerHTML = `
          <div class="typing-dot"></div>
          <div class="typing-dot"></div>
          <div class="typing-dot"></div>
        `;
            chatBox.appendChild(typingIndicator);
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const res = await fetch("http://127.0.0.1:5000/chat", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ message }),
                    credentials: "include" // 🔴 This line is IMPORTANT to send cookies
                });

                const data = await res.json();

                // Remove typing indicator after a slight delay
                setTimeout(() => {
                    if (typingIndicator.parentNode) {
                        typingIndicator.parentNode.removeChild(typingIndicator);
                    }

                    // Format reply: support **bold**, *italic*, URLs, and newlines
                    let reply = escapeHtml(
                        data.reply ||
                        "I didn't understand that. Could you please rephrase?"
                    );

                    reply = reply
                        .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>") // **bold**
                        .replace(/\*(.*?)\*/g, "<em>$1</em>") // *italic*
                        .replace(
                            /(https?:\/\/[^\s]+)/g,
                            '<a href="$1" target="_blank" class="chat-link">$1</a>'
                        ) // links
                        .replace(/\n/g, "<br>"); // new lines

                    // Add bot response with animation
                    const botMessageElement = document.createElement("div");
                    botMessageElement.className = "message bot-message";
                    botMessageElement.style.opacity = "0";
                    botMessageElement.style.transform = "translateY(10px)";
                    botMessageElement.innerHTML = `
              <div class="message-content">
                <p>${reply}</p>
                <span class="message-time">${formatTime()}</span>
              </div>
            `;
                    chatBox.appendChild(botMessageElement);

                    // Animate the message in
                    setTimeout(() => {
                        botMessageElement.style.transition = "all 0.3s ease";
                        botMessageElement.style.opacity = "1";
                        botMessageElement.style.transform = "translateY(0)";
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }, 10);
                }, 1500); // Simulate thinking time
            } catch (error) {
                // Remove typing indicator if there's an error
                if (typingIndicator.parentNode) {
                    typingIndicator.parentNode.removeChild(typingIndicator);
                }

                // Add error message
                const errorMessage = document.createElement("div");
                errorMessage.className = "message bot-message";
                errorMessage.innerHTML = `
            <div class="message-content" style="background-color: #fff1f0; color: #e74c3c;">
              <p><i class="fas fa-exclamation-circle me-2"></i>Sorry, I'm having trouble right now. Please try again.</p>
              <span class="message-time">${formatTime()}</span>
            </div>
          `;
                chatBox.appendChild(errorMessage);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }

        // Send a quick reply message
        function sendQuickReply(message) {
            document.getElementById("chat-input").value = message;
            sendMessage();
        }

        // Format time helper function
        function formatTime() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            const ampm = hours >= 12 ? "PM" : "AM";

            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? "0" + minutes : minutes;

            return `${hours}:${minutes} ${ampm}`;
        }

        // Basic HTML escape function to avoid issues
        function escapeHtml(text) {
            const map = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#039;",
            };
            return text.replace(/[&<>"']/g, (m) => map[m]);
        }
    </script>
</body>

</html>