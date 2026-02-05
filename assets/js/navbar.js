document.getElementById("menu-toggle").addEventListener("click", function () {
    const menu = document.getElementById("mobile-menu");
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
        menu.classList.add("flex");
    } else {
        menu.classList.add("hidden");
    }
});

document.getElementById("profile-toggle").addEventListener("click", function () {
    const profileMenu = document.getElementById("profile-menu");
    if (profileMenu.classList.contains("hidden")) {
        profileMenu.classList.remove("hidden");
        profileMenu.classList.add("flex");
    } else {
        profileMenu.classList.add("hidden");
    }
});