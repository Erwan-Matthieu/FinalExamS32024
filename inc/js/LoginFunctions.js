const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const errrorParam = params.get('error');

if (errrorParam != null) {
    alert(errrorParam);
}