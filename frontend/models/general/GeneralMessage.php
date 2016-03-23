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
	}
}

if($session->get('language') == "EN") {

	class GeneralMessage{
	    const confirmDelete = "Are you sure you want to delete this item?";
	    const confirmRemove = "Are you sure you want to remove?";
	    const uploadEmptyError = "Please upload a file";
	    const selamat_datang = "Welcome";
	    const sistem_pengurusan_sukan_bersepadu = "INTEGRATED SPORTS MANAGEMENT SYSTEM";
	}

}