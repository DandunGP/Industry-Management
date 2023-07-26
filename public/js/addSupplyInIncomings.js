var state = 0;

function toggleSupplier() {
    var selectElement = document.getElementById('id_supply');
    var buttonElement = document.getElementById('toggle-supplier');
    var inputElement = document.getElementById('input_supply');
    var inputTotalElement = document.getElementById('input-total-supply');
    if (state == 0) {
        inputTotalElement.disabled = true;
        inputTotalElement.style.display = "none";
        selectElement.disabled = true;
        selectElement.style.display = "none";
        inputElement.style.display = "block";
        var inputs = inputElement.querySelectorAll('input, select , textarea');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        buttonElement.innerHTML = "Pilih Supplier";
        state = 1;
    } else {
        inputTotalElement.disabled = false;
        inputTotalElement.style.display = "block";
        selectElement.disabled = false;
        selectElement.style.display = "block";
        inputElement.style.display = "none";
        var inputs = inputElement.querySelectorAll('input, select , textarea');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }
        buttonElement.innerHTML = "Tambah Supplier";
        state = 0;
    }
}