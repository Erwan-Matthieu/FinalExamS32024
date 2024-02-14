function getVarietiesList() {
    var xhhtp = new XMLHttpRequest();
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);

            console.log(result);

            var select = document.getElementById("varietiesSelect");

            result.forEach(function(element) {
                var option = document.createElement("option");
                option.value = element.variete;
                option.textContent = element.variete;
                select.appendChild(option);
            });
        }
    };
    xhhtp.open("GET","../../inc/php/VarietiesList.php",true);
    xhhtp.send();
}