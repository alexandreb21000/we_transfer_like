//function retour(){
//clearTimeout(essai);
//    console.log('retour');

//    var xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function() {
//      if (this.readyState == 4 && this.status == 200) {
//        document.getElementById("ajax").innerHTML =
//        this.responseText;
//      }
//    };
//    xhttp.open("GET", "test.php", true);
//    xhttp.send();
//}

//// copy
//balapaCop("Step by Step Form", "#999");
// #endregion Formulaire

// #region help
function showHelp() {
    var divHelp = document.getElementById('help');
    divHelp.classList.add("helpdivshow");
    //divHelp.style.width = "30%"; alert("ok");
}

function closehlp() {
    var divHelp = document.getElementById('help');
    divHelp.classList.remove("helpdivshow");}

function zindex() {
    var divMlegales = document.getElementById('cgdiv');
    divMlegales.style.zIndex = divMlegales.style.zIndex + 1
    var divCU = document.getElementById('cudiv');
    divCU.style.zIndex = divCU.style.zIndex-1
}

function zindexMention() {
    var divMlegales = document.getElementById('cgdiv');
    divMlegales.style.zIndex = divMlegales.style.zIndex - 1
    var divCU = document.getElementById('cudiv');
    divCU.style.zIndex = divMlegales.style.zIndex+1
}
// #endregion