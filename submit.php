// Initialize Firebase
const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_AUTH_DOMAIN",
  databaseURL: "YOUR_DATABASE_URL",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_STORAGE_BUCKET",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "YOUR_APP_ID"
};
firebase.initializeApp(firebaseConfig);
const database = firebase.database();
const messagesRef = database.ref('messages');
const messages = document.getElementById('messages');
const messageForm = document.getElementById('message-form');
const messageInput = document.getElementById ('message-input');
messageForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const message = messageInput.value;
  messagesRef.push({
    text: message,
    timestamp: firebase.database.ServerValue.TIMESTAMP
  });
  messageInput.value = '';
});
messagesRef.on('child_added', (snapshot) => {
  const data = snapshot.val();
  const messageElement = document.createElement('div');
  messageElement.classList.add('message');
  messageElement.textContent = data.text;
  messages.appendChild(messageElement);
});