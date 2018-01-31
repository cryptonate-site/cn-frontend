var paymentInProgress = false;
var paymentQueue = [];
var paymentFunction = function (data) {
    if(!paymentInProgress) {
        if (data.from !== undefined && data.amount !== undefined) {
            paymentInProgress = true;
            $("#name").text(data.from);
            $("#hasDonated").text(" has donated: " + data.amount + " " + data.currency);
            $("#message").text(data.message);
            $("#the-image").attr('src', data.image);
            $("#donation-field").fadeIn(1500, function () {
                window.setTimeout(function () {
                    $("#donation-field").fadeOut(1500, function () {
                        paymentInProgress = false;
                        if(paymentQueue.length > 0)
                            paymentFunction(paymentQueue.pop());
                    });
                }, 4000);
            })
        }
    } else {
        paymentQueue.push(data);
    }
};
var socket = io("https://gardenbox.duper51.me", {
    path: "/api/socket.io",
    query: {
        roomName: listenTo
    }
});
socket.on('connect', function () {
    console.log("connected");
});
socket.on('disconnect', function () {console.log("disconnected")});
if(listenTo === undefined) {
    console.error("listenTo undefined");
}
socket.on("svrerror", function (data) {
    console.error(data);
});
socket.on("payment", paymentFunction);
