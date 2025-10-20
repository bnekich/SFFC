import "bootstrap";
import Inputmask from "inputmask";
import "./select2";
//import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
import Choices from "choices.js";
import { initializeChoicesSelects } from "./choices";

//window.Alpine = Alpine;
Alpine.plugin(focus);
//Alpine.start();

// Interface for modal form response
interface FormResponse {
    id: number;
    name: string;
}

// Interface for validation errors
interface ValidationErrors {
    [key: string]: string[];
}

var isSystemUser = document.getElementById("isSystemUser") as HTMLInputElement;
if (isSystemUser) {
    isSystemUser.addEventListener("change", function () {
        const authRolesSection = document.getElementById(
            "authRolesSection"
        ) as HTMLDivElement;
        authRolesSection.style.display = this.checked ? "block" : "none";
    });
}

document.addEventListener("DOMContentLoaded", () => {
    // Select the input element(s) you want to mask
    const phoneInputs = document.querySelectorAll(
        ".phone-input:not([type='file'])"
    );
    if (phoneInputs) {
        phoneInputs.forEach((input) => {
            Inputmask({
                mask: "(999) 999-9999",
                placeholder: "_",
            }).mask(phoneInputs);
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const emailInput = document.querySelector(".email-input:not([type='file']");
    if (emailInput) {
        Inputmask({
            alias: "email",
            placeholder: "_", // Optional: Placeholder for empty spots
            showMaskOnHover: false, // Optional: Customize behavior
        }).mask(emailInput);
    }
});

var clearButton = document.getElementById("clearButton");
if (clearButton) {
    clearButton.addEventListener("click", function () {
        const searchBox = document.getElementById(
            "searchBox"
        ) as HTMLInputElement;
        if (searchBox) {
            searchBox.value = "";
            (
                document.getElementById("searchForm") as HTMLFormElement
            )?.submit();
        }
    });
}

const chBoxes = document.querySelectorAll(
    '.dropdown-menu input[type="checkbox"]'
);

document.addEventListener("DOMContentLoaded", () => {
    initializeChoicesSelects();
});

// const roleDropDown = document.getElementById("authorizationRoleDropDown");
// let selectedRoles = [];
// chBoxes.forEach((checkbox) => {
//     checkbox.addEventListener("change", (event) => {
//         if (event.target.checked) {
//             selectedRoles.push(event.target.dataset.role);
//         } else {
//             selectedRoles = selectedRoles.filter(
//                 (item) => item !== event.target.dataset.role
//             );
//         }
//         roleDropDown.innerText =
//             selectedRoles.length > 0 ? selectedRoles.join(", ") : "Select";
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    const element = document.getElementById("personAuthRoles");
    if (element && element.tagName === "SELECT") {
        const choices = new Choices(element, {
            removeItemButton: true,
            allowHTML: false,
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const element = document.getElementById("userRoles");
    if (element && element.tagName === "SELECT") {
        const choices = new Choices(element, {
            removeItemButton: true,
            allowHTML: false,
        });
    }
});

// document.addEventListener("DOMContentLoaded", function () {
//     const element = document.getElementById("family-select");
//     if (element && element.tagName === "SELECT") {
//         const choices = new Choices(element, {
//             removeItemButton: true,
//             allowHTML: false,
//         });
//     }
// });

// debugging code

// document.addEventListener("livewire:initialized", () => {
//     console.log("Livewire initialized");
// });

// document.addEventListener("DOMContentLoaded", () => {
//     const fileInput = document.querySelector('input[type="file"]');
//     if (fileInput) {
//         console.log("File input attributes:", fileInput.getAttributeNames());
//         fileInput.addEventListener("change", () => {
//             console.log(
//                 "File input changed, readonly:",
//                 fileInput.hasAttribute("readonly")
//             );
//         });
//     }
//     const submitButton = document.querySelector('button[type="submit"]');
//     if (submitButton) {
//         console.log(
//             "Submit button attributes:",
//             submitButton.getAttributeNames()
//         );
//     }
// });
