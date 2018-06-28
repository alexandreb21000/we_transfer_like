document.getElementById('submit').addEventListener('click',function(){
    console.log('passe');
var essai = setTimeout(retour,1000);
})



function retour(){
clearTimeout(essai);
    console.log('retour');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("ajax").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", "test.php", true);
    xhttp.send();
}