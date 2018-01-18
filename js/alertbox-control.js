var socket = io("http://gardenbox.duper51.me");
socket.on('connect', function () {console.log("connected")});
socket.on('event', function (data) {console.log(data)});
socket.on('disconnect', function () {console.log("disconnected")});
if(listenTo === undefined) {
    console.error("listenTo undefined");
}
socket.on(listenTo, function (data) {
   if(data.from !== undefined && data.amount !== undefined) {
       $("whodonated").text(data.from);
       $("howmuch").text(data.amount);
   }
});