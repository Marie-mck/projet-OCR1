
document.addEventListener('DOMContentLoaded', function () {
    
    document.querySelectorAll('.tableInscription').forEach(function (table) {
        let labels = [];
        table.querySelectorAll('th').forEach(function (th) {
            labels.push(th.innerText);
        });
        table.querySelectorAll('td').forEach(function (td, i) {
            td.setAttribute('data-label', labels[i % labels.length]);
        });
    });
});