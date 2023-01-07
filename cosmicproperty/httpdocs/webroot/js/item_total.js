var table = document.getElementById("report-table");
let table_row = table.getElementsByTagName("tr");
//GST
let GST = parseFloat(document.querySelector("#GST").innerHTML);
let total_arr = [];
let total_year = [];

//Currency exchange
let myObj = {
    style: "currency",
    currency: "AUD",
};

for (let i = 2; i < table_row.length - 1; i++) {
    let cell_array = table_row[i].getElementsByTagName("td");

    let array = [];
    for (let j = 4; j < cell_array.length; j++) {
        let value = parseFloat(cell_array[j].innerHTML.replace(",", ""));
        if (!isNaN(value)) {
            array.push(value);
        } else {
            array.push(0);
        }
    }

    total_arr.push(array);
}



let total_ref = document.getElementById("result");

let total_row = total_ref.getElementsByTagName("td");

let index = 0;

for (let k = 4; k < total_row.length; k++) {
    let total = 0;
    for (let a = 0; a < total_arr.length; a++) {
        total += total_arr[a][index];
    }
    total_year.push(Math.round(total));
    console.log(total);

    let display = parseFloat(total.toFixed(2)).toLocaleString("en-AU", myObj);
    total_row[k].innerHTML = display;

    index += 1;
}

//Display period

let display_period = parseInt(
    document.querySelector("#display-period").innerHTML
);
let forecast_period = parseInt(
    document.querySelector("#forecast-period").innerHTML
);

//Hide columns in items table
let total_num_items = parseInt(document.querySelector("#total-item").innerHTML);
let start = display_period;
let end = forecast_period;

for (let i = 0; i < total_num_items; i++) {
    start = display_period;
    while (start < end) {
        let id = `#item` + i + ` td:nth-child(${start + 4 + 1})`;

        document.querySelector(id).style.display = "none";

        start += 1;
    }
}
start = display_period;
while (start < end) {
    let id = `#result` + ` td:nth-child(${start + 4 + 1})`;

    document.querySelector(id).style.display = "none";

    start += 1;
}

//Total Budget Amount
let item_totals = 0;

for (let index = 0; index < total_year.length; index++) {
    item_totals += total_year[index];
}

//Starting balance  or Fund balance

let fund_balance = parseFloat(
    document.querySelector("#starting-balance").innerHTML
);
//Base Contribution Percentage-Registered
let base_contribution_percentage = parseFloat(document.querySelector("#base-contribution-percentage").innerHTML);


//Base Contributions

let base_contributions = (item_totals / forecast_period + fund_balance)*base_contribution_percentage;

//contribution safety net
let contribution_safety_net = parseFloat(
    document.querySelector("#contribution-safety-net").innerHTML
);

//Tax rate
let tax_rate = parseFloat(document.querySelector("#tax-rate").innerHTML);

//interest rate
let interest_rate = parseFloat(
    document.querySelector("#interest-rate").innerHTML
);

//GST-Registered
let GST_status = document.querySelector("#GST-status").innerHTML;



// these 2 belows stay the same
let contributions_exclude_GST = [];
let contributions_include_GST = []; //CIG

//not stay the same
let annual_expenditure = [];
let interest_after_tax_include_GST = []; //IATIG
let interest_after_tax_exclude_GST = []; //IATEG

let tmp = base_contributions;

