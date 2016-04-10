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
            const yii_validation_integer_max = "{attribute} mestilah tidak lebih besar daripada {max}";
            const yii_validation_integer_min = "{attribute} mestilah tidak kurang daripada {min}";
            const yii_validation_number = "{attribute} mesti nombor";
            const yii_validation_email = "{attribute} bukan alamat e-mel yang sah";
            const yii_validation_string_max = "{attribute} perlu mengandungi paling banyak {max} aksara";
            const yii_validation_string_min = "{attribute} mesti mengandungi sekurang-kurangnya {min} aksara";
            const yii_validation_unique = '{attribute} "{value}" telah diambil';
            const yii_validation_compare = '{attribute} mesti lebih besar daripada atau sama dengan "{compareAttribute}"';
            
            // custom validation general message BM
            const custom_validation_password_equal = "Kata laluan tidak sepadan";
            const custom_validation_nyatakan_oku_lain = "Sila nyatakan OKU Lain-lain";
	}
}

if($session->get('language') == "EN") {

	class GeneralMessage{
	    const confirmDelete = "Are you sure you want to delete this item?";
	    const confirmRemove = "Are you sure you want to remove?";
	    const uploadEmptyError = "Please upload a file";
	    const selamat_datang = "Welcome";
	    const sistem_pengurusan_sukan_bersepadu = "INTEGRATED SPORTS MANAGEMENT SYSTEM";
            
            // yii validation general message EN
            const yii_validation_required = "{attribute} cannot be blank";
            const yii_validation_integer = "{attribute} must be an integer";
            const yii_validation_integer_max = "{attribute} must be no greater than {max}";
            const yii_validation_integer_min = "{attribute} mmust be no less than {min}";
            const yii_validation_number = "{attribute} must be a number";
            const yii_validation_email = "{attribute} is not a valid email address";
            const yii_validation_string_max = "{attribute} should contain at most {max} characters";
            const yii_validation_string_min = "{attribute} should not contain at least {min} characters";
            const yii_validation_unique = '{attribute} "{value}" has already been taken';
            const yii_validation_compare = '{attribute} must be greater than or equal to "{compareAttribute}"';
            
            // custom validation general message EN
            const custom_validation_password_equal = "Password do not match";
            const custom_validation_nyatakan_oku_lain = "Please describe other disability";
	}

}