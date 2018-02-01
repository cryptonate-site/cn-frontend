var chkTxnLoop = 0;

function check_transaction(txn_id) {
    $.ajax({
        type: "GET",
        url: "/api/transaction/is-complete/" + txn_id,
        dataType: "json",
        success: function(resp) {
            console.log(resp);
            if(resp.completed === true) {
                clearInterval(chkTxnLoop);
                $("#payment-modal").modal("hide");
                $("#success-modal").modal("show");
                var btn = $("#submit-btn");
                btn.prop("disabled", false);
                btn.text("Continue");
            }
        },
        error: function (resp) {
            console.warn(resp);
        }
    });
}

$("#submit-btn").on('click',function () {
    var meme = $("#donate-form").serializeArray();
    var dataOut = {};
    meme.forEach(function(val) {
        dataOut[val.name] = val.value;
    });
    dataOut.amount = Number(dataOut.amount);
    var btn = $("#submit-btn");
    btn.prop("disabled", true);
    btn.text("Submitting...");
    $.ajax({
        type: "POST",
        url: "/api/transaction/start-flow/" + forUser,
        data: JSON.stringify(dataOut),
        dataType: "json",
        success: function (resp) {
            console.log(resp);
            $("#btc-wallet-id").text(resp.send_to);
            $("#confirmation-date").text(new Date(Date.now() + (resp.timeout * 1000)).toTimeString());
            $("#payment-modal").modal("show");
            chkTxnLoop = setInterval(function () {check_transaction(resp.orderId);}, 4000);
        },
        error: function () {
            alert("An error occurred creating your transaction! Please try again later.");
            btn.prop("disabled", false);
            btn.text("Continue");
        },
        contentType: "application/json"
    });
    return false;
});