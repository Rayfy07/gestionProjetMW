function show() {
    const contact = document.getElementById("contact");
    const info = document.getElementById("info");

    if (contact.style.display === "none") {
        contact.style.display = "block";
        info.style.display = "none";
    }
    else {
        contact.style.display = "none";
        info.style.display = "block";
    }

}