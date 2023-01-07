function liabilitiesCalculation(){

    let remaining = parseInt(document.getElementById("remaining_liabilities_forJs").innerHTML);
    
    let arr_length = parseInt(document.getElementById("num_of_lot").innerHTML);

    
  
    let arr_sum = [];


    for (let i = 0 ; i < arr_length; i++){
        let lot_liability = parseInt(document.getElementById(`no_liabilities[${i}]`).value);
        if(document.getElementById(`no_liabilities[${i}]`).value == ""){
            lot_liability = 0;
        }
        arr_sum.push(lot_liability);
        
    }

    
    const reducer = (accumulator, currentValue) => accumulator + currentValue;
    let sum = arr_sum.reduce(reducer);
    

    remaining -= sum;
    document.querySelector("#remaining_liabilities").innerHTML = "Remaining Liabilities: " + remaining;


}