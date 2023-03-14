function changerpage() {
    var page = document.getElementById("pilote").value;
    window.location.href = "inscription_pilote.html";
    var page = document.getElementById("etudiant").value;
    window.location.href = "inscription_etudiant.html";
    document.getElementById("pilote").checked = false;
    document.getElementById("etudiant").checked = false;
}