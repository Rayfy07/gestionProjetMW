const contactBtn = document.getElementById("contactBtn");
const infoBtn = document.getElementById("infoBtn");
const contact = document.getElementById("contact");
const info = document.getElementById("info");

contactBtn.addEventListener("click", function(){
    info.style.display = "none";
    contact.style.display = "block";
})

infoBtn.addEventListener("click", function(){
    contact.style.display = "none";
    info.style.display = "block";
})
