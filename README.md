Yii2 simple online shop example
View demo
adminpanel:
http://shopdemo2.epizy.com/demoshop2/backend/web/index.php/site/login

login : admin
password : avs03021998

site:
http://shopdemo2.epizy.com/demoshop2/frontend/web/



installing:
 - clone github repository;
 - go to cd C:\ ... repository and execute command : php init;
 - execute command : composer install;
 - in file : common\config\main-params.php change database configuration;
 - execute command: yii migrate;
 - in common\config\bootstrap.php add frontendWebroot and backendWebroot aliases (similar to samdark ecommerce project);
 
 Requirements:
 php >= 5.6.0
 mysql >= 5.5
 
 Notes:
  In some servers you may have an problem with modal window. So correct modal in dependence of server specifications.
  If you have this problem:
  login link: your_domain/frontend/web/index.php/login
  register link: your_domain/frontend/web/index.php/register
  logout link: your_domain/demoshop2/frontend/web/
