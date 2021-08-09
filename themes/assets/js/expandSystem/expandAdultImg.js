class ExpandAdultImage {

    expandAdultImg() {
        $('.adult_img').click(function() {
            let idFromClick = this.id;
            let id = idFromClick.replace(/adult_(.+?)/gi, '$1');
            let clicked = false;
            var adult = $("#adult_" + id + "");
		    var img = $("#img_" + id + "");

            var classList = adult.attr('class').split(/\s+/);
                $.each(classList, function(index, item) {
                    if (item === 'adult_img') {
                        adult.addClass('hide');
                    }
                });

                var classList = img.attr('class').split(/\s+/);
                $.each(classList, function(index, item) {
                    if (item === 'adult_behind') {
                        img.removeClass('adult_behind');
                    }
            });
            
        });
    }

}