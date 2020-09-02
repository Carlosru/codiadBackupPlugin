<?php

    /*
    *  Copyright (c) Codiad & daeks & Coulee Techlink, distributed
    *  as-is and without warranty under the MIT License. See
    *  [root]/license.txt for more. This information must remain intact.
    */


    require_once('../../common.php');
    require_once('class.backup.php');

    //////////////////////////////////////////////////////////////////
    // Verify Session or Key
    //////////////////////////////////////////////////////////////////

    checkSession();

    $backup = new Backup();

    //////////////////////////////////////////////////////////////////
    // Pull Repo
    //////////////////////////////////////////////////////////////////

    if($_GET['action']=='commit'){
        $user = $_SESSION['user'];
        $project =  basename($_SESSION['project']);
        $backup->path = $_GET['path'].date('Y-m-d_H-i-s')."_".$user."_".$project.".zip";   
        $backup->root = $_GET['root'];
        $backup->commit();
    }
   
?>
