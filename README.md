# Codiad BackupPlugin
Codiad Plugin to create zip files to backup a codiad project on the web editor </br>

**Install**

1.Clone or Download this plugin and left the BackupPlugin directory inside the codiad/plugins directory.

2.You will need to create a directory with read write permisions , not only with chmod else using selinux command semanage to let Apache write on a directory you specify for example /home/backup/, you will have to:</br></br>


#semanage fcontext -a -t httpd_sys_rw_content_t "/home/backup(/.*)?"</br>
#restorecon -R -v /home/backup</br></br></br>

**How to use it**

1. On the menu that appears at right hand, there is a section for Plugins, look for Backup Plugin and do a click on this option.

2. Then a dialog box will be shown,  just fill in the "Backup Absolute Path" with the full absolute path to the directory with read write permissions you defined in the step 2 of install section.

3. Finally just do a click on "Create Backup" button

What will happen is that Backup Plugin will create a zip file under the directory you specified with the followin format: 

YYYY-MM-DD_user_projectName.zip

Where user is the current user logged and projectName is the current Codiad project.




