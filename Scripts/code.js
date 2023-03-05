$(document).ready(function () {
    $("#example").DataTable({
        "language": {
            "lengthMenu": "Affichage de _MENU_ enregistre par page",
            "zeroRecords": "Rien trouvé - désolé",
            "info": "Affichage de la page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "infoFiltered": "(filtré à partir de _MAX_ enregistrements au total)"
        }
    });
})