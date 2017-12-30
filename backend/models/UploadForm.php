<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	public $files;
	
	public function rules(){
		return [
		    [['files'], 'file', 'extensions' => 'jpg', 'mimeTypes' => 'image/jpeg', 'skipOnEmpty' => false],
		];
	}
	
	
}