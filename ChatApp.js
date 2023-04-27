$(function() {
    $("#sendMessage").on("keyup", sendText);
    $("#pass").on("keyup", checkLogin);
    $("#receiveUser").on("keyup", startInterval);
});

function sendText() {
    let user = $("#user").val();
    let pass = $("#pass").val();
    let text = $("#sendMessage").val();
    let messageData = {name: user, pass: pass, text: text};

    if (checkLogin()) {
        return;
    }

    $.ajax({
        url: "MessageToDatabase.php",
        method: "POST", 
        data: messageData,
        dataType: "text"
    })
    .done(function(data, textStatus, jqXHR) {
        console.log(data);
        if (data == "INVALID_LOGIN")
            $("#sendAlert").text("Invalid Username/Password");
        else if (data == "QUERY_ERROR")
            $("#sendAlert").text("SQL Query Error");
        else if (data == "UPDATE_ERROR")
            $("#sendAlert").text("SQL Update Error");
        else if (data == "SUCCESS")
            $("#sendAlert").text("Success!");
        else 
            $("#sendAlert").text("This Chat App is Broken.");
        // console.log(data);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}

function checkLogin() {
    if ($("#user").val().length == 0) {
        $("#nameWarn").text("Enter Username.");
        return true;
    } else if ($("#pass").val().length == 0) {
        $("#passWarn").text("Enter Password.");
        $("#nameWarn").text("");
        return true;
    }
    $("#passWarn").text("");
    $("#nameWarn").text("");
    return false;
}

function checkListen() {
    if ($("#receiveUser").val.length == 0) {
        $("#rNameWarn").text("Enter a Name to Listen to.");
        return true;
    }
    return false;
}

let timer;
function startInterval() {
    clearInterval(timer);
    timer = setInterval(getText, 100);
}

function getText() {
    if (checkLogin()) {
        return;
    }
    let user = $("#receiveUser").val();
    let messageData = {name: user};

    $.ajax({
        url: "DatabaseToChat.php",
        method: "GET", 
        data: messageData,
        dataType: "text"
    })
    .done(function(data, textStatus, jqXHR) {
        if (data == "INVALID_NAME")
            $("#receiveAlert").text("Invalid Name");
        else if (data == "QUERY_ERROR")
            $("#receiveAlert").text("SQL Query Error");
        else if (data == "GET_ERROR")
            $("#receiveAlert").text("SQL Get Error");
        else 
            $("#receiveMessage").val(data);
            $("#receiveAlert").text("");
        // console.log(data);  
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
    });
}