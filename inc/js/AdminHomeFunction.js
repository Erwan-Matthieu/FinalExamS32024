generatePartOfHTML("../../pages/admin/variete.html");

function generatePartOfHTML(file) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("admin_home_center").innerHTML = '';
            document.getElementById("admin_home_center").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET",file,true);
    xhttp.send();
}

const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const errrorParam = params.get('error');

if (errrorParam != null) {
    alert(errrorParam);
}

const bodyParam = params.get('body');

if (bodyParam != null) {
    if (bodyParam == "variety") {
        generatePartOfHTML("../../pages/admin/variete.html");
    } else if (bodyParam == "area") {
        generatePartOfHTML("../../pages/admin/parcelle.html");
    } else if (bodyParam == "person") {
        generatePartOfHTML("../../pages/admin/ceuilleurs.html");
    } else if (bodyParam == "pay") {
        generatePartOfHTML("../../pages/admin/depense.html");
    }
}

const success = params.get('mes');

if (success != null) {
    alert(success);
}