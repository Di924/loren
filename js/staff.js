function InputBox(input, labelName){
    return `<div class="input-box">`
                + input + 
                `<label>` + labelName + `</label>
            </div>`;
}

function AddTR(tableBodyId, ...args) {
    let tableBody = document.getElementById(tableBodyId);
    let newForm = document.createElement("form");
    newForm.method = "POST";
    newForm.action = "/handlers/tablesHandler.php";

    for (let i = 0; i < args.length; i++) {
        newForm.innerHTML += args[i];
    }

    tableBody.prepend(newForm);
}