let tagTab = [];

$("input[name=tag]").keydown(function(e){
    if (e.keyCode == '188') {
        showTags(e.target.value);
        tagTab.push("#"+e.target.value);
        addTagsToInput(tagTab);
        e.target.value = "";
    }
});

$("input[name=tag]").keyup(function(e){
    if (e.keyCode == '188') {
        e.target.value = "";
    }
});


$(".addPageTag").click(function(event){
    event.preventDefault();
    tagTab.push("#"+this.id);
    showTags(this.id);
    addTagsToInput(tagTab);
});

function showTags(id) {
    $("#tags").append('<div class="mb-2 w-auto tagClassDiv"><span id="'+ id +'" class="tagClassAddMemePage">#' + id + '</span><button type="button" class="btn tagDeleteBtn" onclick="deleteTag(this)"><i class="fas fa-times"></i></button></div>');
}

function addTagsToInput(tags) {
    $("#tagsAdded").val(tags);
}

function deleteTag(elem) {
    $(elem).parent('div').remove();
    let index = tagTab.indexOf($(elem).parent().find('span').attr('id'));
    tagTab.splice(index, 1);
    console.log(tagTab);
}

function test() {
    fetch('/dodawanie-mema', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: true,
            tags: tagTab
        }),
    })
    .then(function(response) {

    })
}
