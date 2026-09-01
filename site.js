const navLiens = document.querySelectorAll(".nav-liens a");

navLiens.forEach(lien => {
    lien.addEventListener("click", e => {
        const cible = document.querySelector(lien.getAttribute("href"));

        if (cible) {
            e.preventDefault();
            cible.scrollIntoView({ behavior: "smooth" });
        }
    });
});