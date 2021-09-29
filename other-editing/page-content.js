

function deleteSession() {
    alert("deleting");
    $.post("deleteSession.php")
        .done(function (message) {
            showErrorToLog("deleted");
        })
        .fail(function (err) {
        alert(err);
    });
}