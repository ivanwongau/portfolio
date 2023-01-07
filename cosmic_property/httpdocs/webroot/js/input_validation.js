//Measurement Tool Input Validation

let submit_btn = document.querySelector("#item_submit");

function maintenanceCostInput() {
    let ref = document.querySelector("#maintenance_cost");
    let error_ref = document.querySelector("#maintenance_cost_error");
    if (ref.value < 0) {
        error_ref.innerHTML = "Please enter a positive integer";
        return false;
    } else {
        error_ref.innerHTML = "";
        return true;
    }
}

function yearDueValidation() {
    let expectedLife_ref = document.querySelector("#expected_life");
    let year_due_ref = document.querySelector("#year_due");
    let error_ref = document.querySelector("#year-due-error");
    error_ref.style.color = "red";

    if (year_due_ref.value < 0 || year_due_ref.value > expectedLife_ref.value) {
        error_ref.innerHTML =
            "Year due must be less than or equal to Expected Life";
        return false;
    } else {
        error_ref.innerHTML = "";
        return true;
    }
}

function expectedLifeValidation() {
    let expectedLife_ref = document.querySelector("#expected_life");
    let error_ref = document.querySelector("#expected-life-error");
    error_ref.style.color = "red";

    if (expectedLife_ref.value < 0) {
        error_ref.innerHTML = "Please enter a positive number";
        return false;
    } else if (expectedLife_ref.value > 50) {
        error_ref.innerHTML = "Invalid Input";
        return false;
    } else {
        error_ref.innerHTML = "";
        return true;
    }
}

/* Item Maintenance Input Validation */

function costEstimate() {
    let costEstimate_ref = document.querySelector("#cost_estimate");
    let error_ref = document.querySelector("#cost-estimate-error");
    error_ref.style.color = "red";

    if (costEstimate_ref.value < 0) {
        error_ref.innerHTML = "Please enter a positive number";
        return false;
    } else {
        error_ref.innerHTML = "";
        return true;
    }
}

// submit_btn.addEventListener("click", function (e) {
//     let rate_ref = document.querySelector("#item_rate");
//     let quantity_ref = document.querySelector("#item_quantity");
//     let quantity_validation = true;
//     let rate_validation = true;
//     if (rate_ref.value < 0) {
//         rate_validation = false;
//     }
//     if (quantity_ref.value < 0) {
//         quantity_validation = false;
//     }
//     if (
//         !(
//             maintenanceCostInput() &&
//             yearDueValidation() &&
//             expectedLifeValidation() &&
//             costEstimate()
//         )
//     ) {
//         e.preventDefault();
//     }
// });
