const contactButton = document.querySelector(".player-btn");
const contactOverlay = document.getElementById("contactOverlay");
const contactClose = document.getElementById("contactClose");
const phoneCopy = document.getElementById("phoneCopy");

contactButton.addEventListener("click", () => {
    contactOverlay.classList.add("active");
});

contactClose.addEventListener("click", () => {
    contactOverlay.classList.remove("active");
});

contactOverlay.addEventListener("click", (e) => {
    if (e.target === contactOverlay) {
        contactOverlay.classList.remove("active");
    }
});

phoneCopy.addEventListener("click", () => {
    navigator.clipboard.writeText("+213 797 917 500");
});
const joinButton = document.querySelector(".join-btn");
const joinOverlay = document.getElementById("joinOverlay");
const joinClose = document.getElementById("joinClose");
const joinForm = document.getElementById("joinForm");
const certificat = document.getElementById("certificat");

joinButton.addEventListener("click", () => {
    joinOverlay.classList.add("active");
});

joinClose.addEventListener("click", () => {
    joinOverlay.classList.remove("active");
});

joinOverlay.addEventListener("click", (e) => {
    if (e.target === joinOverlay) {
        joinOverlay.classList.remove("active");
    }
});

certificat.addEventListener("change", () => {
    const fileUpload = document.querySelector(".file-upload span");

    if (certificat.files.length > 0) {
        fileUpload.textContent = certificat.files[0].name;
    }
});

joinForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Votre demande d'inscription a bien été envoyée !");
});