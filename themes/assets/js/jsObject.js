let jsObject = {
    fetchData: function(fetchUrl, fetchData, fetchFunction = false, fetchFunctionData) {
        fetch(fetchUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(fetchData),
          })
          .then(response => response.json())
          .then(data => {
            if (fetchFunction) {
                if (fetchFunctionData.changePlusValue === true) {
                    if (data.status == 1) {
                        fetchFunctionData.button.innerHTML = data.plus_count;
                        if (fetchFunctionData.button.classList.contains("plusBtn-clicked")) {
                            fetchFunctionData.button.classList.remove("plusBtn-clicked");
                        } else {
                            fetchFunctionData.button.classList.add("plusBtn-clicked");
                        }
                    } else {
                        this.showPopup(data.info);
                        setTimeout(this.hidePopup, 5000);
                    }
                }
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });
    },
    imageHandleClick: function(e) {
        let memeInfoBox = e.target.closest(".imageBox").querySelector(".memeInfoBox");
        if (memeInfoBox.classList.contains("_visible_hidden")) {
            memeInfoBox.classList.remove("_visible_hidden");
        } else {
            memeInfoBox.classList.add("_visible_hidden");
        }
    },
    hideMemeInfo: function(e) {
        if (e.target.classList.contains("memeInfoBox")) {
            e.target.classList.add("_visible_hidden");
        }
    },
    addPlus: function(e, meme_id) {
        let clicked = false;
        let button = e.target;

        if (button.classList.contains("plusBtn-clicked")) {
            clicked = true;
        }

        if (clicked === false){
            data = {
                id: meme_id,
                type: 'increment', 
            }
            fetchFunctionData = {
                changePlusValue: true,
                button: button
            }
            this.fetchData("/config/API/plus.php", data, true, fetchFunctionData);
        } else {
            data = {
                id: meme_id,
                type: 'decrement', 
            }
            fetchFunctionData = {
                changePlusValue: true,
                button: button
            }
            this.fetchData("/config/API/plus.php", data, true, fetchFunctionData);
        }
    },
    showPopup: function(data) {
        document.querySelector(".infoPopup").classList.remove("_visible_hidden");
        document.querySelector(".infoPopup").innerHTML = data
    },
    hidePopup: function() {
        document.querySelector(".infoPopup").classList.add("_visible_hidden");
    },
}