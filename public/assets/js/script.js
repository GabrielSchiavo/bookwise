// CHANGE SVG COLOR
// Obtem os atributos do SVG para poder estilizar a imagem SVG via CSS
$("img#svg-change-color").each(function () {
    var $img = $(this);
    var imgID = $img.attr("id");
    var imgClass = $img.attr("class");
    var imgURL = $img.attr("src");

    $.get(imgURL, function (data) {
        // Pega a tag SVG, ignora o resto
        var $svg = $(data).find("svg");
        // Adiciona o ID da imagem substituída ao novo SVG
        if (typeof imgID !== "undefined") {
            $svg = $svg.attr("id", imgID);
        }
        // Adiciona as classes da imagem substituída ao novo SVG
        if (typeof imgClass !== "undefined") {
            $svg = $svg.attr("class", imgClass + " svgReplaced");
        }
        // Remova todas as tags XML inválidas de acordo com http://validator.w3.org
        $svg = $svg.removeAttr("xmlns:a");
        // Substitui a imagem pelo novo SVG
        $img.replaceWith($svg);
    });
});

//ADD CLASS ACTIVE IN SIDEBAR LINKS
const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
    const li = item.parentElement;

    item.addEventListener("click", function () {
        allSideMenu.forEach((i) => {
            i.parentElement.classList.remove("active");
        });
        li.classList.add("active");
    });
});

// TOGGLE SIDEBAR
let hideSidebarStorage = localStorage.getItem("hide-sidebar");
const btnMenu = document.getElementById("btn-menu");
const sidebar = document.getElementById("sidebar");

const hideSidebar = () => {
    sidebar.classList.add("hide");
    localStorage.setItem("hide-sidebar", "hide");
};
const exposeSidebar = () => {
    sidebar.classList.remove("hide");
    localStorage.setItem("hide-sidebar", null);
};

if (hideSidebarStorage === "hide") hideSidebar();

btnMenu.addEventListener("click", () => {
    hideSidebarStorage = localStorage.getItem("hide-sidebar");
    hideSidebarStorage !== "hide" ? hideSidebar() : exposeSidebar();
});

// SWITCH MODE
let darkModeStorage = localStorage.getItem("dark-mode");
const themeSwitch = document.getElementById("switch-mode");

const enableDarkMode = () => {
    document.body.classList.add("dark-mode");
    localStorage.setItem("dark-mode", "active");
};
const disableDarkMode = () => {
    document.body.classList.remove("dark-mode");
    localStorage.setItem("dark-mode", null);
};

if (darkModeStorage === "active") enableDarkMode();

themeSwitch.addEventListener("click", () => {
    darkModeStorage = localStorage.getItem("dark-mode");
    darkModeStorage !== "active" ? enableDarkMode() : disableDarkMode();
});

// MASK FOR PHONE NUMBER
$(document).ready(function ($) {
    $("#telefone").mask("(99) 99999-9999");
});

// MASK FOR ISBN NUMBER
$("#isbnFormat13").click(function () {
    $(document).ready(function ($) {
        $(".isbnMask").mask("999-9-99-999999-9");
    });
});

$("#isbnFormat10").click(function () {
    $(document).ready(function ($) {
        $(".isbnMask").mask("9-999999-99-9");
    });
});
