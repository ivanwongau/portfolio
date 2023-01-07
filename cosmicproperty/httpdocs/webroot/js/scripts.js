// Tooltip///
let tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

var coll = document.getElementsByClassName("collapsibleAddItem");
var i;

var measurementToolField = new Array();
var measurementToolFieldlm = new Array();

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

function calculateItemTotalCost() {
    var inputItemQuantity = document.getElementById("item_quantity");
    var inputItemRate = document.getElementById("item_rate");
    let total = inputItemQuantity.value * inputItemRate.value;
    document.getElementById("item_total").value = total;
}

/////////////// Auto Address completion//////////////////////////
let placeSearch, autocomplete;
let componentForm = {
    street_number: "short_name",
    route: "long_name",
    locality: "long_name",
    administrative_area_level_1: "short_name",
    country: "long_name",
    postal_code: "short_name",
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */
        (document.getElementById("autocomplete")),
        { types: ["geocode"] }
    );

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    let place = autocomplete.getPlace();

    for (let component in componentForm) {
        console.log(component);
        document.getElementById(component).value = "";
        // document.getElementById(component).disabled = false;
    }
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (let i = 0; i < place.address_components.length; i++) {
        let addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            let val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            let geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            let circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
///////////////////////////////////////////////////////////////////

// /////////////////////////////////////////////////////////////////////////

// ////////////////////////measurement tool///////////////////////////////////

function measurementTool(value) {
    if (value == "m2") {
        document.querySelector('#item_quantity').readOnly = true;
        // show formula for area meter square
        $("#area-calculator").css("display", "grid");
        $("#lm-calculator").css("display", "none");
    } else if (value == "L/M or No") {
        document.querySelector('#item_quantity').readOnly = true;
        $("#lm-calculator").css("display", "block");
        $("#area-calculator").css("display", "none");
    } else if (value == "Ea") {
        document.querySelector('#item_quantity').readOnly = false;
        $("#area-calculator").css("display", "none");
        $("#lm-calculator").css("display", "none");
    }
}

function calculateItemArea() {
    var inputItemHeight = document.getElementById("height");
    var inputItemWidth = document.getElementById("width");
    let total = inputItemHeight.value * inputItemWidth.value;

    for (let f = 0; f < measurementToolField.length; f++) {
        let heightId = measurementToolField[f];
        heightId = heightId[0];
        let widthId = measurementToolField[f];
        widthId = widthId[1];

        let nextInputItemHeight = document.getElementById(heightId);
        let nextInputItemWidth = document.getElementById(widthId);
        let option = document.getElementById(measurementToolField[f][2]);
        if (option.value == "Add") {
            total += nextInputItemHeight.value * nextInputItemWidth.value;
        } else if (option.value == "Subtract") {
            total -= nextInputItemHeight.value * nextInputItemWidth.value;
        }
    }
    document.getElementById("result").value = total;
    document.getElementById("item_quantity").value = total;
    let itemRate = document.getElementById("item_rate").value;
    let itemQuantity = document.getElementById("item_quantity").value;
    document.getElementById("item_total").value = itemQuantity * itemRate;
}

function addMeasureField() {
    let result = "";

    let outputRef = document.getElementById("new-field-section");

    result +=
        `<div id="extraField">
        <div class="algebra">
                <select class="form-control" id="option` +
        measurementToolField.length +
        `">
                    <option>Add</option>
                    <option>Subtract</option>
                </select>
        </div>
        <div></div>
        <div class="height-field textfield">
            <label class="textfield-label" for="height` +
        measurementToolField.length +
        `">Height</label>
            <input class="textfield-input form-control"type="number" max="100000" min="0"  step="0.01" id="height` +
        measurementToolField.length +
        `" required ="" >
        </div>

        <div class="width-field textfield">
            <label  class="textfield-input" for="width` +
        measurementToolField.length +
        `">Width</label>
            <input  class="textfield-input form-control" type="number" max="100000" min="0"  step="0.01"  id="width` +
        measurementToolField.length +
        `" required ="">
        </div>

        </div>

        <hr><br><br>`;

    let heightId = "height" + measurementToolField.length;
    let widthId = "width" + measurementToolField.length;
    let optionId = "option" + measurementToolField.length;
    let array_to_push = new Array();
    array_to_push[0] = heightId;
    array_to_push[1] = widthId;
    array_to_push[2] = optionId;
    measurementToolField.push(array_to_push);
    outputRef.insertAdjacentHTML("afterEnd", result);
}

//////////////////////////////////////////////////////////////////////////////

// function for L/M Calculator
function calculateItemLength() {
    var inputItemLength = document.getElementById("length");
    let total = inputItemLength.value;

    for (let f = 0; f < measurementToolFieldlm.length; f++) {
        let lengthId = measurementToolFieldlm[f];
        lengthId = lengthId[0];

        let nextInputItemLength = document.getElementById(lengthId);
        let option = document.getElementById(measurementToolFieldlm[f][1]);
        if (option.value == "Add") {
            total = parseFloat(total) + parseFloat(nextInputItemLength.value);
        } else if (option.value == "Subtract") {
            total -= nextInputItemLength.value;
        }
    }
    document.getElementById("resultlm").value = total;
    document.getElementById("item_quantity").value = total;
    let itemRate = document.getElementById("item_rate").value;
    let itemQuantity = document.getElementById("item_quantity").value;
    document.getElementById("item_total").value = itemQuantity * itemRate;
}

function addMeasureFieldLength() {
    let result = "";

    let outputReflm = document.getElementById("new-field-sectionlm");

    result +=
        `<div class ="extraFieldlm">

        <div class="algebra">
                <select class="form-control" id="option` +
                measurementToolFieldlm.length +
                `">
                    <option>Add</option>
                    <option>Subtract</option>
                </select>
        </div>


        <div class="textfield">

                <div class="textfield-label">
                    <label for="length` +
        measurementToolFieldlm.length +
        `">Length</label>
                    <input type="number" max="100000" min="0" step="0.01" class="form-control" id="length` +
        measurementToolFieldlm.length +
        `" required ="">
                </div>

            </div>

        </div>

        <hr><br>`;

    let lengthId = "length" + measurementToolFieldlm.length;
    let optionId = "option" + measurementToolFieldlm.length;
    let array_to_push = new Array();
    array_to_push[0] = lengthId;
    array_to_push[1] = optionId;
    measurementToolFieldlm.push(array_to_push);
    outputReflm.insertAdjacentHTML("afterend", result);
}

//////////////////////////////////////////////////////////////////////////////

//////////////////////// Excepted Year Due Function//////////////////////////
function calculateExpectedYeearDue() {
    var inspectiondate = document.getElementById("oriDate").value;
    console.log(inspectiondate);

    var addedYear = document.getElementById("year_due").value;

    document.getElementById("expected_year_due").value =
        parseInt(inspectiondate) + parseInt(addedYear);
}


//exporet
