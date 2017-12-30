<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class SiteSettings extends Model
{
	public static function getMainBannerPath()
	{
		return Yii::getAlias('@backend/web/banners/mainbanner.jpg');
	}
	
	public static function getMainBannerUrl()
	{
		return Yii::getAlias('@backendWebroot/banners/mainbanner.jpg');
	}
	
	public static function deleteMainBanner()
	{
	    unlink(getMainBannerPath());
		Yii::$app->session->addFlash('success', 'You deleted main banner');
	}
	
	
	
}