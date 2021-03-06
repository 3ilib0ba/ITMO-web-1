let X, R, Y;

function validateX() {
    if (document.querySelector('input[name="coordinateX"]:checked') !== null) {
        X = document.querySelector('input[name="coordinateX"]:checked').value;
    } else {
        showErrorToLog("Input X<br>");
        return false;

    }
    return true;
}

function validateY() {
    Y = document.querySelector("input[id=coordinateY]").value.replace(",", ".");
    if (Y === undefined) {
        showErrorToLog("Введите Y<br>");
        return false;
    }
    if (!(!isNaN(parseFloat(Y)) && isFinite(Y))) {
        showErrorToLog("Y не является числом<br>");
        return false;
    }
    if (!((Y > -5) && (Y < 3))) {
        showErrorToLog("Y должен быть от -5 до 3<br>");
        return false;
    }
    return true;
}

function validateR() {
    R = document.getElementById("coordinateR")[document.getElementById("coordinateR").selectedIndex].value;
    showErrorToLog("R = " + R);
    return true;
}

function showErrorToLog(message) {
    document.getElementById("logs-request").append(message)
}

function submit() {
    $('#logs-request').empty();

    if (validateX() & validateY() & validateR()) {
        let request = new XMLHttpRequest();
        let formData = new FormData()
        formData.append("x", X);
        formData.append("y", Y);
        formData.append("r", R);
        formData.append('timezone', new Date().getTimezoneOffset());
        request.open('post', "answer.php", true)
        request.overrideMimeType("application/json");
        request.onload = function () {
            console.log(request.responseText);
            let arr = JSON.parse(request.responseText);
            arr.forEach(function (elem) {
                if (!elem.validate) {
                    return;
                }
                let newRow = elem.isHit ? '<tr class="green" height="60px">' : '<tr class="red" height="60px">';
                newRow += '<td>' + elem.x + '</td>';
                newRow += '<td>' + elem.y + '</td>';
                newRow += '<td>' + elem.r + '</td>';
                newRow += '<td>' + elem.currentTime + '</td>';
                newRow += '<td>' + elem.execTime + '</td>';
                newRow += '<td>' + (elem.isHit ? 'Попадание' : 'Промах') + '</td>';
                $('#tableWithResults tr:first').after(newRow);
            })
        };
        request.send(formData);
        // $.post("answer.php", {
        //     'x': X,
        //     'y': Y,
        //     'r': R,
        //     'timezone': new Date().getTimezoneOffset()
        // }).done(function (data) {
        //     let arr = JSON.parse(data);
        //     arr.forEach(function (elem) {
        //         if (!elem.validate) {
        //             return;
        //         }
        //         let newRow = elem.isHit ? '<tr class="green" height="60px">' : '<tr class="red" height="60px">';
        //         newRow += '<td>' + elem.x + '</td>';
        //         newRow += '<td>' + elem.y + '</td>';
        //         newRow += '<td>' + elem.r + '</td>';
        //         newRow += '<td>' + elem.currentTime + '</td>';
        //         newRow += '<td>' + elem.execTime + '</td>';
        //         newRow += '<td>' + (elem.isHit ? 'Попадание' : 'Промах') + '</td>';
        //         $('#tableWithResults tr:first').after(newRow);
        //     });
        // }).fail(function (err) {
        //     alert(err);
        // });
    }
}