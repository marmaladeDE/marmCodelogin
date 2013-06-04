################################
#        marmCodelogin         #
################################


Installation / Konfiguration
#########################

1) Backup von Shop und Datenbank erstellen


#####
2) Dateien/Ordner aus "copy_this" ins Shop-Verzeichnis kopieren


#####
3) Moduleinträge hinzufügen

oxcmp_user => marm/codelogin/marm_codelogin_oxcmp_user
oxuser => marm/codelogin/marm_codelogin_oxuser


#####
4) 'marm_codelogin_setup.sql' ausführen


#####
5) Anpassen der Templates

a) um die neue Loginbox aufzurufen

i) 	Basic-Theme
	in _right.tpl ändere
		[{oxid_include_dynamic file="dyn/cmp_login_right.tpl" ...}]
	zu
		[{oxid_include_dynamic file="dyn/marm_codelogin_right.tpl" ...}]
	
ii) Azure-Theme
	in header.tpl ändere 
		[{include file="widget/header/loginbox.tpl"}]
	zu
		[{include file="widget/header/marm_codelogin_loginbox.tpl"}]
			
b) oder ein eigenes Login-Template erstellen mit der neuen Funktion 'login_codelogin'
