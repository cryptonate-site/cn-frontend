var socket = io("https://gardenbox.duper51.me", {path: "/api/socket.io"});
socket.on('connect', function (socket) {
    console.log("connected");
    socket.join(listenTo);
    console.log("connected to room");
});
socket.on('event', function (data) {console.log(data)});
socket.on('disconnect', function () {console.log("disconnected")});
if(listenTo === undefined) {
    console.error("listenTo undefined");
}
socket.on("payment", function (data) {
   if(data.from !== undefined && data.amount !== undefined) {
       $("whodonated").text(data.from);
       $("howmuch").text(data.amount);
   }
});
