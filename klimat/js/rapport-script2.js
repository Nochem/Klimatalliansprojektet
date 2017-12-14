function tonCO2(nbr) {
    var x = document.getElementsByName("unit[]")[nbr].value;
    var amount = document.getElementsByName("amount[]")[nbr].value;
    var convFac = document.getElementsByName("convFactor[]")[nbr].value;
    var emission = document.getElementsByName("emissionCO2[]")[nbr].value;

    if(x != "Ton"){

        amount = noLetters(amount);
        update(nbr, amount, emission, convFac);
        amount = noPeriodFirst(amount);
        update(nbr, amount, emission, convFac);
        amount = checkTwoDot(amount);
        update(nbr, amount, emission, convFac);

        document.getElementsByName("amount[]")[nbr].value = amount;
    }else{
        amount = noLetters(amount);
        updateUnitIsTon(nbr, amount);
        amount = noPeriodFirst(amount);
        updateUnitIsTon(nbr, amount);
        amount = checkTwoDot(amount);
        updateUnitIsTon(nbr, amount);

    }
}

function updateUnitIsTon(nbr, amount) {
    var amount1 = amount.replace(',', '.');
    document.getElementsByName("amount[]")[nbr].value = amount;

    var ton = amount1;
    if (!isNaN(ton) && ton > 0) {

        document.getElementsByName("tonCO[]")[nbr].innerHTML = round(ton, 2);
        document.getElementsByName("ton[]")[nbr].value = round(ton, 2);
    } else {

        document.getElementsByName("tonCO[]")[nbr].innerHTML = "";
        document.getElementsByName("ton[]")[nbr].value = "";
    }
}
function update(nbr, amount, emission, convFac) {
    var amount1 = amount.replace(',', '.');
    document.getElementsByName("amount[]")[nbr].value = amount;

    var ton = amount1 * emission * convFac;
    if (!isNaN(ton) && ton > 0) {

        document.getElementsByName("tonCO[]")[nbr].innerHTML = round(ton, 2);
        document.getElementsByName("ton[]")[nbr].value = round(ton, 2);
    } else {

        document.getElementsByName("tonCO[]")[nbr].innerHTML = "";
        document.getElementsByName("ton[]")[nbr].value = "";
    }
}

function noLetters(str) {

    str = str.replace(/[^0-9,.]/gi, '');
    return str;

}

function noPeriodFirst(str) {

    if (str.charAt(0) == '.') {
        str = setCharAt(str, 0, "");
    }
    if (str.charAt(0) == ',') {
        str = setCharAt(str, 0, "");
    }
    return str;
}
function selectedUnit(arrayindex){




    var unit = document.getElementsByName("unit[]")[arrayindex].value;


    if(unit =="Ton"){

        document.getElementsByName("coFactor[]")[arrayindex].style.visibility = "hidden";
    }else{

        document.getElementsByName("coFactor[]")[arrayindex].style.visibility = "inherit";
    }
    tonCO2(arrayindex);

}

function checkTwoDot(str) {

    if (str.match(/[.,]/gi).length > 1) {

        str = setCharAt(str, str.length - 1, '');
        return str;
    }
    return str;
}

function setCharAt(str, index, chr) {
    if (index > str.length - 1) return str;
    return str.substr(0, index) + chr + str.substr(index + 1);
}

function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}

function hideElemC1() {
    document.getElementById("comment1").style.display = "none";
}

function showElemC1() {
    document.getElementById("comment1").style.display = "initial";
}

function hideElemC2() {
    document.getElementById("comment2").style.display = "none";
}

function showElemC2() {
    document.getElementById("comment2").style.display = "initial";
}
