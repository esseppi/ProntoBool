// import './bootstrap';
require("./bootstrap");

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const newProfession = document.getElementById("newProfession");
if (newProfession) {
    const $finalInput = document.getElementById("finalProfession");
    newProfession.addEventListener("change", myFunction);
    function myFunction() {
        $finalInput.disabled = false;
        let $selected = newProfession.value;
        $finalInput.value = $selected;
        // finalProfession = newProfession.value;
    }
}
