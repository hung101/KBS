<!DOCTYPE html>
<?php

use app\models\Atlet;
use app\models\AtletSukan;
use app\models\AtletSukanSearch;

// table reference
use app\models\RefJantina;
use app\models\RefAtletTahap;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefJenisLesenMemandu;
use app\models\RefBahasa;
use app\models\RefStatusTawaran;
use app\models\UserPeranan;
use app\models\RefStatusAtlet;
use app\models\RefJenisLesenParalimpik;
use app\models\RefAgensiOku;
use app\models\RefKategoriKecacatan;
use app\models\RefPassportTempatDikeluarkan;

use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;
?>

<html>
<head>
	<title>Atlet Profil</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<style type="text/css">
		/*html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}

		html {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		caption, th, td {
			text-align: left;
			font-weight: normal;
			vertical-align: middle;
		}

		q, blockquote {
			quotes: none;
		}
		q:before, q:after, blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		a img {
			border: none;
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
			display: block;
		}

		.center {
                        text-align: center;
                }*/
                
                body {
                    font-family: Arial, Helvetica, sans-serif;
                }
                
                @page {
                    margin-top: 1cm;
                    margin-bottom: 1cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                }
                
                .wrapper{position:relative;}
                .right,.left{width:50%; position:absolute;}
                .right{right:0;}
                .left{left:0;}
                
                .title_section{
                    border:3px solid black;
                    background-color: grey;
                    color:white;
                    font-weight: bold;
                    padding-left: 5px;
                    margin-top: 10px;
                }
                
                .field_label{
                    width:49%;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .field_colon{
                    width:2%;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .field_value{
                    width:49%;
                    color:red;
                    font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .atlet_photo{
                    padding-top:5px;
                    padding-bottom:5px;
                    width:50%; 
                    padding-left: 15%
                }
                
                .field_label_2{
                    width:24.5%;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .field_colon_2{
                    width:1%;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .field_value_2{
                    width:24.5%;
                    color:red;
                    font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .field_value_col_4{
                    color:red;
                    font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                }
                
                .table_records, th.table_records_th, td.table_records_td, td.table_records_td_left{
                    border: 1px solid black;
                }
                
                .table_records{
                    margin-bottom: 5px;
                    margin-top: 5px;
                    border-collapse: collapse;
                    width: 100%;
                }
                
                th.table_records_th{
                    background-color: grey;
                    color:white;
                    font-weight: bold;
                    text-align: center;
                    font-size: x-small;
                }
                
                td.table_records_td, td.table_records_td_left, td.table_no_records_td{
                    color:red;
                    font-weight: bold;
                    font-size: x-small;
                }
                
                td.table_records_td, td.table_no_records_td{
                    text-align: center;
                }
                
                td.table_records_td_left{
                    text-align: left;
                    padding-left: 5px;
                }
                
                section {
                    page-break-inside: avoid !important;
                }

		/*body a {
			text-decoration: none;
			color: inherit;
		}
		body a:hover {
			color: inherit;
			opacity: 0.7;
		}
		body .container {
			min-width: 500px;
			margin: 0 auto;
			padding: 0 30px;
		}
		body .clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		body .left {
			float: left;
		}
		body .right {
			float: right;
		}
		body .helper {
			height: 100%;
		}

		header {
			height: 40px;
			margin-top: 20px;
			margin-bottom: 40px;
			padding: 0px 5px 0;
		}
		header figure {
			float: left;
			width: 40px;
			margin-right: 10px;
		}
		header figure img {
			height: 40px;
		}
		header .company-info {
			color: #BDB9B9;
		}
		header .company-info .title {
			margin-bottom: 5px;
			color: #2A8EAC;
			font-weight: 600;
			font-size: 2em;
		}
		header .company-info .line {
			display: inline-block;
			height: 9px;
			margin: 0 4px;
			border-left: 1px solid #2A8EAC;
		}

		section .details {
			min-width: 500px;
			margin-bottom: 40px;
			padding: 10px 35px;
			background-color: #2A8EAC;
			color: #ffffff;
		}
		section .details .client {
			width: 50%;
			line-height: 16px;
		}
		section .details .client .name {
			font-weight: 600;
		}
		section .details .data {
			width: 50%;
			text-align: right;
		}
		section .details .title {
			margin-bottom: 15px;
			font-size: 3em;
			font-weight: 400;
			text-transform: uppercase;
		}
		section .table-wrapper {
			position: relative;
			overflow: hidden;
		}
		section .table-wrapper:before {
			content: "";
			display: block;
			position: absolute;
			top: 33px;
			left: 30px;
			width: 90%;
			height: 100%;
			border-top: 2px solid #BDB9B9;
			border-left: 2px solid #BDB9B9;
			z-index: -1;
		}
		section .no-break {
			page-break-inside: avoid;
		}
		section table {
			width: 100%;
			margin-bottom: -20px;
			table-layout: fixed;
			border-collapse: separate;
			border-spacing: 5px 20px;
		}
		section table .no {
			width: 50px;
		}
		section table .desc {
			width: 55%;
		}
		section table .qty, section table .unit, section table .total {
			width: 15%;
		}
		section table tbody.head {
			vertical-align: middle;
			border-color: inherit;
		}
		section table tbody.head th {
			text-align: center;
			color: white;
			font-weight: 600;
			text-transform: uppercase;
		}
		section table tbody.head th div {
			display: inline-block;
			padding: 7px 0;
			width: 100%;
			background: #BDB9B9;
		}
		section table tbody.head th.desc div {
			width: 115px;
			margin-left: -110px;
		}
		section table tbody.body td {
			padding: 10px 5px;
			background: #F3F3F3;
			text-align: center;
		}
		section table tbody.body h3 {
			margin-bottom: 5px;
			color: #2A8EAC;
			font-weight: 600;
		}
		section table tbody.body .no {
			padding: 0px;
			background-color: #2A8EAC;
			color: #ffffff;
			font-size: 1.66666666666667em;
			font-weight: 600;
			line-height: 50px;
		}
		section table tbody.body .desc {
			padding-top: 0;
			padding-bottom: 0;
			background-color: transparent;
			color: #777787;
			text-align: left;
		}
		section table tbody.body .total {
			color: #2A8EAC;
			font-weight: 600;
		}
		section table tbody.body tr.total td {
			padding: 5px 10px;
			background-color: transparent;
			border: none;
			color: #777777;
			text-align: right;
		}
		section table tbody.body tr.total .empty {
			background: white;
		}
		section table tbody.body tr.total .total {
			font-size: 1.18181818181818em;
			font-weight: 600;
			color: #2A8EAC;
		}
		section table.grand-total {
			margin-top: 40px;
			margin-bottom: 0;
			border-collapse: collapse;
			border-spacing: 0px 0px;
			margin-bottom: 40px;
		}
		section table.grand-total tbody td {
			padding: 0 10px 10px;
			background-color: #2A8EAC;
			color: #ffffff;
			font-weight: 400;
			text-align: right;
		}
		section table.grand-total tbody td.no, section table.grand-total tbody td.desc, section table.grand-total tbody td.qty {
			background-color: transparent;
		}
		section table.grand-total tbody td.total, section table.grand-total tbody td.grand-total {
			border-right: 5px solid #ffffff;
		}
		section table.grand-total tbody td.grand-total {
			padding: 0;
			font-size: 1.16666666666667em;
			font-weight: 600;
			background-color: transparent;
		}
		section table.grand-total tbody td.grand-total div {
			float: right;
			padding: 10px 5px;
			background-color: #21BCEA;
		}
		section table.grand-total tbody td.grand-total div span {
			margin-right: 5px;
		}
		section table.grand-total tbody tr:first-child td {
			padding-top: 10px;
		}

		footer {
			margin-bottom: 20px;
			padding: 0 5px;
		}
		footer .thanks {
			margin-bottom: 40px;
			color: #2A8EAC;
			font-size: 1.16666666666667em;
			font-weight: 600;
		}
		footer .notice {
			margin-bottom: 25px;
		}
		footer .end {
			padding-top: 5px;
			border-top: 2px solid #2A8EAC;
			text-align: center;
		}*/

	</style>
</head>

<body style="margin:5px;padding:5px">
    <?php
        $modelAtlet = null;
        $no_data = GeneralLabel::tiada;
        $table_no_data = GeneralLabel::tiada_rekod; 
        
        if ($id != "" && ($modelAtlet = Atlet::findOne($id)) !== null) {
            // get atlet dropdown value's descriptions
            $ref = RefAtletTahap::findOne(['id' => $modelAtlet->tahap]);
            $modelAtlet->tahap = $ref['desc'];

            $ref = RefCawangan::findOne(['id' => $modelAtlet->cawangan]);
            $modelAtlet->cawangan = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelAtlet->tempat_lahir_bandar]);
            $modelAtlet->tempat_lahir_bandar = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelAtlet->tempat_lahir_negeri]);
            $modelAtlet->tempat_lahir_negeri = $ref['desc'];

            $ref = RefBangsa::findOne(['id' => $modelAtlet->bangsa]);
            $modelAtlet->bangsa = $ref['desc'];

            $ref = RefAgama::findOne(['id' => $modelAtlet->agama]);
            $modelAtlet->agama = $ref['desc'];

            $ref = RefJantina::findOne(['id' => $modelAtlet->jantina]);
            $modelAtlet->jantina = $ref['desc'];

            $ref = RefTarafPerkahwinan::findOne(['id' => $modelAtlet->taraf_perkahwinan]);
            $modelAtlet->taraf_perkahwinan = $ref['desc'];

            $ref = RefBahasa::findOne(['id' => $modelAtlet->bahasa_ibu]);
            $modelAtlet->bahasa_ibu = $ref['desc'];

            //$ref = RefJenisLesenMemandu::findOne(['id' => $modelAtlet->jenis_lesen]);
            //$modelAtlet->jenis_lesen = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelAtlet->alamat_rumah_negeri]);
            $modelAtlet->alamat_rumah_negeri = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelAtlet->alamat_rumah_bandar]);
            $modelAtlet->alamat_rumah_bandar = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelAtlet->alamat_surat_negeri]);
            $modelAtlet->alamat_surat_negeri = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelAtlet->alamat_surat_bandar]);
            $modelAtlet->alamat_surat_bandar = $ref['desc'];

            $YesNo = GeneralLabel::getYesNoLabel($modelAtlet->tid);
            $modelAtlet->tid = $YesNo;

            $ref = RefStatusAtlet::findOne(['id' => $modelAtlet->status_atlet]);
            $modelAtlet->status_atlet = $ref['desc'];

            $ref = RefJenisLesenParalimpik::findOne(['id' => $modelAtlet->jenis_lesen_paralimpik]);
            $modelAtlet->jenis_lesen_paralimpik = $ref['desc'];

            $ref = RefAgensiOku::findOne(['id' => $modelAtlet->agensi]);
            $modelAtlet->agensi = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelAtlet->ms_negeri]);
            $modelAtlet->ms_negeri = $ref['desc'];

            $ref = RefKategoriKecacatan::findOne(['id' => $modelAtlet->kategori_kecacatan]);
            $modelAtlet->kategori_kecacatan = $ref['desc'];

            /*$YesNo = GeneralLabel::getYesNoLabel($modelAtlet->tawaran);
            $modelAtlet->tawaran = $YesNo;*/

            $modelAtlet->tawaran_id = $modelAtlet->tawaran;
            $ref = RefStatusTawaran::findOne(['id' => $modelAtlet->tawaran]);
            $modelAtlet->tawaran = $ref['desc'];

            $ref = RefPassportTempatDikeluarkan::findOne(['id' => $modelAtlet->passport_tempat_dikeluarkan]);
            $modelAtlet->passport_tempat_dikeluarkan = $ref['desc'];

            $YesNo = GeneralLabel::getYesNoLabel($modelAtlet->cacat);
            $modelAtlet->cacat = $YesNo;
        
        
            $modelSukanProgram = AtletSukan::find()->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refProgramSemasaSukanAtlet'])
                ->joinWith(['refCawangan'])
                ->joinWith(['refSource'])
                ->joinWith(['refStatusSukanAtlet'])
                ->joinWith(['refJurulatih'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['tarikh_mula_menyertai_program_msn' => SORT_DESC,])->one();
    ?>
	<header class="clearfix">
            <div>
                <table>
                    <tr>
                        <td style="width:20%" text-align: center;>
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="200px">
                        </td>
                        <td style="width:80%; text-align: center;">
                            <h1 >MAKLUMAT DIRI ATLET</h1>
                            <h1 class="center ">MAJLIS SUKAN NEGARA MALAYSIA</h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td style="width:50%">
                            <table>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::nama?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelAtlet->name_penuh ? GeneralFunction::getUpperCaseWords($modelAtlet->name_penuh) : $no_data)?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::no_kad_pengenalan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelAtlet->ic_no ? GeneralFunction::getFormatIc($modelAtlet->ic_no) : $no_data)?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::program?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?php if(isset($modelSukanProgram['refProgramSemasaSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refProgramSemasaSukanAtlet']['desc']);} else { echo $no_data;} ?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::sukan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?php if(isset($modelSukanProgram['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refSukan']['desc']);} else { echo $no_data;} ?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::tempoh_lantikan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data)?> - <?=($modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data)?></td>
                                </tr>
                            </table>
                        </td>
                        <td class="atlet_photo">
                            <?php
                                if($modelAtlet !== null && $modelAtlet->gambar){
                                    echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$modelAtlet->gambar.'" width="200px">';
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
	</header>

        <?php if($model->maklumat_diri): ?>
	<section>
            <div id="div_maklumat-diri">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_diri)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_lahir?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tarikh_lahir ? GeneralFunction::getDatePrintFormat($modelAtlet->tarikh_lahir) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::umur?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tarikh_lahir ? GeneralFunction::ageCalculator($modelAtlet->tarikh_lahir) . ' TAHUN' : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jantina?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->jantina ? GeneralFunction::getUpperCaseWords($modelAtlet->jantina) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::agama?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->agama ? GeneralFunction::getUpperCaseWords($modelAtlet->agama) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bangsa?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->bangsa ? GeneralFunction::getUpperCaseWords($modelAtlet->bangsa) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tempat_lahir?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet->tempat_lahir_alamat_1 ? GeneralFunction::getUpperCaseWords($modelAtlet->tempat_lahir_alamat_1) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tempat_lahir_bandar ? GeneralFunction::getUpperCaseWords($modelAtlet->tempat_lahir_bandar) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tempat_lahir_negeri ? GeneralFunction::getUpperCaseWords($modelAtlet->tempat_lahir_negeri) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::taraf_perkahwinan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->taraf_perkahwinan ? GeneralFunction::getUpperCaseWords($modelAtlet->taraf_perkahwinan) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::bahasa_ibu?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->bahasa_ibu ? GeneralFunction::getUpperCaseWords($modelAtlet->bahasa_ibu) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::status_atlet?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->status_atlet ? GeneralFunction::getUpperCaseWords($modelAtlet->status_atlet) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_rumah_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet->alamat_rumah_1 ? GeneralFunction::joinAddress($modelAtlet->alamat_rumah_1, $modelAtlet->alamat_rumah_2, $modelAtlet->alamat_rumah_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_rumah_poskod ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_rumah_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_rumah_bandar ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_rumah_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_rumah_negeri ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_rumah_negeri) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_rumah_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tel_no ? GeneralFunction::getLocalPhoneFormat($modelAtlet->tel_no) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_bimbit_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tel_bimbit_no_1 ? GeneralFunction::getMobilePhoneFormat($modelAtlet->tel_bimbit_no_1) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tinggi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tinggi ? GeneralFunction::getWeightHeight($modelAtlet->tinggi) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::berat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->berat ? GeneralFunction::getWeightHeight($modelAtlet->berat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::passport_no?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->passport_no ? $modelAtlet->passport_no : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::passport_tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->passport_tamat_tempoh ? GeneralFunction::getDatePrintFormat($modelAtlet->passport_tamat_tempoh) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::lesen_memandu?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->lesen_memandu_no ? $modelAtlet->lesen_memandu_no : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->lesen_tamat_tempoh ? GeneralFunction::getDatePrintFormat($modelAtlet->lesen_tamat_tempoh) : $no_data)?></td>
                        </tr>
                        <?php
                            $jenisLesenDesc = "";
                            if($modelAtlet->jenis_lesen){
                                $jenisLesenArr = explode(",",$modelAtlet->jenis_lesen);
                                $counter = 1;
                                foreach($jenisLesenArr as $jenisLesen){
                                    if($jenisLesenDesc != ""){
                                        if(count($jenisLesenArr) == $counter){
                                            $jenisLesenDesc .= ' & ';
                                        } else {
                                            $jenisLesenDesc .= ', ';
                                        }
                                    }
                                    $ref = RefJenisLesenMemandu::findOne(['id' => $jenisLesen]);
                                    $jenisLesenDesc .= $ref['desc'];
                                    $counter++;
                                }
                            }
                        ?>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_lesen?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet->jenis_lesen ? $jenisLesenDesc : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_surat_menyurat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet->alamat_surat_menyurat_1 ? GeneralFunction::joinAddress($modelAtlet->alamat_surat_menyurat_1, $modelAtlet->alamat_surat_menyurat_2, $modelAtlet->alamat_surat_menyurat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_surat_poskod ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_surat_bandar ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->alamat_surat_negeri ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_negeri) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::emel?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->emel ? $modelAtlet->emel : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::twitter?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->twitter ? $modelAtlet->twitter : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::facebook?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=$modelAtlet->facebook?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
        <?php if($model->maklumat_perhubungan_kecemasan): ?>
        <section>
            <div id="div_maklumat-perhubungan-kecemasan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_perhubungan_kecemasan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_kecemasan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->nama_kecemasan ? GeneralFunction::getUpperCaseWords($modelAtlet->nama_kecemasan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::pertalian_kecemasan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->pertalian_kecemasan ? GeneralFunction::getUpperCaseWords($modelAtlet->pertalian_kecemasan) : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_bimbit_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tel_no_kecemasan ? GeneralFunction::getMobilePhoneFormat($modelAtlet->tel_no_kecemasan) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
        <?php if($model->maklumat_sukan_dan_program): ?>
        <section>
            <div id="div_maklumat-sukan-dan-program">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sukan_dan_program)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::program?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refProgramSemasaSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refProgramSemasaSukanAtlet']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::kumpulan_sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refCawangan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refCawangan']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refSukan']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::mod_latihan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refStatusSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refStatusSukanAtlet']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_mula_lantikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::acara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refAcara']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat_lantikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::sumber?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refSource']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refSource']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jurulatih?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelSukanProgram['refJurulatih']['nama'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refJurulatih']['nama']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kelulusan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->kelulusan ? GeneralFunction::getUpperCaseWords($modelSukanProgram->kelulusan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_kelulusan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->tarikh_kelulusan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_kelulusan) : $no_data)?> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
        <?php if($model->maklumat_acara): ?>
        <section>
            
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletSukanSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                if($modelSukanProgram->nama_sukan){
                    //filter by sukan id
                    $queryPar['AtletSukanSearch']['nama_sukan_id'] = $modelSukanProgram->nama_sukan;
                }
                
                $searchModelSukan = new AtletSukanSearch();
                $dataProviderSukan = $searchModelSukan->search($queryPar);
            ?>
            <div id="div_maklumat-acara">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_acara)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::bil?></th>
                            <th class="table_records_th" width="90%"><?=GeneralLabel::acara?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSukan->getCount() > 0){ // got records
                            foreach($dataProviderSukan->models as $Sukanmodel){
                                echo '<tr><td class="table_records_td">';
                                echo $counter;
                                echo '</td><td class="table_records_td_left">';
                                if(isset($Sukanmodel['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refAcara']['desc']); } else { echo $no_data;}
                                echo '</td></tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="2">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_sukan_dan_program): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletSukanSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelSukan = new AtletSukanSearch();
                $dataProviderSukan = $searchModelSukan->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-sukan-dan-program">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_sukan_dan_program)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::tempoh_lantikan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::program?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::kumpulan_sukan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::jurulatih?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        foreach($dataProviderSukan->models as $Sukanmodel){
                            echo '<tr>';
                            echo '<td class="table_records_td">';
                            echo ($modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data) 
                                . ' - ' . ($modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data);
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refProgramSemasaSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refProgramSemasaSukanAtlet']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refSukan']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refCawangan']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refCawangan']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refJurulatih']['nama'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refJurulatih']['nama']); } else { echo $no_data;}
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_acara): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletSukanSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                if($modelSukanProgram->nama_sukan){
                    //filter by sukan id
                    $queryPar['AtletSukanSearch']['nama_sukan_id'] = $modelSukanProgram->nama_sukan;
                }
                
                $searchModelSukan = new AtletSukanSearch();
                $dataProviderSukan = $searchModelSukan->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-acara">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_acara)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::tempoh_lantikan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::program?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::kumpulan_sukan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::acara?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        foreach($dataProviderSukan->models as $Sukanmodel){
                            echo '<tr>';
                            echo '<td class="table_records_td">';
                            echo ($modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data) 
                                . ' - ' . ($modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data);
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refProgramSemasaSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refProgramSemasaSukanAtlet']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refSukan']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refCawangan']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refCawangan']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '<td class="table_records_td">';
                            if(isset($Sukanmodel['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($Sukanmodel['refAcara']['desc']); } else { echo $no_data;}
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_sukan): ?>
        <section>
            <div id="div_maklumat-sejarah-sukan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_sukan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahun_umur_permulaan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->tahun_umur_permulaan ? $modelSukanProgram->tahun_umur_permulaan : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::negeri_diwakili?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_lesen_sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->no_lesen_sukan ? $modelSukanProgram->no_lesen_sukan : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::id_atlet_persekutuan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->atlet_persekutuan_dunia_id ? $modelSukanProgram->atlet_persekutuan_dunia_id : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>

	<footer>
		<!--<div class="container">
			<div class="thanks">Thank you!</div>
			<div class="notice">
				<div>NOTICE:</div>
				<div>A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
			</div>
			<div class="end">Invoice was created on a computer and is valid without the signature and seal.</div>
		</div>-->
	</footer>
    
        <?php } ?>

</body>

</html>
