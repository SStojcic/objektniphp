function anketaAjax()
{
    
var xhttp;
if (window.XMLHttpRequest)
{
xhttp = new XMLHttpRequest();
}
else
{
xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xhttp.open("GET","home/anketaAjax", true);
xhttp.send();
xhttp.onreadystatechange = function()
{
if(xhttp.readyState==1)
{
console.log(1);
}
if(xhttp.readyState==2)
{
console.log(2);
}
if(xhttp.readyState==3)
{
console.log(3);
}
if (xhttp.readyState == 4 && xhttp.status == 200)
{
document.getElementById("anketa").innerHTML=xhttp.responseText;
}
}
}