for (let i = 0; i < forecast_period; i++) {
    tmp = tmp + tmp * contribution_safety_net;
    contributions_exclude_GST.push(tmp);
    let CIG = tmp + tmp * GST;
    contributions_include_GST.push(CIG);
    let annual_expenditure_value = total_year[i] * [1 + GST];
    annual_expenditure.push(parseFloat(annual_expenditure_value.toFixed(2)));
}
let end_of_financial_year_fund_available = [];
//if condition start for registered an unregistered
if (GST_status.toLowerCase() === "registered") {
    let interest_of_contributions_exclude_GST = []; //IOCEG

    let contributions_include_interest_tax_exclude_GST = [];
    let sub_total1 = [];

    //First year only calculations
    let IOCEG = contributions_exclude_GST[0] * interest_rate;
    let IATEG = IOCEG * (1 - tax_rate);
    let CIITEG = contributions_include_GST[0] + IATEG;
    let sub_total1_value = CIITEG;
    let end_of_financial_year_fund_available_value =
        sub_total1_value - total_year[0] * (1 + GST);

    //push to array
    interest_of_contributions_exclude_GST.push(IOCEG);
    interest_after_tax_exclude_GST.push(IATEG);
    contributions_include_interest_tax_exclude_GST.push(CIITEG);
    sub_total1.push(sub_total1_value);
    end_of_financial_year_fund_available.push(
        end_of_financial_year_fund_available_value
    );

    for (let i = 1; i < forecast_period; i++) {
        IOCEG =
            (contributions_exclude_GST[i] +
                end_of_financial_year_fund_available[i - 1]) *
            interest_rate;
        IATEG = IOCEG * (1 - tax_rate);
        CIITEG = contributions_include_GST[i] + IATEG;
        sub_total1_value = CIITEG + end_of_financial_year_fund_available[i - 1];
        end_of_financial_year_fund_available_value =
            sub_total1_value - total_year[i] * (1 + GST);

        //push to array

        interest_of_contributions_exclude_GST.push(IOCEG);
        interest_after_tax_exclude_GST.push(IATEG);
        contributions_include_interest_tax_exclude_GST.push(CIITEG);
        sub_total1.push(sub_total1_value);
        end_of_financial_year_fund_available.push(
            end_of_financial_year_fund_available_value
        );
    }
    for (let i = 0; i < display_period; i++) {
        let myObj = {
            style: "currency",
            currency: "AUD",
        };
        var end_of_year_node = document.createElement("Td");
        var end_of_year_textNode = document.createTextNode(
            parseFloat(
                end_of_financial_year_fund_available[i].toFixed(2)
            ).toLocaleString("en-AU", myObj)
        ); // Create a text node

        var eoy = parseFloat(
            end_of_financial_year_fund_available[i].toFixed(2)

        );

        if (eoy < 0) {
            end_of_year_node.setAttribute("style","background-color: lightcoral");
        }
        end_of_year_node.appendChild(end_of_year_textNode);
        document
            .querySelector(".end_of_year_funds_available")
            .appendChild(end_of_year_node);


        //Balance brought forward - Display

        if (i < display_period - 1) {
            let balance_brought_forward_node = document.createElement("td");
            let balance_brought_forward_textNode = document.createTextNode(
                parseFloat(
                    end_of_financial_year_fund_available[i].toFixed(2)
                ).toLocaleString("en-AU", myObj)
            );

            balance_brought_forward_node.appendChild(
                balance_brought_forward_textNode );

            var bbf = parseFloat(
                end_of_financial_year_fund_available[i].toFixed(2)
            );

            if (bbf < 0) {
                balance_brought_forward_node.setAttribute("style","background-color: lightcoral");
            }

            document
                .querySelector(".balance_brought_forward")
                .appendChild(balance_brought_forward_node);
        }

        //Budgeted Annual Contribution - CIG

        let budget_annual_contribution_node = document.createElement("Td");

        let budget_annual_contribution_textNode = document.createTextNode(
            parseFloat(contributions_include_GST[i].toFixed(2)).toLocaleString(
                "en-AU",
                myObj
            )
        );
        budget_annual_contribution_node.appendChild(
            budget_annual_contribution_textNode
        );

        var bac = parseFloat(
            contributions_include_GST[i].toFixed(2)

        );

        if (bac < 0) {
            budget_annual_contribution_node.setAttribute("style","background-color: lightcoral");
        }

        document
            .querySelector(".BAC")
            .appendChild(budget_annual_contribution_node);

        //Interest After tax

        let interest_after_tax_node = document.createElement("td");
        let interest_after_tax_textNode = document.createTextNode(
            parseFloat(
                interest_after_tax_exclude_GST[i].toFixed(2)
            ).toLocaleString("en-AU", myObj)
        );
        interest_after_tax_node.appendChild(interest_after_tax_textNode);
        document
            .querySelector(".interest-after-tax")
            .appendChild(interest_after_tax_node);

        var iat = parseFloat(
            interest_after_tax_exclude_GST[i].toFixed(2)

        );

        if (iat < 0) {
            interest_after_tax_node.setAttribute("style","background-color: lightcoral");
        }


        //subtotal1
        let subtotal_node = document.createElement("td");
        let subtotal_textNode = document.createTextNode(
            parseFloat(sub_total1[i].toFixed(2)).toLocaleString("en-AU", myObj)
        );
        subtotal_node.appendChild(subtotal_textNode);
        document.querySelector(".subtotal_1").appendChild(subtotal_node);

        var st = parseFloat(
            sub_total1[i].toFixed(2)

        );

        if (st < 0) {
            subtotal_node.setAttribute("style","background-color: lightcoral");
        }

        //annual Expenditure
        let annualExpenditure_value = total_year[i] * (1 + GST);
        let annual_node = document.createElement("td");
        let annual_textNode = document.createTextNode(
            parseFloat(annualExpenditure_value.toFixed(2)).toLocaleString(
                "en-AU",
                myObj
            )
        );
        annual_node.appendChild(annual_textNode);
        document.querySelector(".annual-expenditure").appendChild(annual_node);

    }
} else {
    let interest_of_contributions_include_GST = []; //IOCIG
    let contributions_include_interest_tax_include_GST = []; //CIITIG
    let sub_total1 = [];

    var an = parseFloat(
        annualExpenditure_value[i].toFixed(2)

    );

    if (an < 0) {
        annual_node.setAttribute("style","background-color: lightcoral");
    }

    // First year only calculations
    let IOCIG = contributions_include_GST[0] * interest_rate;
    let IATIG = IOCIG * (1 - tax_rate);
    let CIITIG = contributions_include_GST[0] + IATIG;
    let sub_total1_value = CIITIG;
    let end_of_financial_year_fund_available_value =
        sub_total1_value - total_year[0] * (1 + GST);
    // push to array
    interest_of_contributions_include_GST.push(IOCIG);
    interest_after_tax_include_GST.push(IATIG);
    contributions_include_interest_tax_include_GST.push(CIITIG);
    sub_total1.push(sub_total1_value);
    end_of_financial_year_fund_available.push(
        end_of_financial_year_fund_available_value
    );


    for (let i = 1; i < forecast_period; i++) {
        IOCIG =
            (contributions_include_GST[i] +
                end_of_financial_year_fund_available[i - 1]) *
            interest_rate;
        IATIG = IOCIG * (1 - tax_rate);
        CIITIG = contributions_include_GST[i] + IATIG;
        sub_total1_value = CIITIG + end_of_financial_year_fund_available[i - 1];
        end_of_financial_year_fund_available_value =
            sub_total1_value - total_year[i] * (1 + GST);

        //push to array

        interest_of_contributions_include_GST.push(IOCIG);
        interest_after_tax_include_GST.push(IATIG);
        contributions_include_interest_tax_include_GST.push(CIITIG);
        sub_total1.push(sub_total1_value);
        end_of_financial_year_fund_available.push(
            end_of_financial_year_fund_available_value
        );
    }

    //display
    for (let i = 0; i < display_period; i++) {
        let myObj = {
            style: "currency",
            currency: "AUD",
        };
        let end_of_year_node = document.createElement("Td");
        let end_of_year_textNode = document.createTextNode(
            parseFloat(
                end_of_financial_year_fund_available[i].toFixed(2)
            ).toLocaleString("en-AU", myObj)
        );

        end_of_year_node.appendChild(end_of_year_textNode);
        document
            .querySelector(".end_of_year_funds_available")
            .appendChild(end_of_year_node);


        //Balance brought forward

        if (i < display_period - 1) {
            let balance_brought_forward_node = document.createElement("td");
            let balance_brought_forward_textNode = document.createTextNode(
                parseFloat(
                    end_of_financial_year_fund_available[i].toFixed(2)
                ).toLocaleString("en-AU", myObj)
            );


            balance_brought_forward_node.appendChild(
                balance_brought_forward_textNode

            );


            document
                .querySelector(".balance_brought_forward")
                .appendChild(balance_brought_forward_node);
        }
        //Budgeted Annual Contribution - CIG

        let budget_annual_contribution_node = document.createElement("Td");

        let budget_annual_contribution_textNode = document.createTextNode(
            parseFloat(contributions_include_GST[i].toFixed(2)).toLocaleString(
                "en-AU",
                myObj
            )
        );
        budget_annual_contribution_node.appendChild(
            budget_annual_contribution_textNode
        );
        document
            .querySelector(".BAC")
            .appendChild(budget_annual_contribution_node);

        //Interest After tax

        let interest_after_tax_node = document.createElement("td");
        let interest_after_tax_textNode = document.createTextNode(
            parseFloat(
                interest_after_tax_include_GST[i].toFixed(2)
            ).toLocaleString("en-AU", myObj)
        );
        interest_after_tax_node.appendChild(interest_after_tax_textNode);
        document
            .querySelector(".interest-after-tax")
            .appendChild(interest_after_tax_node);

        //subtotal1
        let subtotal_node = document.createElement("td");
        let subtotal_textNode = document.createTextNode(
            parseFloat(sub_total1[i].toFixed(2)).toLocaleString("en-AU", myObj)
        );
        subtotal_node.appendChild(subtotal_textNode);
        document.querySelector(".subtotal_1").appendChild(subtotal_node);

        //annual Expenditure
        let annualExpenditure_value = total_year[i] * (1 + GST);
        let annual_node = document.createElement("td");
        let annual_textNode = document.createTextNode(
            parseFloat(annualExpenditure_value.toFixed(2)).toLocaleString(
                "en-AU",
                myObj
            )
        );
        annual_node.appendChild(annual_textNode);
        document.querySelector(".annual-expenditure").appendChild(annual_node);
    }
}

