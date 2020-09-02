/*
 *  Copyright (c) Codiad & daeks & Coulee Techlink, distributed
 *  as-is and without warranty under the MIT License. See
 *  [root]/license.txt for more. This information must remain intact.
 */

(function(global, $){

    var codiad = global.codiad,
        scripts = document.getElementsByTagName('script'),
        path = scripts[scripts.length-1].src.split('?')[0],
        curpath = path.split('/').slice(0, -1).join('/')+'/';

    $(function() {
        codiad.backup.init();
    });

    codiad.backup = {
        
        controller: curpath + 'controller.php',
        dialog: curpath + 'dialog.php',

        init: function() {
        },
        commit: function() {
            var _this = this;
            codiad.modal.load(550, _this.dialog + '?action=commit');
            $('#modal-content form').live('submit', function(e) {
                   e.preventDefault();
                   var path =  $('#modal-content form input[name="path"]').val();
                   var root = codiad.project.getCurrent(); 
                   
                    $('#modal-content').html('<div id="modal-loading"></div><div align="center">Trying to create a backup...</div><br>');
                    $.get(_this.controller + '?' + $.param({'action': 'commit', 'path': path,'root':root})  , function(data) {
                        createResponse = codiad.jsend.parse(data);
                        if (createResponse != 'error') {
                            codiad.message.success(createResponse.message);
                            codiad.filemanager.rescan(root);
                        } else {
                            codiad.message.error(createResponse.message);
                        }
                        codiad.modal.unload();
                    });
            });
        }
    };

})(this, jQuery);
