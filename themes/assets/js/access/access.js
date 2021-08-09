let accesApi = '/config/API/accessAPI/accessAPI.php';

document.querySelectorAll('button.accessDeleteBtn').forEach((item, index) => {
    item.addEventListener("click", (e) => {
        e.preventDefault();
        let userLoginDataId = e.srcElement.getAttribute('data-id');

        fetch(accesApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: true,
                accessId: userLoginDataId,
            }),
        })
        .then(respons => {
            e.srcElement.closest('tr').remove();
        });  
    });
});