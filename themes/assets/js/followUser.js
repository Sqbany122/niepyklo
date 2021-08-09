let followApi = '/config/API/followUserAPI.php';
let followed = true;

document.getElementById('btnFollow').addEventListener("click", (e) => {
    e.preventDefault();
    fetch(followApi, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            follow: true,
            followed_user_id: e.srcElement.getAttribute('data-id'),
        }),
    })    
    .then(response => response.json())
    .then(data => {
        let followClassList = document.getElementById('btnFollow').getAttribute('class').split(/\s+/);

        followClassList.forEach((item, index) => {
            if (followed === true && item !== 'followed') {
                document.getElementById('btnFollow').innerHTML = ' Przestań obserwować';
                document.getElementById('btnFollow').classList.add('followed');
                followed = false;
            } else if (followed === false && item === 'followed') {
                document.getElementById('btnFollow').innerHTML = ' Obserwuj';
                document.getElementById('btnFollow').classList.remove('followed');
                followed = true;
            }
        });

        popup(data);
        setTimeout(destroyPopup, 4000);
    });
});

let popup = (message) => {
    $('.popup').fadeIn('slow');
    document.getElementById('popupSpan').innerHTML = message;
}

let destroyPopup = () => {
    $('.popup').fadeOut('slow');
}

