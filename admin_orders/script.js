document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('.mech').addEventListener('click', function() {
        fetchOrders('ordered', true);
    });
    document.querySelector('.manu').addEventListener('click', function() {
        fetchOrders('approved', false);
    });
});

function fetchOrders(status, showActionColumn) {
    fetch('fetch_orders.php?status=' + status)
    .then(response => response.json())
    .then(data => {
        let table;
        if (data.length > 0) {
            table = '<table><tr><th>Order ID</th><th>Parts Name</th><th>Ordered By</th><th>Quantity</th><th>Total Amount</th><th>Ordered Date</th>';
            if (showActionColumn) {
                table += '<th>Action</th>';
                
            }
            table += '</tr>';
            data.forEach(order => {
                table += `<tr>
                            <td>${order.order_id}</td>
                            <td>${order.parts_name}</td>
                            <td>${order.ordered_by}</td>
                            <td>${order.quantity}</td>
                            <td>${order.total_amount}</td>
                            <td>${order.ordered_date}</td>`;
                if (showActionColumn) {
                    table += `<td><button onclick="approveOrder(${order.order_id})">Approve</button></td>`;
                }
                table += `</tr>`;
            });
            table += '</table>';
        } else {
            table = '<p>No orders.</p>';
        }
        document.querySelector('.tt').innerHTML = table;
    })
    .catch(error => console.error('Error fetching orders:', error));
}

function approveOrder(orderId) {
    fetch('approve_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ order_id: orderId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order approved successfully');
            fetchOrders('ordered', true); // Refresh the list of orders
        } else {
            alert('Error approving order');
        }
    })
    .catch(error => console.error('Error approving order:', error));
}