//Generate the chart

let data = [];
let label = [];
// Create our number formatter.
var formatter = new Intl.NumberFormat('en-AU', {
    style: 'currency',
    currency: 'AUD',
});

let arr_length = document
    .querySelector(".end_of_year_funds_available")
    .getElementsByTagName("td").length;

for (let i = 1; i < arr_length; i++) {
    let value = parseInt(
        document
            .querySelector(".end_of_year_funds_available")
            .getElementsByTagName("td")[i].innerHTML
    );
    data.push(value);
    label.push(i);
}

// Change end_of_financial_year_fund_available to be whole numbers
var rounded_end_of_financial_year_fund_available = []
for(let i = 0; i < end_of_financial_year_fund_available.length; i++){
    rounded_end_of_financial_year_fund_available.push(Math.round(end_of_financial_year_fund_available[i]));
}

// Change end_of_financial_year_fund_available to be whole numbers
var rounded_annual_expenditure = []
for(let i = 0; i < annual_expenditure.length; i++){
    rounded_annual_expenditure.push(Math.round(annual_expenditure[i]));
}

var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: label,
        datasets: [
            {
                barPercentage: 0.7,

                label: "Total Available Funds",
                data: rounded_end_of_financial_year_fund_available,
                backgroundColor: "rgba(54, 162, 235)",

                borderWidth: 1,
                order: 2,
            },
            {
                barPercentage: 0.7,

                label: "Expenditure",
                data: rounded_annual_expenditure,
                backgroundColor: "#EB9605",

                borderWidth: 1,
                order: 1,
            },
        ],
    },
    options: {
        tooltips: {
            callbacks: {
                label: function(t, d) {
                    var xLabel = d.datasets[t.datasetIndex].label;
                    var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
                    return xLabel + ': ' + yLabel;
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: "top",
            labels: {
                fontColor: "#000",
                fontSize: 15,
            },
        },
        scales: {
            xAxes: [
                {
                    scaleLabel: {
                        display: true,
                        labelString: "Year",
                        fontSize: "25",
                        fontStyle: "bold",
                        fontColor: "#000",
                    },
                    ticks: {
                        fontColor: "#000",
                        fontSize: 20,
                        beginAtZero: true,
                    },
                },
            ],
            yAxes: [
                {
                    scaleLabel: {
                        display: true,
                        labelString: "Available Funds $",
                        fontSize: "25",
                        fontStyle: "bold",
                        fontColor: "#000",
                    },
                    ticks: {
                        fontColor: "#000",
                        fontSize: 20,
                        beginAtZero: true,

                        callback: function (value, index, values) {
                            return "$" + value;
                        },
                    },
                },
            ],
        },
    },
});

