document.getElementById("isSystemUser").addEventListener("change", function () {
    document.getElementById("authRolesSection").style.display = this.checked
        ? "block"
        : "none";
});
const chBoxes = document.querySelectorAll(
    '.dropdown-menu input[type="checkbox"]'
);
const pBtn = document.getElementById("processRoleDropDown");
const aBtn = document.getElementById("authorizationRoleDropDown");
let pRoles = [];
let aRoles = [];
chBoxes.forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
        if (event.target.dataset.roletype == "process") {
            if (event.target.checked) {
                pRoles.push(event.target.dataset.role);
            } else {
                pRoles = pRoles.filter(
                    (item) => item !== event.target.dataset.role
                );
            }
            pBtn.innerText = pRoles.length > 0 ? pRoles.join(", ") : "Select";
        }
        if (event.target.dataset.roletype == "authorization") {
            if (event.target.checked) {
                aRoles.push(event.target.dataset.role);
            } else {
                aRoles = pRoles.filter(
                    (item) => item !== event.target.dataset.role
                );
            }
            aBtn.innerText = aRoles.length > 0 ? aRoles.join(", ") : "Select";
        }
    });
});
