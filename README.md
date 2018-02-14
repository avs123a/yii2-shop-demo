Yii2 advanced online shop example
Cart is fixed, adminpanel is customized, site is updated
This project use shopping cart , datepicker, wysiwyg editor , file input extensions.
View demo (DEMO NOT UPDATED BUT CODE IS CHANGED!!!)
adminpanel:
http://shopdemo2.epizy.com/demoshop2/backend/web/index.php/site/login

login : admin
password : avs03021998

site:
http://shopdemo2.epizy.com/demoshop2/frontend/web/



installing:
 - clone github repository;
 - execute command : composer install;
 - in file : common\config\main-params.php change database configuration;
 - execute command: yii migrate;
 - in common\config\bootstrap.php add frontendWebroot and backendWebroot aliases (similar to samdark ecommerce project);
 - register and in database change role for admin (role = 20)
 
 Check next folders if they exists:
  -backend\web\banners for uploading banners
  
  -frontend\web\images\brands for uploading brand logos
  -frontend\web\images\categories for uploading category images
  -frontend\web\images\products for uploading product images
 
 IF THIS FOLDERS DOESN'T EXISTS - CREATE THEM!!!
 
 Requirements:
 php >= 5.6.0
 mysql >= 5.5
 
 Notes:
  In some servers you may have an problem with modal window. So correct modal in dependence of server specifications.
  If you have this problem:
  
  login link: 
  your_domain/frontend/web/index.php/login
 
  register link: 
  your_domain/frontend/web/index.php/register
  
  logout link: 
  your_domain/demoshop2/frontend/web/
