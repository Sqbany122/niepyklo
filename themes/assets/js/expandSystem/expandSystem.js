class ExpandImage {

    expandImg() {
        $('.expand').click(function() {
            let idFromClick = this.id;
            let id = idFromClick.replace(/rozwin_(.+?)/gi, '$1');
            let clicked = false;
            let expand = $("#rozwin_" + id + "");
            let expand_up = $("#rozw_" + id + "");

            var classList = expand_up.attr('class').split(/\s+/);

            $.each(classList, function(index, item) {
                if (item === 'obrazek_min') {
                    expand_up.removeClass('obrazek_min');
                }
            });

            var classList = expand.attr('class').split(/\s+/);
            $.each(classList, function(index, item) {
                if (item === 'expand') {
                    expand.addClass('display_none');
                }
            });
            
        });
    }

}