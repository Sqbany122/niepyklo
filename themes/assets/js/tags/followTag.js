let apiFollowTag = "/config/API/tags/addTag.php";
let followedTag = true;

document.getElementById('btnFollowTagId').addEventListener('click', (e) => {
    e.preventDefault();
    let tagId = e.srcElement.getAttribute('data-id');

    if (isNaN(tagId)){
        fetch(apiFollowTag, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                add_tag: true,
                tag_name: tagId,
            }),
        })
        .then(response => response.json())
        .then(data => { 
            followTag(data.id);
        });
    } else {
        followTag(tagId);
    }
});

function followTag(id) {
    fetch(apiFollowTag, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            follow_tag: true,
            tag_id: id,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let followTagClassList = document.getElementById('btnFollowTagId').getAttribute('class').split(/\s+/);
        let btnTagFollow = document.getElementById('btnFollowTagId');
        followTagClassList.forEach((item, index) => {
            if (item === 'btnFollowTag') {
                btnTagFollow.classList.remove('btnFollowTag');
                btnTagFollow.classList.add('btnFollowTagFollowed');
                btnTagFollow.innerHTML = "Przestań obserwować tag - #" + data.name + ' ( ' + data.followers + ' Obserwujący )'; 
                popupTag("Obserwujesz tag <span class='followedTag'>#" + data.name + '</span>');
            } 
            
            if (item === 'btnFollowTagFollowed') {
                btnTagFollow.classList.remove('btnFollowTagFollowed');
                btnTagFollow.classList.add('btnFollowTag');
                btnTagFollow.innerHTML = "Obserwuj tag - #" + data.name + ' ( ' + data.followers + ' Obserwujący )'; 
                popupTag("Przestajesz obserwować tag <span class='followedTag'>#" + data.name + '</span>');
            }
        });
        setTimeout(destroyPopupTag, 4000);
    });
}

let popupTag = (message) => {
    $('.popup').fadeIn('slow');
    document.getElementById('popupSpan').innerHTML = message;
}

let destroyPopupTag = () => {
    $('.popup').fadeOut('slow');
}