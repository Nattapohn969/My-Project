
document.addEventListener('DOMContentLoaded', function() {
    const addQueueForm = document.getElementById('addQueueForm');
    const queueTable = document.getElementById('queueTable');
    const queueBody = document.getElementById('queueBody');

  
    fetchQueues();


    addQueueForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const queueNumber = document.getElementById('queueNumber').value.trim();

        if (queueNumber !== '') {
            addQueue(queueNumber);
            document.getElementById('queueNumber').value = ''; // Clear input field
        }
    });


    function fetchQueues() {
        fetch('fetch_queues.php')
            .then(response => response.json())
            .then(data => {
                updateQueueTable(data);
            });
    }


    function updateQueueTable(queues) {
        queueBody.innerHTML = '';
        queues.forEach(queue => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${queue.queue_number}</td>
                <td>${queue.is_completed ? 'Completed' : 'Pending'}</td>
                <td>
                    <button onclick="markCompleted(${queue.customer_id})" ${queue.is_completed ? 'disabled' : ''}>
                        Mark Completed
                    </button>
                </td>
            `;
            queueBody.appendChild(row);
        });
    }


    function addQueue(queueNumber) {
        fetch('add_queue.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ queue_number: queueNumber }),
        })
        .then(response => response.json())
        .then(data => {
            fetchQueues(); 
        });
    }

    
    function markCompleted(customerId) {
        fetch('mark_completed.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ customer_id: customerId }),
        })
        .then(response => response.json())
        .then(data => {
            fetchQueues(); 
        });
    }
});
