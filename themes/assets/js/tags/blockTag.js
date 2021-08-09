let apiBlockTag = "/config/API/tags/blockTag.php";
let blockedTag = true;

document.getElementById('blockTag').addEventListener('click', (e) => {
    e.preventDefault();

    fetch(apiBlockTag, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            blockTag: true,
            tag_id: e.srcElement.dataset.idTag
        }),
    })
    .then(response => response.json())
    .then(data => {
        let blockedTagClassList = document.getElementById('blockTag').getAttribute('class').split(/\s+/);
        let btnTagBlock = document.getElementById('blockTag');

        blockedTagClassList.forEach((item) => {
            if (item === 'unblockedTag') {
                btnTagBlock.classList.remove('unblockedTag');
                btnTagBlock.classList.add('blockedTag');
                popupTag("Zablokowałeś tag <span class='followedTag'>#" + data + "</span>");
            } else if (item === 'blockedTag') {
                btnTagBlock.classList.remove('blockedTag');
                btnTagBlock.classList.add('unblockedTag');
                popupTag("Odblokowałeś tag <span class='followedTag'>#" + data + "</span>");
            }
        });
        setTimeout(destroyPopupTag, 4000);
    })
})