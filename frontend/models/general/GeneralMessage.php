<?php
namespace app\models\general;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$session = Yii::$app->getSession();

if($session->get('language') == "BM" || $session->get('language') == null || $session->get('language') == "") {

	class GeneralMessage{
	    const confirmDelete = "Adakah anda pasti anda mahu memadam item ini?";
	    const confirmRemove = "Adakah anda pasti mahu mengeluarkan?";
	    const uploadEmptyError = "Sila muat naik fail";
	    const selamat_datang = "Selamat Datang";
	    const sistem_pengurusan_sukan_bersepadu = "SISTEM PENGURUSAN SUKAN BERSEPADU";
            
            // yii validation general message BM
            const yii_validation_required = "{attribute} tidak boleh dikosongkan";
            const yii_validation_integer = "{attribute} mesti integer";
            const yii_validation_email = "{attribute} bukan alamat e-mel yang sah";
            const yii_validation_string_max = "{attribute} perlu mengandungi paling banyak {max} aksara";
            const yii_validation_string_min = "{attribute} tidak seharusnya mengandungi sekurang-kurangnya {min} aksara";
	}
}

if($session->get('language') == "EN") {

	class GeneralMessage{
	    const confirmDelete = "Are you sure you want to delete this item?";
	    const confirmRemove = "Are you sure you want to remove?";
	    const uploadEmptyError = "Please upload a file";
	    const selamat_datang = "Welcome";
	    const sistem_pengurusan_sukan_bersepadu = "INTEGRATED SPORTS MANAGEMENT SYSTEM";
            
            // yii validation general message BM
            const yii_validation_required = "{attribute} cannot be blank";
            const yii_validation_integer = "{attribute} must be an integer";
            const yii_validation_email = "{attribute} is not a valid email address";
            const yii_validation_string_max = "{attribute} should contain at most {max} characters";
            const yii_validation_string_min = "{attribute} should not contain at least {min} characters";
	}

}