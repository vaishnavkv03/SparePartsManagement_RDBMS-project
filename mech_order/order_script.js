function calculateTotal(selectElement) {
    var orderElem = selectElement.closest('.orderElem');
    var partSelect = orderElem.querySelector('select[name="part_id[]"]');
    var quantity = orderElem.querySelector('input[name="quantity[]"]').value;
    var cost = partSelect.options[partSelect.selectedIndex].dataset.cost;
    var total = quantity * cost;
    orderElem.querySelector('input[name="total[]"]').value = "Rs." + total.toFixed(2);
}

function validateForm() {
    var partSelects = document.querySelectorAll('select[name="part_id[]"]');
    var quantities = document.querySelectorAll('input[name="quantity[]"]');

    for (var i = 0; i < partSelects.length; i++) {
        if (partSelects[i].value === "") {
            alert("Please select a part.");
            return false;
        }
        if (quantities[i].value <= 0) {
            alert("Please enter a valid quantity.");
            return false;
        }
    }

    return true;
}

function addOrder() {
    var orderContainer = document.getElementById('order-container');
    var newOrder = document.querySelector('.orderElem').cloneNode(true);

    // Reset the values of the new order
    var selects = newOrder.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++) {
        selects[i].selectedIndex = 0;
    }

    var inputs = newOrder.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type === "number") {
            inputs[i].value = 1;
        } else {
            inputs[i].value = "";
        }
    }

    orderContainer.appendChild(newOrder);
}

function removeOrder(button) {
    var orderContainer = document.getElementById('order-container');
    if (orderContainer.childElementCount > 1) {
        var orderElem = button.closest('.orderElem');
        orderContainer.removeChild(orderElem);
    }
}

function removeLastOrder() {
    var orderContainer = document.getElementById('order-container');
    if (orderContainer.childElementCount > 1) {
        orderContainer.removeChild(orderContainer.lastElementChild);
    }
}
