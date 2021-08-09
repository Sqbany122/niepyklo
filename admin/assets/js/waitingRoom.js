let fetchUrl = '/config/API/adminAPI/waitingRoomAPI.php';

document.querySelector(".addMemeBtn").addEventListener("click", (e) => {
    e.preventDefault();
    let id = e.path[1].dataset.id;

    fetch(fetchUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            add: true,
            id: id
        }),
    })
    .then(response => {
        document.getElementById('memeDiv_' + id).remove();
    })
});

document.querySelector(".deleteMemeBtn").addEventListener("click", (e) => {
    e.preventDefault();
    let id = e.path[1].dataset.id;
    
    fetch(fetchUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            delete: true,
            id: id
        }),
    })
    .then(response => {
        document.getElementById('memeDiv_' + id).remove();
    });
});