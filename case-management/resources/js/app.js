// resources/js/app.js
import $ from "jquery";
window.jQuery = window.$ = $;
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import Select2 from "select2";
Select2($);
import "select2/dist/css/select2.min.css";

console.log("jQuery version:", $.fn.jquery); // Should log "3.7.1" or similar
console.log("Select2 available:", typeof $.fn.select2); // Should log "function"

var isSystemUser = document.getElementById("isSystemUser");
if (isSystemUser) {
    isSystemUser.addEventListener("change", function () {
        document.getElementById("authRolesSection").style.display = this.checked
            ? "block"
            : "none";
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

$(document).ready(function () {
    if ($(".family-select").length) {
        // Only run if element exists
        $(".family-select").select2({
            placeholder: "Search for families...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/search",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.family_name,
                            };
                        }),
                        pagination: {
                            more: data.current_page < data.last_page,
                        },
                    };
                },
            },
        });
    }
});
