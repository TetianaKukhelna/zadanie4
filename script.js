const dayWeek = ["Pondelok", "Utorok", "Streda", "Stvrtok", "Piatok", "Sobota", "Nedela"];
const restaurants = ["Eat&Meet","Fiit Food","Delikanti"];
clearTable();
$("#cele-menu-table").css( "display","block");

fetch("main.php", {method: "get"})
    .then(response => response.json())
    .then(result => {
        $("#pondelok-table").append(nazovDnathead(0));
        $("#pondelok-table").append(getDailymenu(result, 0, false));
        $("#utorok-table").append(nazovDnathead(1));
        $("#utorok-table").append(getDailymenu(result, 1, false));
        $("#streda-table").append(nazovDnathead(2));
        $("#streda-table").append(getDailymenu(result, 2, false));
        $("#stvrtok-table").append(nazovDnathead(3));
        $("#stvrtok-table").append(getDailymenu(result, 3, false));
        $("#piatok-table").append(nazovDnathead(4));
        $("#piatok-table").append(getDailymenu(result, 4, false));
        $("#sobota-table").append(nazovDnathead(5));
        $("#sobota-table").append(getDailymenu(result, 5, false));
        $("#nedela-table").append(nazovDnathead(6));
        $("#nedela-table").append(getDailymenu(result, 6, false));

        // for(let i = 0; i<7;i++){
        //     $("#cele-menu-table").append(getDailymenu(result, i, true));
        // }
        //$("#cele-menu-table").append(nazovDnathead(0));
        $("#cele-menu-table").append(getDailymenu(result, 0, true));
        //$("#cele-menu-table").append(nazovDnathead(1));
        $("#cele-menu-table").append(getDailymenu(result, 1, true));
        //$("#cele-menu-table").append(nazovDnathead(2));
        $("#cele-menu-table").append(getDailymenu(result, 2, true));
        //$("#cele-menu-table").append(nazovDnathead(3));
        $("#cele-menu-table").append(getDailymenu(result, 3, true));
        //$("#cele-menu-table").append(nazovDnathead(4));
        $("#cele-menu-table").append(getDailymenu(result, 4, true));
        //$("#cele-menu-table").append(nazovDnathead(5));
        $("#cele-menu-table").append(getDailymenu(result, 5, true));
        //$("#cele-menu-table").append(nazovDnathead(6));
        $("#cele-menu-table").append(getDailymenu(result, 6, true));
        // console.log(allDays(result,$("#cele-menu-table")));
        //allDays(result,$("#cele-menu-table"));
    });

function allDays(menu,table){

    for(let i = 0; i<7;i++){
        table.append(getDailymenu(menu,i,true));
    }

}

function nazovDnathead(dayNumber,boolAppendDay = false){
    const thead = document.createElement("thead");
    const tr1 = document.createElement("tr");
    const td1 = document.createElement("td");

    td1.innerText = dayWeek[dayNumber];
    tr1.append(td1);
    thead.append(tr1);
    thead.append(createRestaurants(boolAppendDay));
    return thead;
}

function createRestaurants(boolAppendDay){
    const tr = document.createElement("tr");

    if (boolAppendDay === true) {
        const day = document.createElement("td");
        day.innerText = "";
        tr.append(day);
    }

    for (let i = 0; i<3;i++){
        const td = document.createElement("td");
        td.innerText = restaurants[i];
        tr.append(td);
    }
    return tr;
}

function getMenu(menu, dayNumber, idRestaurant) {
    const day = document.createElement("td");

    const table_ul = document.createElement("ul");
    menu[idRestaurant][dayNumber]["menu"].forEach(item => {
        const table_li = document.createElement("li");
        table_li.innerText = item;
        table_ul.append(table_li);
    });
    day.append(table_ul);
    return day;
}

function getDailymenu(menu, dayNumber, boolAppendDay) {
    const table_tr = document.createElement("tr");
    if (boolAppendDay === true) {
        const day = document.createElement("td");
        day.innerText = dayWeek[dayNumber];
        table_tr.append(day);
    }
    for (let i = 0; i < 3; i++) {
        table_tr.append(getMenu(menu, dayNumber, i));
    }
    return table_tr;
}

function clearTable(){
    $("#cele-menu-table").css( "display","none");
    $("#pondelok-table").css( "display","none");
    $("#utorok-table").css( "display","none");
    $("#streda-table").css( "display","none");
    $("#stvrtok-table").css( "display","none");
    $("#piatok-table").css( "display","none");
    $("#sobota-table").css( "display","none");
    $("#nedela-table").css( "display","none");

}

$('#cele-menu').on('click', () => {
    clearTable();
    $("#cele-menu-table").css( "display","block");
})

$('#pondelok').on('click', () => {
    clearTable();
    $("#pondelok-table").css( "display","block");
})

$('#utorok').on('click', () => {
    clearTable();
    $("#utorok-table").css( "display","block");
})
$('#streda').on('click', () => {
    clearTable();
    $("#streda-table").css( "display","block");
})
$('#stvrtok').on('click', () => {
    clearTable();
    $("#stvrtok-table").css( "display","block");
})

$('#piatok').on('click', () => {
    clearTable();
    $("#piatok-table").css( "display","block");
})

$('#sobota').on('click', () => {
    clearTable();
    $("#sobota-table").css( "display","block");
})

$('#nedela').on('click', () => {
    clearTable();
    $("#nedela-table").css( "display","block");
})
