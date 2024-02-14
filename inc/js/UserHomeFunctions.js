generatePartOfHTML("../../pages/others/ceuilleur.html");

function generatePartOfHTML(file) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("User_Body_Content").innerHTML = '';
            document.getElementById("User_Body_Content").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET",file,true);
    xhttp.send();
}