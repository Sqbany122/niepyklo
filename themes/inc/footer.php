    <div class="infoPopup rounded py-3 px-4 _visible_hidden">
        
    </div>
    
    <div class="modal fade" id="reportMemeModal" tabindex="-1" role="dialog" aria-labelledby="reportMemeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zgłoś mema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Wybierz powód zgłoszenia:</h5>
                <ul class="listaZgloszenia">
                    <li>
                        <input type="radio" id="powod1" name="powod[reason]" />
                        <label for="powod1">Pornografia</label>
                    </li>
                    <li>
                        <input type="radio" id="powod2" name="powod[reason]" />
                        <label for="powod2">Spam</label>
                    </li>
                    <li>
                        <input type="radio" id="powod3" name="powod[reason]" />
                        <label for="powod3">Wykorzystanie danych osobistych</label>
                    </li>
                    <li>
                        <input type="radio" id="powod4" name="powod[reason]" />
                        <label for="powod4">Naruszenie zasad regulaminu</label>
                    </li>
                    <li>
                        <input type="radio" id="powod5" name="powod[reason]" />
                        <label for="powod5">Niepoprawne tagi</label>
                    </li>
                    <li>
                        <input type="radio" id="powod5" name="powod[reason]" />
                        <label for="powod6">Inny</label>
                    </li>
                </ul>
                <div class="form-group">
                    <label for="powodDescription">Opisz powód zgłoszenia:</label>
                    <textarea class="form-control rounded-0" id="powodDescription"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btnSendReport rounded-0">Zgłoś</button>
            </div>
            </div>
        </div>
    </div>

    <div class="popup">
        <span id="popupSpan"></span>
    </div>
    
    <script>
        let expandImage = new ExpandImage();
        expandImage.expandImg();

        let expandAdultImage = new ExpandAdultImage();
        expandAdultImage.expandAdultImg();

    </script>

    <script type="text/javascript" src="themes/assets/js/addMemePage/addMeme.js"></script>
    <script type="text/javascript" src="themes/assets/js/main.js"></script>
    <script type="text/javascript" src="themes/assets/js/access/access.js"></script>
    <script type="text/javascript" src="themes/assets/js/right-menu-scroll.js"></script>
    <script type="text/javascript" src="themes/assets/js/tags/tagInfo.js"></script>
    <script type="text/javascript" src="themes/assets/js/jsObject.js"></script>
    <?php if (strstr($_SERVER['REQUEST_URI'],'profil')) { ?>
        <script type="text/javascript" src="themes/assets/js/followUser.js"></script>
    <?php } elseif (strstr($_SERVER['REQUEST_URI'],'/tag')) { ?>
        <script type="text/javascript" src="themes/assets/js/tags/followTag.js"></script>
        <script type="text/javascript" src="themes/assets/js/tags/blockTag.js"></script>
    <?php } ?>
    <script type="text/javascript" src="themes/assets/js/reportMeme.js"></script>
    <!-- <script src="themes/assets/js/scroll_top.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
