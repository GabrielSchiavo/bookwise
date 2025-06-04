// IMPORT JS LIBRARIES
import jQuery from "jquery";
window.$ = jQuery;
import "jquery-mask-plugin";

// IMPORT STATIC ASSETS INTO VITE
import.meta.glob(["../images/**"]);

// CHANGE SVG COLOR
// Obtem os atributos do SVG para poder estilizar a imagem SVG via CSS
$("img#svg-change-color").each(function () {
    var $img = $(this);
    var imgId = $img.attr("id");
    var imgClass = $img.attr("class");
    var imgUrl = $img.attr("src");

    $.get(imgUrl, function (data) {
        // Pega a tag SVG, ignora o resto
        var $svg = $(data).find("svg");
        // Adiciona o ID da imagem substituída ao novo SVG
        if (typeof imgId !== "undefined") {
            $svg = $svg.attr("id", imgId);
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
    $("#phone").mask("(99) 99999-9999");
});

// MASK FOR ISBN NUMBER
$("#isbn_format_13").click(function () {
    $(document).ready(function ($) {
        $(".isbnMask").mask("999-9-99-999999-9");
    });
});

$("#isbn_format_10").click(function () {
    $(document).ready(function ($) {
        $(".isbnMask").mask("9-999999-99-9");
    });
});

// MODAL CONFIRM DELETE
document.addEventListener("DOMContentLoaded", function () {
    const deleteForms = document.querySelectorAll('form[action*="excluir"]');
    const modalConfirmDelete = document.getElementById("modalConfirmDelete");
    const btnConfirm = document.getElementById("btnConfirm");
    const btnCancel = document.getElementById("btnCancel");

    deleteForms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Impede o envio imediato

            // Mostra o modal
            modalConfirmDelete.style.display = "flex";

            // Se clicar em "Sim", envia o formulário
            btnConfirm.onclick = function () {
                form.submit();
            };

            // Se clicar em "Cancelar", fecha o modal
            btnCancel.onclick = function () {
                modalConfirmDelete.style.display = "none";
            };
        });
    });
});

// COPY TEXT TO CLIPBOARD
document.getElementById("btnCopy").addEventListener("click", function () {
    // Obter o texto do elemento
    const synopsisText = document.getElementById("synopsisText").innerText;

    // Usar a API moderna do Clipboard
    navigator.clipboard
        .writeText(synopsisText)
        .then(() => {
            // Feedback visual - você pode personalizar isso
            const btnCopy = document.getElementById("btnCopy");
            const textBtnCopy = document.getElementById("textBtnCopy");
            const originalTextBtnCopy = textBtnCopy.innerHTML;

            // Mudar temporariamente o texto do botão
            textBtnCopy.innerHTML = `Copiado!`;

            // Voltar ao estado original após 2 segundos
            setTimeout(() => {
                textBtnCopy.innerHTML = originalTextBtnCopy;
            }, 2000);
        })
        .catch((err) => {
            console.error("Erro ao copiar texto: ", err);
        });
});

// REGENERATE SYNOPSIS
document.addEventListener('DOMContentLoaded', function() {
    const regenerateBtn = document.getElementById('regenerateBtn');
    if (!regenerateBtn) return;

    const textBtnRegenerate = document.getElementById('textBtnRegenerate');
    const bookInfo = document.getElementById('bookInfo');
    
    if (!textBtnRegenerate || !bookInfo) return;
    
    const bookId = bookInfo.dataset.bookId;
    const originalTextBtnRegenerate = textBtnRegenerate.innerHTML;

    const synopsisText = document.getElementById('synopsisText');

    regenerateBtn.addEventListener('click', function() {
        // Disable button and show loading
        regenerateBtn.disabled = true;
        textBtnRegenerate.innerHTML = "Gerando...";
        synopsisText.innerText = "Gerando sinopse... Por favor aguarde...";

        // Make AJAX request
        fetch(`/acervo/${bookId}/ia/sinopse`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Update synopsis
            if (synopsisText && data.synopsis) {
                synopsisText.innerText = data.synopsis;
            }

            // Show success and reset button
            textBtnRegenerate.innerHTML = "Sucesso!";
            setTimeout(() => {
                textBtnRegenerate.innerHTML = originalTextBtnRegenerate;
                regenerateBtn.disabled = false;
            }, 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            synopsisText.innerText = "Erro ao gerar sinopse! Tente novamente mais tarde.";
            textBtnRegenerate.innerHTML = "Erro ao gerar!";
            setTimeout(() => {
                textBtnRegenerate.innerHTML = originalTextBtnRegenerate;
                regenerateBtn.disabled = false;
            }, 2000);
        });
    });
});