//Line Chart
let interest_data;
if (GST_status.toLowerCase() === "registered") {
    interest_data = interest_after_tax_exclude_GST;
} else {
    interest_data = interest_after_tax_include_GST;
}

// Change interest_data to be whole numbers
var rounded_interest_data = []
for(let i = 0; i < interest_data.length; i++){
    rounded_interest_data.push(Math.round(interest_data[i]));
}

var ctx2 = document.getElementById("line-chart").getContext("2d");
var lineChart = new Chart(ctx2, {
    type: "line",
    data: {
        labels: label,
        datasets: [
            {
                label: "Total Available Funds",
                data: rounded_end_of_financial_year_fund_available,
                backgroundColor: "rgba(54, 162, 235)",
                fill: false,
                borderColor: "rgba(54, 162, 235)",
                order: 2,
            },
            {
                label: "Expenditure",
                data: rounded_annual_expenditure,
                backgroundColor: "#EB9605",
                borderColor: "#EB9605",
                fill: false,
                order: 1,
            },
            {
                label: "Interest",
                data: rounded_interest_data,
                backgroundColor: "red",
                borderColor: "red",
                fill: false,
                order: 1,
            },
        ],
    },
    options: {
        tooltips: {
            callbacks: {
                label: function(t, d) {
                    var xLabel = d.datasets[t.datasetIndex].label;
                    var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
                    return xLabel + ': ' + yLabel;
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: "top",
            labels: {
                fontColor: "#000",
                fontSize: 15,
            },
        },
        scales: {
            xAxes: [
                {
                    scaleLabel: {
                        display: true,
                        labelString: "Year",
                        fontSize: "25",
                        fontStyle: "bold",
                        fontColor: "#000",
                    },
                    ticks: {
                        fontColor: "#000",
                        fontSize: 20,
                        beginAtZero: true,
                    },
                },
            ],
            yAxes: [
                {
                    scaleLabel: {
                        display: true,
                        labelString: "Available Funds $",
                        fontSize: "25",
                        fontStyle: "bold",
                        fontColor: "#000",
                    },
                    ticks: {
                        fontColor: "#000",
                        fontSize: 20,
                        beginAtZero: true,

                        callback: function (value, index, values) {
                            return "$" + value;
                        },
                    },
                },
            ],
        },
    },
});

// print selection
function printItemTable() {
    form = document.querySelector(".report-download-form");
    form.style.display = "none";
    btn = document.querySelector(".btn-primary");
    btn.style.display = "none";
    sectionD = document.querySelector(".section-d");
    sectionB = document.querySelector(".section-b");
    sectionC = document.querySelector(".section-c");
    header = document.querySelector(".header");
    sectionE = document.querySelector(".section-e");
    header.style.display = "none";
    sectionD.style.display = "none";
    sectionB.style.display = "none";
    sectionC.style.display = "none";
    sectionE.style.display = "none";
    window.print();
    location.reload();
}

function printSummaryTable() {
    form = document.querySelector(".report-download-form");
    form.style.display = "none";
    btn = document.querySelector(".btn-primary");
    btn.style.display = "none";
    sectionD = document.querySelector(".section-d");
    sectionA = document.querySelector(".section-a");
    sectionC = document.querySelector(".section-c");
    sectionE = document.querySelector(".section-e");
    downloadBtn = document.querySelector(".section-b .header");
    downloadBtn.style.display = "none";
    sectionD.style.display = "none";
    sectionA.style.display = "none";
    sectionC.style.display = "none";
    sectionE.style.display = "none";
    window.print();
    location.reload();
}

function printBarChart() {
    form = document.querySelector(".report-download-form");
    form.style.display = "none";
    btn = document.querySelector(".btn-primary");
    btn.style.display = "none";
    sectionD = document.querySelector(".section-d");
    sectionA = document.querySelector(".section-a");
    sectionB = document.querySelector(".section-b");
    sectionE = document.querySelector(".section-e");
    downloadBtn = document.querySelector(".section-c .header");
    downloadBtn.style.display = "none";
    sectionD.style.display = "none";
    sectionA.style.display = "none";
    sectionB.style.display = "none";
    sectionE.style.display = "none";
    window.print();
    location.reload();
}

function printLineChart() {
    form = document.querySelector(".report-download-form");
    form.style.display = "none";
    btn = document.querySelector(".btn-primary");
    btn.style.display = "none";
    sectionB = document.querySelector(".section-b");
    sectionA = document.querySelector(".section-a");
    sectionC = document.querySelector(".section-c");
    sectionE = document.querySelector(".section-e");
    downloadBtn = document.querySelector(".section-d .header");
    downloadBtn.style.display = "none";
    sectionB.style.display = "none";
    sectionA.style.display = "none";
    sectionC.style.display = "none";
    sectionE.style.display = "none";
    window.print();
    location.reload();
}

function printLiabilityTable() {
    form = document.querySelector(".report-download-form");
    form.style.display = "none";
    btn = document.querySelector(".btn-primary");
    btn.style.display = "none";
    sectionA = document.querySelector(".section-a");
    sectionB = document.querySelector(".section-b");
    sectionC = document.querySelector(".section-c");
    sectionD = document.querySelector(".section-d");
    downloadBtn = document.querySelector(".section-e .header");
    downloadBtn.style.display = "none";
    sectionB.style.display = "none";
    sectionA.style.display = "none";
    sectionC.style.display = "none";
    sectionD.style.display = "none";
    window.print();
    location.reload();
}
//Liabilities Table

let total_lot_liabilities = parseInt(
    document.querySelector("#total-lot-liabilities").innerHTML
);

let number_of_lot = parseInt(
    document.querySelector("#number-of-lot").innerHTML
);
let lot_liability_arr = [];
let rate_per_lot_arr = [];
for (let j = 0; j < number_of_lot; j++) {
    let lot_liability = document.querySelector("#no-liabilities-lot" + (j + 1))
        .innerHTML;
    lot_liability_arr.push(parseInt(lot_liability));
}

for (let i = 0; i < display_period; i++) {
    let total_lot_row = document.querySelector(".total-lot");
    let rate_per_lot_row = document.querySelector(".rate-per-lot-liability");

    let rate_per_lot_liability =
        contributions_include_GST[i] / total_lot_liabilities;
    rate_per_lot_arr.push(rate_per_lot_liability);
    let lot_liability_node = document.createElement("td");
    let lot_liability_node_textNode = document.createTextNode(
        parseFloat(rate_per_lot_liability.toFixed(2)).toLocaleString(
            "en-AU",
            myObj
        )
    );
    lot_liability_node.appendChild(lot_liability_node_textNode);
    rate_per_lot_row.appendChild(lot_liability_node);

    let contribution_node = document.createElement("td");
    let contribution_node_textNode = document.createTextNode(
        parseFloat(contributions_include_GST[i].toFixed(2)).toLocaleString(
            "en-AU",
            myObj
        )
    );
    contribution_node.appendChild(contribution_node_textNode);
    total_lot_row.appendChild(contribution_node);
}

for (let row_index = 0; row_index < lot_liability_arr.length; row_index++) {
    for (column_index = 0; column_index < display_period; column_index++) {
        let tr_lot = document.querySelector("#lot-" + (row_index + 1));

        let td_lot_node = document.createElement("td");
        let td_lot_textNode = document.createTextNode(
            parseFloat(
                rate_per_lot_arr[column_index] *
                lot_liability_arr[row_index].toFixed(2)
            ).toLocaleString("en-AU", myObj)
        );
        td_lot_node.appendChild(td_lot_textNode);
        tr_lot.appendChild(td_lot_node);
    }
}
