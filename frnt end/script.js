//selecting popup box popup overlay button
var popupoverlay = document.querySelector(".popup-overlay")
var popupbox = document.querySelector(".popup-box")
var addpopupbutton = document.getElementById("add-pop-button")

addpopupbutton.addEventListener("click",function(){
    popupoverlay.style.display="block"
    popupbox.style.display="block"
})    
//select cancel button
var cancelbutton = document.getElementById("cancel")
cancelbutton.addEventListener("click",function(event){
    event.preventDefault()
    popupoverlay.style.display="none"
    popupbox.style.display="none"
})


//select container,add-book,book-title-input,book-author-input,book-description-input
var container = document.querySelector(".container")
var addbutton = document.getElementById("add-book")
var booktittle = document.getElementById("book-title-input")
var bookauthorinput = document.getElementById("book-author-input")
var bookdescription = document.getElementById("book-description-input")

addbutton.addEventListener("click",function(event){
    event.preventDefault()
    var div = document.createElement("div")
    div.setAttribute("class","book-container")
    div.innerHTML=`<h2 style="color:#fd6569">${bookauthorinput.value}</h2>
    <h5>${booktittle.value}</h5>
    <p>${bookdescription.value}</p>
    <button class="pt-5px pb-10px mt-10px" onclick="deletebook(event)">Delete</button>`
    container.append(div)
    popupoverlay.style.display="none"
    popupbox.style.display="none"
})
function deletebook(event){
    event.target.parentElement.remove()
}

function myFunction() {
    var element = document.body;
    element.classList.toggle("dark-mode");
 }