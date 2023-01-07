function itemEditFinalize() {
    let finalize = document.getElementById("finalized").innerHTML;
    item_name = document.querySelector(".item-name");
    item_unit_of_mes = document.querySelector("#item_unit_of_mes");
    item_quantity = document.querySelector("#item_quantity");

    if (finalize == "true") {
        item_unit_of_mes.disabled = true;
        item_quantity.disabled = true;
    }
}


function propertyEditFinalize(){
    let finalize = document.getElementById("finalized").innerHTML;
    street_name = document.querySelector("#street-name");
    street_number = document.querySelector("#street-number");
    city = document.querySelector("#city");
    state = document.querySelector("#state");
    postcode = document.querySelector("#postcode");
    country = document.querySelector("#country");




    if (finalize === "true") {
        street_name.disabled = true;
        street_number.disabled = true;
        city.disabled = true;
        state.disabled = true;
        postcode.disabled = true;
        country.disabled = true;
        property_date.disabled = true;
    }
}

