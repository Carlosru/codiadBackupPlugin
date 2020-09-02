<?php

    /*
    *  Copyright (c) Codiad & daeks & Coulee Techlink, distributed
    *  as-is and without warranty under the MIT License. See 
    *  [root]/license.txt for more. This information must remain intact.
    */

    require_once('../../common.php');
    
    //////////////////////////////////////////////////////////////////
    // Verify Session or Key
    //////////////////////////////////////////////////////////////////
    
    checkSession();

    switch($_GET['action']){
            
        //////////////////////////////////////////////////////////////////////
        // Commit to Repo
        //////////////////////////////////////////////////////////////////////
        
        case 'commit':
            
        
            ?>
   <form>                                                                                                                                      <label>Backup Absolute Path</label>                                                                                                            <input name="path" autofocus="autofocus" autocomplete="on">        
<br />
                                                                    <!-- Clone From svnHub -->                                                                                                                 <div class="note">Your bakup will be stored in a file named Codiad plus timestamp, example codiad2020-08-29_08-01-10.zip on the directory you indicate in the path field.                                                                                       </div>                                                                                                                                    <!-- /Commit locally -->                                                                                                                  <button class="btn-left">Create Backup</button><button class="btn-right" onclick="codiad.modal.unload();return false;">Cancel</button>                                                                                                                                                    <form>                 



<?php
            break;
            
    }
    
?>
