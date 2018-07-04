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
