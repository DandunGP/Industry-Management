var count = 1;

function addSelect() {
    var selectContainer = document.getElementById('input-supply');

    var divElement = document.createElement('div');
    divElement.id = 'input' + count;
    divElement.setAttribute('class', 'd-flex align-items-center');

    var selectElement = document.createElement('select');
    selectElement.setAttribute('name', 'supply_id[]');
    selectElement.setAttribute('class', 'form-control w-25 mb-2')

    // Laravel Blade syntax to loop through options
    @foreach($supply as $sp)
    var optionElement = document.createElement('option');
    optionElement.setAttribute('value', '{{ $sp->id }}');
    optionElement.textContent = '{{ $sp->supply_code }}';
    selectElement.appendChild(optionElement);
    @endforeach
    divElement.appendChild(selectElement);

    var inputElement = document.createElement('input');
    inputElement.setAttribute('name', 'qty_supply[]');
    inputElement.setAttribute('class', 'form-control w-25 mb-2 mx-2');
    inputElement.setAttribute('type', 'number');
    divElement.appendChild(inputElement);

    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Hapus';
    deleteButton.setAttribute('type', 'button');
    deleteButton.setAttribute('class', 'btn')
    deleteButton.setAttribute('onclick', 'removeInput(' + count + ')');
    divElement.appendChild(deleteButton);


    selectContainer.appendChild(divElement);

    selectCount++;
}

function removeInput(inputId) {
    var inputElement = document.getElementById('input' + inputId);
    inputElement.remove();
}