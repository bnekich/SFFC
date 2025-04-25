import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import Inputmask from "inputmask";
import "./select2";

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
    const phoneInputs = document.querySelectorAll(".phone-input");
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
    const emailInput = document.querySelector(".email-input");
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
const roleDropDown = document.getElementById("authorizationRoleDropDown");
let selectedRoles = [];
chBoxes.forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
        if (event.target.checked) {
            selectedRoles.push(event.target.dataset.role);
        } else {
            selectedRoles = selectedRoles.filter(
                (item) => item !== event.target.dataset.role
            );
        }
        roleDropDown.innerText =
            selectedRoles.length > 0 ? selectedRoles.join(", ") : "Select";
    });
});
