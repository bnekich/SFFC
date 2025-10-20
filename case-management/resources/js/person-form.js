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

// $(document).ready(function () {
//     $(".family-select").select2({
//         placeholder: "Search for families...",
//         allowClear: true,
//         minimumInputLength: 1,
//         ajax: {
//             url: "/search",
//             dataType: "json",
//             delay: 250,
//             data: function (params) {
//                 return {
//                     q: params.term,
//                     page: params.page || 1,
//                 };
//             },
//             processResults: function (data) {
//                 return {
//                     results: data.items.map(function (item) {
//                         return {
//                             id: item.id,
//                             text: item.family_name,
//                         };
//                     }),
//                     pagination: {
//                         more: data.current_page < data.last_page,
//                     },
//                 };
//             },
//         },
//     });
// });
