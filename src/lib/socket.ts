
let socket:WebSocket;
let reconnectInterval: number | null = null;




export function connectWebSocket() {
  socket = new WebSocket('wss://meteorgarden.glitch.me');

  socket.addEventListener('open', (event) => {
    console.log('WebSocket connection established.');
    // Reset the reconnect interval when the connection is open
    if (reconnectInterval !== null) {
      clearInterval(reconnectInterval);
      reconnectInterval = null;
    }
  });

  socket.addEventListener('close', (event) => {
    console.error('WebSocket connection closed.');

    // Reconnect to WebSocket after a delay (e.g., 3 seconds)
    if (reconnectInterval === null) {
      reconnectInterval = setInterval(() => {
        console.log('Reconnecting to WebSocket...');
        connectWebSocket();
      }, 3000); // Adjust the delay as needed
    }
  });
}








export function sendMessage(message: string | ArrayBufferLike | Blob | ArrayBufferView) {
  if (socket.readyState === WebSocket.OPEN) {
    socket.send(message);
  }
}
