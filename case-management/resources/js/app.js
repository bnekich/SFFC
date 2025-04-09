// resources/js/app.js
import $ from "jquery";
window.jQuery = window.$ = $;
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import Select2 from "select2";
Select2($);
import "select2/dist/css/select2.min.css";
import Inputmask from "inputmask";

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
    if ($(".org-select").length) {
        // Only run if element exists
        $(".org-select").select2({
            placeholder: "Search for organizations...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/orgSearch",
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
                                text: item.name,
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

$(document).ready(function () {
    if ($(".family-select").length) {
        // Only run if element exists
        $(".family-select").select2({
            placeholder: "Search for families...",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: "/familySearch",
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
$(document).ready(function () {
    // When a button opens a modal, store the target select ID
    $('[data-bs-toggle="modal"]').on("click", function () {
        var selectId = $(this).data("select");
        var modalId = $(this).data("target");
        $(modalId).data("select", selectId);
    });

    // Handle form submission in any modal
    $(".modal form").on("submit", function (e) {
        e.preventDefault(); // Prevent traditional form submission
        var form = $(this);
        var modal = form.closest(".modal");
        var selectId = modal.data("select");

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success: function (data) {
                // Add new option to the dropdown and select it
                var select = $(selectId);
                select.append(new Option(data.name, data.id, true, true));
                // Hide modal, reset form, clear errors
                modal.modal("hide");
                form[0].reset();
                $("#error-messages").hide().empty();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = "";
                    for (var field in errors) {
                        errorHtml += "<p>" + errors[field][0] + "</p>";
                    }
                    $("#error-messages").html(errorHtml).show();
                }
            },
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    // Select the input element(s) you want to mask
    const phoneInput = document.querySelector(".phone-input");

    // Apply the phone number mask
    if (phoneInput) {
        Inputmask({
            mask: "(999) 999-9999", // Example: US phone number format
            placeholder: "_", // Optional: Placeholder for empty spots
            showMaskOnHover: false, // Optional: Customize behavior
        }).mask(phoneInput);
    }
});

var clearButton = document.getElementById("clearButton");
if (clearButton) {
    clearButton.addEventListener("click", function () {
        document.getElementById("searchBox").value = "";
        document.getElementById("searchForm").submit();
    });
}
