var monDiv=document.getElementById("div");
var monDiv1=document.getElementById("div1");
console.log("Je suis innerHTML voila ce quej'affiche "+monDiv.innerHTML);
console.log("Je suis textContentt voila ce que j'affiche "+monDiv1.textContent);
monDiv1.textContent="I delete every thing in my road <b>i'm a monster 3:)</b> ";
monDiv.innerHTML="I delete every thing in my road <b>i'm a monster too 3:)</b> ";
console.log("Je suis innerHTML voila ce que j'affiche apres modification "+monDiv.innerHTML);
console.log("Je suis textContent voila ce que j'affiche apres modification "+monDiv1.textContent);


console.log(monDiv.childNodes) ;