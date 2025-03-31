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
