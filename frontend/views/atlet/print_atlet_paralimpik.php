<!DOCTYPE html>
<?php

use app\models\Atlet;
use app\models\AtletSukan;
use app\models\AtletSukanSearch;
use app\models\AtletKewanganAkaun;
use app\models\AtletKewanganElaun;
use app\models\AtletKewanganElaunSearch;
use frontend\models\AtletKeluargaSearch;
use app\models\AtletPakaianSearch;
use app\models\AtletPakaianPeralatanSearch;
use app\models\AtletPendidikan;
use app\models\AtletPendidikanSearch;
use app\models\AtletKarier;
use app\models\AtletKarierSearch;
use app\models\AtletPembangunanKursuskem;
use app\models\AtletPembangunanKursuskemSearch;
use app\models\AtletPembangunanKaunseling;
use app\models\AtletPembangunanKaunselingSearch;
use app\models\AtletPembangunanKemahiran;
use app\models\AtletPembangunanKemahiranSearch;
use app\models\AtletPerubatan;
use app\models\AtletPerubatanInsurans;
use app\models\AtletPerubatanDonator;
use frontend\models\SixStepSearch;
use frontend\models\SixStepBiomekanikSearch;
use frontend\models\SixStepFisiologiSearch;
use frontend\models\SixStepPsikologiSearch;
use frontend\models\SixStepSatelitSearch;
use frontend\models\SixStepSuaianFizikalSearch;
use frontend\models\PlTemujanjiSearch;
use app\models\AtletKewanganInsentif;
use app\models\AtletKewanganInsentifSearch;
use app\models\AtletPenajaansokongan;
use app\models\PermohonanBiasiswa;
use frontend\models\PermohonanEBiasiswaSearch;
use frontend\models\PermohonanBiasiswaSearch;
use app\models\AtletSukanPersatuanpersekutuandunia;
use app\models\AtletPencapaianAnugerah;
use app\models\AtletPencapaian;
use app\models\AtletPencapaianRekods;
use frontend\models\AtletPencapaianRekodsSearch;

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
use app\models\RefJenisElaun;

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
                    margin-top: 8.1cm;
                    margin-bottom: 1cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                    margin-header: 1cm;
                    header: html_MyCustomHeader; /* Displays on all pages of the PDF */
                }
                
                /* Overrides the @page header and displays on the first page of the PDF */
                /*@page :first {
                    header: html_MyCustomHeader; 
                }*/
                
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
                
                .title_section_sub{
                    border:1px solid black;
                    background-color: grey;
                    color:white;
                    font-weight: bold;
                    font-size: 12px;
                    padding-left: 5px;
                    margin-top: 5px;
                }
                
                .field_label{
                    width:32%;
                    padding-top:2px;
                    padding-bottom:2px;
                    vertical-align: top;
                }
                
                .field_colon{
                    width:2%;
                    padding-top:2px;
                    padding-bottom:2px;
                    vertical-align: top;
                }
                
                .field_value{
                    width:66%;
                    color:red;
                    font-weight: bold;
                    padding-top:2px;
                    padding-bottom:2px;
                    vertical-align: top;
                }
                
                .atlet_photo{
                    padding-top:1px;
                    padding-bottom:1px; 
                    //padding-left: 10%;
                    
                }
                
                .field_label_2{
                    width:24.5%;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
                }
                
                .field_colon_2{
                    width:1%;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
                }
                
                .field_value_2{
                    width:24.5%;
                    color:red;
                    font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
                }
                
                .field_value_col_4{
                    color:red;
                    font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
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
	<htmlpageheader name="MyCustomHeader">
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
            <div style="border-bottom: 3px solid;">
                <table style="width:100%">
                    <tr>
                        <td style="width:75%">
                            <table style="width:100%">
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
                        <td class="atlet_photo" style="width:25%;  text-align: center;">
                            <?php
                                if($modelAtlet !== null && $modelAtlet->gambar){
                                    echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$modelAtlet->gambar.'" height="125px">';
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
	</htmlpageheader>

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
                            <td class="field_value_2"><?=($modelAtlet->tel_no ? GeneralFunction::getPhoneFormat($modelAtlet->tel_no) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_bimbit_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tel_bimbit_no_1 ? GeneralFunction::getPhoneFormat($modelAtlet->tel_bimbit_no_1) : $no_data)?></td>
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
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet && $modelAtlet->jenis_lesen ? $jenisLesenDesc : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_surat_menyurat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAtlet && $modelAtlet->alamat_surat_menyurat_1 ? GeneralFunction::joinAddress($modelAtlet->alamat_surat_menyurat_1, $modelAtlet->alamat_surat_menyurat_2, $modelAtlet->alamat_surat_menyurat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet && $modelAtlet->alamat_surat_poskod ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet && $modelAtlet->alamat_surat_bandar ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet && $modelAtlet->alamat_surat_negeri ? GeneralFunction::getUpperCaseWords($modelAtlet->alamat_surat_negeri) : $no_data)?></td>
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
                            <td class="field_value_2"><?=($modelAtlet->tel_no_kecemasan ? GeneralFunction::getPhoneFormat($modelAtlet->tel_no_kecemasan) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if($model->maklumat_oku): ?>
        <section>
            <div id="div_maklumat-oku">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_oku)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kategori_kecacatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->kategori_kecacatan ? GeneralFunction::getUpperCaseWords($modelAtlet->kategori_kecacatan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::jenis_kecederaan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->jenis_kecederaan ? GeneralFunction::getUpperCaseWords($modelAtlet->jenis_kecederaan) : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_lesen?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->jenis_lesen_paralimpik ? GeneralFunction::getUpperCaseWords($modelAtlet->jenis_lesen_paralimpik) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_lesen_ipc?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->no_lesen_ipc ? $modelAtlet->no_lesen_ipc : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tarikh_luput ? GeneralFunction::getDatePrintFormat($modelAtlet->tarikh_luput) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::agensi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->agensi ? GeneralFunction::getUpperCaseWords($modelAtlet->agensi) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::ms_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->ms_negeri ? GeneralFunction::getUpperCaseWords($modelAtlet->ms_negeri) : $no_data)?></td>
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
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::acara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refAcara']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat_lantikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data)?></td>
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
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->kelulusan ? GeneralFunction::getUpperCaseWords($modelSukanProgram->kelulusan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_kelulusan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tarikh_kelulusan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_kelulusan) : $no_data)?> </td>
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
                        
                        if($dataProviderSukan->getCount() > 0){ // got records
                            foreach($dataProviderSukan->models as $Sukanmodel){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelSukanProgram && $modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data) 
                                    . ' - ' . ($modelSukanProgram && $modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data);
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
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="5">';
                            echo $table_no_data;
                            echo '</td></tr>';
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
                        
                        if($dataProviderSukan->getCount() > 0){ // got records
                            foreach($dataProviderSukan->models as $Sukanmodel){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelSukanProgram && $modelSukanProgram->tarikh_mula_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_menyertai_program_msn) : $no_data) 
                                    . ' - ' . ($modelSukanProgram && $modelSukanProgram->tarikh_tamat_menyertai_program_msn ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_menyertai_program_msn) : $no_data);
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
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="5">';
                            echo $table_no_data;
                            echo '</td></tr>';
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
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tahun_umur_permulaan ? $modelSukanProgram->tahun_umur_permulaan : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::negeri_diwakili?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_lesen_sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->no_lesen_sukan ? $modelSukanProgram->no_lesen_sukan : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::id_atlet_persekutuan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram->atlet_persekutuan_dunia_id ? $modelSukanProgram->atlet_persekutuan_dunia_id : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_kewangan): ?>
        <?php
            $modelKewanganAkaun = AtletKewanganAkaun::find()->joinWith(['refBank'])
                ->joinWith(['refJenisBankAkaun'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
    
        <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletKewanganElaunSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKewanganElaun = new AtletKewanganElaunSearch();
                $dataProviderKewanganElaun = $searchModelKewanganElaun->search($queryPar);
                
                $elaun_latihan = '0.00';
                $elaun_makan = '0.00';
                $elaun_kehilangan_pendapatan = '0.00';
                $elaun_pengangkutan = '0.00';
                $elaun_penginapan_rumah = '0.00';
                $elaun_siso = '0.00';
                $elaun_sito = '0.00';
                
                if($dataProviderKewanganElaun->getCount() > 0){ // got records
                    foreach($dataProviderKewanganElaun->models as $KewanganElaunmodel){
                        switch($KewanganElaunmodel->jenis_elaun){
                            case RefJenisElaun::MAKAN:
                                $elaun_makan += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::LATIHAN:
                                $elaun_latihan += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::KEHILANGAN_PENDAPATAN:
                                $elaun_kehilangan_pendapatan += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::PENGINAPAN_RUMAH:
                                $elaun_penginapan_rumah += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::PENGANGKUTAN:
                                $elaun_pengangkutan += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::SISO:
                                $elaun_siso += $KewanganElaunmodel->jumlah_elaun;
                                break;
                            case RefJenisElaun::SITO:
                                $elaun_sito += $KewanganElaunmodel->jumlah_elaun;
                                break;
                        }
                    }
                } 
            ?>
        <section>
            <div id="div_maklumat-sejarah-sukan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kewangan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_bank?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelKewanganAkaun['refBank']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKewanganAkaun['refBank']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::cawangan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKewanganAkaun && $modelKewanganAkaun->cawangan? GeneralFunction::getUpperCaseWords($modelKewanganAkaun->cawangan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_akaun?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelKewanganAkaun['refJenisBankAkaun']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKewanganAkaun['refJenisBankAkaun']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_akaun?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKewanganAkaun && $modelKewanganAkaun->no_akaun ? $modelKewanganAkaun->no_akaun : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::elaun_latihan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_latihan)?></td>
                            <td class="field_label_2"><?=GeneralLabel::elaun_makan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_makan)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::elaun_kehilangan_pendapatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_kehilangan_pendapatan)?></td>
                            <td class="field_label_2"><?=GeneralLabel::elaun_pengangkutan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_pengangkutan)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::elaun_penginapan_rumah?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_penginapan_rumah)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::elaun_siso?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_siso)?></td>
                            <td class="field_label_2"><?=GeneralLabel::elaun_sito?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=GeneralFunction::getNumberFormatPrint($elaun_sito)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_elaun_atlet): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletKewanganElaunSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKewanganElaun = new AtletKewanganElaunSearch();
                $dataProviderKewanganElaun = $searchModelKewanganElaun->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-elaun-atlet">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_elaun_atlet)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::jenis_elaun?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::jumlah?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::tarikh_mula?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::tarikh_tamat?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::bil_jkb?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::tarikh_jkb?></th>
                            <th class="table_records_th" width="16.67%"><?=GeneralLabel::tarikh_kelulusan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKewanganElaun->getCount() > 0){ // got records
                            foreach($dataProviderKewanganElaun->models as $KewanganElaunmodel){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($KewanganElaunmodel['refJenisElaun']['desc'])){echo GeneralFunction::getUpperCaseWords($KewanganElaunmodel['refJenisElaun']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->jumlah_elaun ? $KewanganElaunmodel->jumlah_elaun : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->tarikh_mula ? GeneralFunction::getDatePrintFormat($KewanganElaunmodel->tarikh_mula) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->tarikh_tamat ? GeneralFunction::getDatePrintFormat($KewanganElaunmodel->tarikh_tamat) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->kelulusan ? $KewanganElaunmodel->kelulusan : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->tarikh_jkb ? GeneralFunction::getDatePrintFormat($KewanganElaunmodel->tarikh_jkb) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($KewanganElaunmodel && $KewanganElaunmodel->tarikh_kelulusan ? GeneralFunction::getDatePrintFormat($KewanganElaunmodel->tarikh_kelulusan) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_keluarga): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletKeluargaSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKeluarga = new AtletKeluargaSearch();
                $dataProviderKeluarga = $searchModelKeluarga->search($queryPar);
            ?>
            <div id="div_maklumat-keluarga">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_keluarga_form)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::hubungan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::nama?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::no_kp?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::pekerjaan?></th>
                            <th class="table_records_th" width="20%"><?=GeneralLabel::no_telefon?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKeluarga->getCount() > 0){ // got records
                            foreach($dataProviderKeluarga->models as $Keluargamodel){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($Keluargamodel['refHubungan']['desc'])){echo GeneralFunction::getUpperCaseWords($Keluargamodel['refHubungan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($Keluargamodel && $Keluargamodel->nama ? GeneralFunction::getUpperCaseWords($Keluargamodel->nama) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($Keluargamodel && $Keluargamodel->no_kad_pengenalan ? GeneralFunction::getFormatIc($Keluargamodel->no_kad_pengenalan) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($Keluargamodel && $Keluargamodel->pekerjaan ? GeneralFunction::getUpperCaseWords($Keluargamodel->pekerjaan) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($Keluargamodel && $Keluargamodel->no_tel ? GeneralFunction::getPhoneFormat($Keluargamodel->no_tel) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="5">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_pakaian): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPakaianSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelPakaian = new AtletPakaianSearch();
                $dataProviderPakaian = $searchModelPakaian->search($queryPar);
            ?>
            <div id="div_maklumat-pakaian">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_pakaian)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenis_pakaian?></th>
                            <th class="table_records_th" ><?=GeneralLabel::saiz?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenama?></th>
                            <th class="table_records_th" ><?=GeneralLabel::kuantiti?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tarikh_serahan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPakaian->getCount() > 0){ // got records
                            foreach($dataProviderPakaian->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSukan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisPakaian']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisPakaian']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSaizPakaian']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSaizPakaian']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->jenama ? GeneralFunction::getUpperCaseWords($modelLoop->jenama) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->kuantiti ? $modelLoop->kuantiti : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_serahan ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_serahan) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_peralatan_sukan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPakaianPeralatanSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelPeralatan = new AtletPakaianPeralatanSearch();
                $dataProviderPeralatan = $searchModelPeralatan->search($queryPar);
            ?>
            <div id="div_maklumat-peralatan-sukan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_peralatan_sukan)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::nama_peralatan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::saiz?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenama?></th>
                            <th class="table_records_th" ><?=GeneralLabel::warna?></th>
                            <th class="table_records_th" ><?=GeneralLabel::model?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tarikh_serahan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPeralatan->getCount() > 0){ // got records
                            foreach($dataProviderPeralatan->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSukan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->peralatan ? GeneralFunction::getUpperCaseWords($modelLoop->peralatan) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->saiz ? GeneralFunction::getUpperCaseWords($modelLoop->saiz) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->jenama ? GeneralFunction::getUpperCaseWords($modelLoop->jenama) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->warna ? GeneralFunction::getUpperCaseWords($modelLoop->warna) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->model ? $modelLoop->model : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_serahan ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_serahan) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="7">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_pendidikan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPendidikanSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelPendidikan = new AtletPendidikanSearch();
                $dataProviderPendidikan = $searchModelPendidikan->search($queryPar);
            ?>
            <div id="div_maklumat-pendidikan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_pendidikan)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahap_akademik?></th>
                            <th class="table_records_th" ><?=GeneralLabel::pencapaian?></th>
                            <th class="table_records_th" ><?=GeneralLabel::institusi_sekolah?></th>
                            <th class="table_records_th" ><?=GeneralLabel::alamat_1?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_tamat?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPendidikan->getCount() > 0){ // got records
                            foreach($dataProviderPendidikan->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisPencapaian']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisPencapaian']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->keputusan_cgpa ? GeneralFunction::getUpperCaseWords($modelLoop->keputusan_cgpa) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->nama ? GeneralFunction::getUpperCaseWords($modelLoop->nama) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->alamat_1 ? GeneralFunction::getUpperCaseWords($modelLoop->alamat_1 . ' ' . $modelLoop->alamat_2 . ' ' . $modelLoop->alamat_3 
                                        . ', ' . $modelLoop['refBandar']['desc'] . ', ' . $modelLoop->alamat_poskod . ' ' . $modelLoop['refNegeri']['desc']) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun_mula ? date("Y", strtotime($modelLoop->tahun_mula)) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun_tamat ? date("Y", strtotime($modelLoop->tahun_tamat)) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sekolah_institusi_semasa): ?>
        <?php
            $modelPendidikan = AtletPendidikan::find()
                ->joinWith(['tahapPendidikan'])
                ->joinWith(['refJenisPencapaian'])
                ->joinWith(['refNegeri'])
                ->joinWith(['refBandar'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-sekolah-institusi-semasa">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sekolah_institusi_semasa)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahap_pendidikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPendidikan['tahapPendidikan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPendidikan['tahapPendidikan']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_sekolah_institusi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPendidikan && $modelPendidikan->nama ? GeneralFunction::getUpperCaseWords($modelPendidikan->nama) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kursus?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->kursus ? GeneralFunction::getUpperCaseWords($modelPendidikan->kursus) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::falkulti?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->fakulti ? GeneralFunction::getUpperCaseWords($modelPendidikan->fakulti) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPendidikan && $modelPendidikan->alamat_1 ? GeneralFunction::getUpperCaseWords($modelPendidikan->alamat_1 . ' ' . $modelPendidikan->alamat_2 . ' ' . $modelPendidikan->alamat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->alamat_poskod ? GeneralFunction::getUpperCaseWords($modelPendidikan->alamat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alamat_bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPendidikan['refBandar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPendidikan['refBandar']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPendidikan['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPendidikan['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->no_telefon ? GeneralFunction::getPhoneFormat($modelPendidikan->no_telefon) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_faks?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->no_faks ? GeneralFunction::getPhoneFormat($modelPendidikan->no_faks) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahun_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->tahun_mula ? date("Y", strtotime($modelPendidikan->tahun_mula))  : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tahun_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPendidikan && $modelPendidikan->tahun_tamat ? date("Y", strtotime($modelPendidikan->tahun_tamat)) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_kerjaya_semasa): ?>
        <?php
            $modelKerjaya = AtletKarier::find()
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-kerjaya-semasa">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kerjaya_semasa)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jawatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->jawatan_kerja ? GeneralFunction::getUpperCaseWords($modelKerjaya->jawatan_kerja) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::majikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->syarikat ? GeneralFunction::getUpperCaseWords($modelKerjaya->syarikat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_majikan_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKerjaya && $modelKerjaya->alamat_1 ? GeneralFunction::getUpperCaseWords($modelKerjaya->alamat_1 . ' ' . $modelKerjaya->alamat_2 . ' ' . $modelKerjaya->alamat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->alamat_poskod ? GeneralFunction::getUpperCaseWords($modelKerjaya->alamat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alamat_bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelKerjaya['refBandar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKerjaya['refBandar']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelKerjaya['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKerjaya['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::laman_web?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKerjaya && $modelKerjaya->laman_web ? $modelKerjaya->laman_web : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->tel_no ? GeneralFunction::getPhoneFormat($modelKerjaya->tel_no) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_faks?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->faks_no ? GeneralFunction::getPhoneFormat($modelKerjaya->faks_no) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::pendapatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->pendapatan ? GeneralFunction::getNumberFormatPrint($modelKerjaya->pendapatan) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahun_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->tahun_mula ? date("Y", strtotime($modelKerjaya->tahun_mula))  : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tahun_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->tahun_tamat ? date("Y", strtotime($modelKerjaya->tahun_tamat)) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::socso_no?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->socso_no ? $modelKerjaya->socso_no : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::kwsp_no?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->kwsp_no ? $modelKerjaya->kwsp_no : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::income_tax_no?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKerjaya && $modelKerjaya->income_tax_no ? $modelKerjaya->income_tax_no : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
        
        <?php if($model->maklumat_sejarah_kerjaya): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletKarierSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKarier = new AtletKarierSearch();
                $dataProviderKarier = $searchModelKarier->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-kerjaya">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_kerjaya)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::jawatan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::majikan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_tamat?></th>
                            <th class="table_records_th" ><?=GeneralLabel::no_telefon?></th>
                            <th class="table_records_th" ><?=GeneralLabel::no_faks?></th>
                            <th class="table_records_th" ><?=GeneralLabel::negeri?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKarier->getCount() > 0){ // got records
                            foreach($dataProviderKarier->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->jawatan_kerja ? GeneralFunction::getUpperCaseWords($modelLoop->jawatan_kerja) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->syarikat ? GeneralFunction::getUpperCaseWords($modelLoop->syarikat) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun_mula ? date("Y", strtotime($modelLoop->tahun_mula))  : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun_tamat ? date("Y", strtotime($modelLoop->tahun_tamat))  : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tel_no ? GeneralFunction::getPhoneFormat($modelLoop->tel_no) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->faks_no ? GeneralFunction::getPhoneFormat($modelLoop->faks_no) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refNegeri']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="7">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
        
        <?php if($model->maklumat_kursus_kem_semasa): ?>
        <?php
            $modelKursusKem = AtletPembangunanKursuskem::find()
                ->joinWith(['refJenisKursuskem'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-kursus-kem-semasa">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kursus_kem_semasa)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKursusKem && $modelKursusKem->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelKursusKem->tarikh_mula) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKursusKem && $modelKursusKem->tarikh_tamat ? GeneralFunction::getDatePrintFormat($modelKursusKem->tarikh_tamat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelKursusKem['refJenisKursuskem']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKursusKem['refJenisKursuskem']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_kursus_kem?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKursusKem && $modelKursusKem->nama_kursus_kem ? GeneralFunction::getUpperCaseWords($modelKursusKem->nama_kursus_kem) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::penganjur?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKursusKem && $modelKursusKem->penganjur ? GeneralFunction::getUpperCaseWords($modelKursusKem->penganjur) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::lokasi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKursusKem && $modelKursusKem->lokasi ? GeneralFunction::getUpperCaseWords($modelKursusKem->lokasi) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_sejarah_kursus_kem): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPembangunanKursuskemSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKursusKem = new AtletPembangunanKursuskemSearch();
                $dataProviderKursusKem = $searchModelKursusKem->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-kursus-kem">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_kursus_kem)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_tamat?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenis?></th>
                            <th class="table_records_th" ><?=GeneralLabel::nama_kursus_kem?></th>
                            <th class="table_records_th" ><?=GeneralLabel::penganjur?></th>
                            <th class="table_records_th" ><?=GeneralLabel::lokasi?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKursusKem->getCount() > 0){ // got records
                            foreach($dataProviderKursusKem->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_mula) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_tamat ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_tamat) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisKursuskem']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisKursuskem']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->nama_kursus_kem ? GeneralFunction::getUpperCaseWords($modelLoop->nama_kursus_kem) : $no_data);
                                echo '</td>';
                                
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->penganjur ? GeneralFunction::getUpperCaseWords($modelLoop->penganjur) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->lokasi ? GeneralFunction::getUpperCaseWords($modelLoop->lokasi) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_kaunseling): ?>
        <?php
            $modelKaunseling = AtletPembangunanKaunseling::find()
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-kaunseling">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kaunseling)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKaunseling && $modelKaunseling->tarikh ? GeneralFunction::getDatePrintFormat($modelKaunseling->tarikh) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tujuan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKaunseling && $modelKaunseling->tujuan ? GeneralFunction::getUpperCaseWords($modelKaunseling->tujuan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::susulan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKaunseling && $modelKaunseling->susulan ? GeneralFunction::getUpperCaseWords($modelKaunseling->susulan) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_sejarah_kaunseling): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPembangunanKaunselingSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKaunseling= new AtletPembangunanKaunselingSearch();
                $dataProviderKaunseling = $searchModelKaunseling->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-kaunseling">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_kaunseling)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tarikh?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tujuan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::susulan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKaunseling->getCount() > 0){ // got records
                            foreach($dataProviderKaunseling->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tujuan ? GeneralFunction::getUpperCaseWords($modelLoop->tujuan) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->susulan ? GeneralFunction::getUpperCaseWords($modelLoop->susulan) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
            
        <?php if($model->maklumat_kemahiran): ?>
        <?php
            $modelKemahiran = AtletPembangunanKemahiran::find()
                ->joinWith(['refJenisKemahiran'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-kemahiran">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kemahiran)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKemahiran && $modelKemahiran->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelKemahiran->tarikh_mula) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKemahiran && $modelKemahiran->tarikh_tamat ? GeneralFunction::getDatePrintFormat($modelKemahiran->tarikh_tamat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_kemahiran?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelKemahiran['refJenisKemahiran']['desc'])){echo GeneralFunction::getUpperCaseWords($modelKemahiran['refJenisKemahiran']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_kemahiran?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKemahiran && $modelKemahiran->nama_kemahiran ? GeneralFunction::getUpperCaseWords($modelKemahiran->nama_kemahiran) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::lokasi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKemahiran && $modelKemahiran->lokasi ? GeneralFunction::getUpperCaseWords($modelKemahiran->lokasi) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::penganjur?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKemahiran && $modelKemahiran->penganjur ? GeneralFunction::getUpperCaseWords($modelKemahiran->penganjur) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_senarai_kemahiran): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPembangunanKemahiranSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelKemahiran = new AtletPembangunanKemahiranSearch();
                $dataProviderKemahiran = $searchModelKemahiran->search($queryPar);
            ?>
            <div id="div_maklumat-senarai-kemahiran">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_senarai_kemahiran)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_tamat?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenis_kemahiran?></th>
                            <th class="table_records_th" ><?=GeneralLabel::nama_kursus_kem?></th>
                            <th class="table_records_th" ><?=GeneralLabel::penganjur?></th>
                            <th class="table_records_th" ><?=GeneralLabel::lokasi?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKemahiran->getCount() > 0){ // got records
                            foreach($dataProviderKemahiran->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_mula) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_tamat ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_tamat) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisKemahiran']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisKemahiran']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->nama_kemahiran ? GeneralFunction::getUpperCaseWords($modelLoop->nama_kemahiran) : $no_data);
                                echo '</td>';
                                
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->lokasi ? GeneralFunction::getUpperCaseWords($modelLoop->lokasi) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->penganjur ? GeneralFunction::getUpperCaseWords($modelLoop->penganjur) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_perubatan): ?>
        <?php
            $modelPerubatan = AtletPerubatan::find()
                ->joinWith(['refKumpulanDarah'])
                ->joinWith(['refStafPerubatanYangBertanggungjawab'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-perubatan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_perubatan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kumpulan_darah?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPerubatan['refKumpulanDarah']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPerubatan['refKumpulanDarah']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alergi_makanan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPerubatan && $modelPerubatan->alergi_makanan ? GeneralFunction::getUpperCaseWords($modelPerubatan->alergi_makanan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alergi_perubatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPerubatan && $modelPerubatan->alergi_perubatan ? GeneralFunction::getUpperCaseWords($modelPerubatan->alergi_perubatan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alergi_jenis_lain?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPerubatan && $modelPerubatan->alergi_jenis_lain ? GeneralFunction::getUpperCaseWords($modelPerubatan->alergi_jenis_lain) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::staf_perubatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPerubatan['refStafPerubatanYangBertanggungjawab']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPerubatan['refStafPerubatanYangBertanggungjawab']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::penyakit_lain_lain?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPerubatan && $modelPerubatan->penyakit_lain_lain ? GeneralFunction::getUpperCaseWords($modelPerubatan->penyakit_lain_lain) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_insurans): ?>
        <?php
            $modelInsurans = AtletPerubatanInsurans::find()
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-insurans">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_insurans)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::syarikat_insurans?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelInsurans && $modelInsurans->syarikat_insurans ? GeneralFunction::getUpperCaseWords($modelInsurans->syarikat_insurans) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_polisi_hayat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsurans && $modelInsurans->no_polisi_hayat ? $modelInsurans->no_polisi_hayat : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_polisi_kad_perubatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsurans && $modelInsurans->no_polisi_kad_perubatan ? $modelInsurans->no_polisi_kad_perubatan : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
    
        <?php if($model->maklumat_penderma): ?>
        <?php
            $modelPenderma = AtletPerubatanDonator::find()
                ->joinWith(['refJenisOrgan'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-penderma">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_penderma)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_dokumen_penderma?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenderma && $modelPenderma->no_donator_dokumen ? $modelPenderma->no_donator_dokumen : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::jenis_organ?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPenderma['refJenisOrgan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenderma['refJenisOrgan']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_perubatan_sains_sukan): ?>
        <section>
            <div id="div_maklumat-perubatan-sains-sukan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_perubatan_sains_sukan)?>
                </div>
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepHPT = new SixStepSearch();
                    $dataProviderSixStepHPT = $searchModelSixStepHPT->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_hpt)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepHPT->getCount() > 0){ // got records
                            foreach($dataProviderSixStepHPT->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepBiomekanikSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepBiomekanik = new SixStepBiomekanikSearch();
                    $dataProviderSixStepBiomekanik = $searchModelSixStepBiomekanik->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_biomekanik)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepBiomekanik->getCount() > 0){ // got records
                            foreach($dataProviderSixStepBiomekanik->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepFisiologiSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepFisiologi = new SixStepFisiologiSearch();
                    $dataProviderSixStepFisiologi = $searchModelSixStepFisiologi->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_fisiologi)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepFisiologi->getCount() > 0){ // got records
                            foreach($dataProviderSixStepFisiologi->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepPsikologiSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepPsikologi = new SixStepPsikologiSearch();
                    $dataProviderSixStepPsikologi = $searchModelSixStepPsikologi->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_psikologi)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepPsikologi->getCount() > 0){ // got records
                            foreach($dataProviderSixStepPsikologi->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepSatelitSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepSatelit = new SixStepSatelitSearch();
                    $dataProviderSixStepSatelit = $searchModelSixStepSatelit->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_isn_negeri)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepSatelit->getCount() > 0){ // got records
                            foreach($dataProviderSixStepSatelit->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['SixStepSuaianFizikalSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelSixStepSuaianFizikal = new SixStepSuaianFizikalSearch();
                    $dataProviderSixStepSuaianFizikal = $searchModelSixStepSuaianFizikal->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_six_step_suaian_fizikal)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::atlet?></th>
                            <th class="table_records_th" ><?=GeneralLabel::stage?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSixStepSuaianFizikal->getCount() > 0){ // got records
                            foreach($dataProviderSixStepSuaianFizikal->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStage']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStage']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSixStepStatus']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSixStepStatus']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['PlTemujanjiSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelTemujanji = new PlTemujanjiSearch();
                    $dataProviderTemujanji = $searchModelTemujanji->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::rekod_temujanji)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::tarikh_temujanji?></th>
                            <th class="table_records_th" width="15%"><?=GeneralLabel::nama_atlet?></th>
                            <th class="table_records_th" width="12.5%"><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" width="12.5%"><?=GeneralLabel::program?></th>
                            <th class="table_records_th" width="12.5%"><?=GeneralLabel::status_temujanji?></th>
                            <th class="table_records_th" width="12.5%"><?=GeneralLabel::jenis_temujanji?></th>
                            <th class="table_records_th" width="15%"><?=GeneralLabel::pegawai_perubatan?></th>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::kehadiran?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderTemujanji->getCount() > 0){ // got records
                            foreach($dataProviderTemujanji->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop->tarikh_temujanji ? GeneralFunction::getDateTimePrintFormat($modelLoop->tarikh_temujanji) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['atlet']['name_penuh'])){echo GeneralFunction::getUpperCaseWords($modelLoop['atlet']['name_penuh']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSukan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refProgramSemasaSukanAtlet']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refProgramSemasaSukanAtlet']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refStatusTemujanjiPesakitLuar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refStatusTemujanjiPesakitLuar']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisTemujanjiPesakitLuar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisTemujanjiPesakitLuar']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refPegawaiPerubatan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refPegawaiPerubatan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refStatusKehadiran']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refStatusKehadiran']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="8">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
            </div>
	</section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_insentif): ?>
        <?php
            $modelInsentif = AtletKewanganInsentif::find()
                ->joinWith(['refJenisInsentif'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-insentif">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_insentif)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_pembayaran_insentif?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsentif && $modelInsentif->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelInsentif->tarikh_mula) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsentif && $modelInsentif->tarikh_tamat ? GeneralFunction::getDatePrintFormat($modelInsentif->tarikh_tamat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_insentif?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelInsentif['refJenisInsentif']['desc'])){echo GeneralFunction::getUpperCaseWords($modelInsentif['refJenisInsentif']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::jumlah?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsentif && $modelInsentif->jumlah ? GeneralFunction::getNumberFormatPrint($modelInsentif->jumlah) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kejohanan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelInsentif && $modelInsentif->kejohanan ? GeneralFunction::getUpperCaseWords($modelInsentif->kejohanan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::pencapaian?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsentif && $modelInsentif->pencapaian ? GeneralFunction::getUpperCaseWords($modelInsentif->pencapaian) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::rekods?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelInsentif && $modelInsentif->rekods ? GeneralFunction::getUpperCaseWords($modelInsentif->rekods) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_penerimaan_insentif): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletKewanganInsentifSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelInsentif = new AtletKewanganInsentifSearch();
                $dataProviderInsentif = $searchModelInsentif->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-penerima-insentif">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_penerimaan_insentif)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenis_insentif?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jumlah?></th>
                            <th class="table_records_th" ><?=GeneralLabel::pencapaian?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderInsentif->getCount() > 0){ // got records
                            foreach($dataProviderInsentif->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh_mula ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_mula) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisInsentif']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisInsentif']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->jumlah ? GeneralFunction::getNumberFormatPrint($modelLoop->jumlah) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->pencapaian ? GeneralFunction::getUpperCaseWords($modelLoop->pencapaian) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="4">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_penajaan): ?>
        <?php
            $modelPenajaan = AtletPenajaansokongan::find()
                ->joinWith(['refNegeri'])
                ->joinWith(['refBandar'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-penajaan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_penajaan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::agensi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPenajaan && $modelPenajaan->nama_syarikat ? GeneralFunction::getUpperCaseWords($modelPenajaan->nama_syarikat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPenajaan && $modelPenajaan->alamat_1 ? GeneralFunction::joinAddress($modelPenajaan->alamat_1, $modelPenajaan->alamat_2, $modelPenajaan->alamat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->alamat_poskod ? $modelPenajaan->alamat_poskod : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alamat_bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPenajaan['refBandar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenajaan['refBandar']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPenajaan['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenajaan['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::emel?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->emel ? $modelPenajaan->emel : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->no_telefon ? $modelPenajaan->no_telefon : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_pegawai?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPenajaan && $modelPenajaan->peribadi_yang_bertanggungjawab ? GeneralFunction::getUpperCaseWords($modelPenajaan->peribadi_yang_bertanggungjawab) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_kontrak?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->jenis_kontrak ? GeneralFunction::getUpperCaseWords($modelPenajaan->jenis_kontrak) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::nilai_kontrak?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->nilai_kontrak ? GeneralFunction::getUpperCaseWords($modelPenajaan->nilai_kontrak) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahun_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->tahun_permulaan ? GeneralFunction::getDatePrintFormat($modelPenajaan->tahun_permulaan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tahun_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenajaan && $modelPenajaan->tahun_akhir ? GeneralFunction::getDatePrintFormat($modelPenajaan->tahun_akhir) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::bentuk_tajaan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPenajaan && $modelPenajaan->barang_yang_penyokong ? GeneralFunction::getUpperCaseWords($modelPenajaan->barang_yang_penyokong) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_biasiswa): ?>
        <?php
            $modelBiasiswa = PermohonanBiasiswa::find()
                ->joinWith(['refJenisBiasiswa'])
                ->joinWith(['refAtlet'])
                ->where('tbl_permohonan_biasiswa.atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-biasiswa">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_biasiswa)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_biasiswa?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelBiasiswa['refJenisBiasiswa']['desc'])){echo GeneralFunction::getUpperCaseWords($modelBiasiswa['refJenisBiasiswa']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tahun_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelBiasiswa && $modelBiasiswa->tarikh_mula_pengajian ? GeneralFunction::getDatePrintFormat($modelBiasiswa->tarikh_mula_pengajian) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tahun_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelBiasiswa && $modelBiasiswa->tarikh_tamat_pengajian ? GeneralFunction::getDatePrintFormat($modelBiasiswa->tarikh_tamat_pengajian) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['PermohonanEBiasiswaSearch']['no_ic'] = $modelAtlet->ic_no;
                    }

                    $searchModelPermohonanEBiasiswa = new PermohonanEBiasiswaSearch();
                    $dataProviderPermohonanEBiasiswa = $searchModelPermohonanEBiasiswa->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::kbs_biasiswa_rekod)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::admin_e_biasiswa?></th>
                            <th class="table_records_th" ><?=GeneralLabel::nama?></th>
                            <th class="table_records_th" ><?=GeneralLabel::no_matrix?></th>
                            <th class="table_records_th" ><?=GeneralLabel::no_kp?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jantina?></th>
                            <th class="table_records_th" ><?=GeneralLabel::status_permohonan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPermohonanEBiasiswa->getCount() > 0){ // got records
                            foreach($dataProviderPermohonanEBiasiswa->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSesiPermohonan']['nama'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSesiPermohonan']['nama']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->nama ? GeneralFunction::getUpperCaseWords($modelLoop->nama) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->no_matriks ? $modelLoop->no_matriks : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->no_kad_pengenalan ? GeneralFunction::getFormatIc($modelLoop->no_kad_pengenalan) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJantina']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJantina']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refStatusPermohonanEBiasiswa']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refStatusPermohonanEBiasiswa']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="6">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                <?php
                    $queryPar = null;

                    if($modelAtlet->atlet_id){
                        //filter by atlet id
                        $queryPar['PermohonanBiasiswaSearch']['atlet'] = $modelAtlet->atlet_id;
                    }

                    $searchModelPermohonanBiasiswa = new PermohonanBiasiswaSearch();
                    $dataProviderPermohonanBiasiswa = $searchModelPermohonanBiasiswa->search($queryPar);
                ?>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::kbs_biasiswa_rekod)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::jenis_biasiswa?></th>
                            <th class="table_records_th" ><?=GeneralLabel::kelulusan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tarikh_hantar?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPermohonanBiasiswa->getCount() > 0){ // got records
                            foreach($dataProviderPermohonanBiasiswa->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisBiasiswa']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisBiasiswa']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refKelulusan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refKelulusan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->created ? GeneralFunction::getDatePrintFormat($modelLoop->created) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="3">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
                
                
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_persatuan_persekutuan_dunia): ?>
        <?php
            $modelPersatuanPersekutuanDunia = AtletSukanPersatuanpersekutuandunia::find()
                ->joinWith(['refJenisSukanPersatuanPersekutuandunia'])
                ->joinWith(['refProfilBadanSukan'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-penajaan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_persatuan_persekutuan_dunia)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refJenisSukanPersatuanPersekutuandunia']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refJenisSukanPersatuanPersekutuandunia']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::name_persatuan_persekutuan_dunia?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refProfilBadanSukan']['nama_badan_sukan'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refProfilBadanSukan']['nama_badan_sukan']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->alamat_1 ? GeneralFunction::joinAddress($modelPersatuanPersekutuanDunia->alamat_1, $modelPersatuanPersekutuanDunia->alamat_2, $modelPersatuanPersekutuanDunia->alamat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->alamat_poskod ? $modelPersatuanPersekutuanDunia->alamat_poskod : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alamat_bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPersatuanPersekutuanDunia['refBandar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refBandar']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::emel?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->emel ? $modelPersatuanPersekutuanDunia->emel : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->no_telefon ? $modelPersatuanPersekutuanDunia->no_telefon : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::laman_web?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->laman_web ? $modelPersatuanPersekutuanDunia->laman_web : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_persatuan_persekutuan_dunia): ?>
        <?php
            $modelPersatuanPersekutuanDunia = AtletSukanPersatuanpersekutuandunia::find()
                ->joinWith(['refJenisSukanPersatuanPersekutuandunia'])
                ->joinWith(['refProfilBadanSukan'])
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-penajaan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_persatuan_persekutuan_dunia)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refJenisSukanPersatuanPersekutuandunia']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refJenisSukanPersatuanPersekutuandunia']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::name_persatuan_persekutuan_dunia?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refProfilBadanSukan']['nama_badan_sukan'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refProfilBadanSukan']['nama_badan_sukan']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->alamat_1 ? GeneralFunction::joinAddress($modelPersatuanPersekutuanDunia->alamat_1, $modelPersatuanPersekutuanDunia->alamat_2, $modelPersatuanPersekutuanDunia->alamat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->alamat_poskod ? $modelPersatuanPersekutuanDunia->alamat_poskod : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::alamat_bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPersatuanPersekutuanDunia['refBandar']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refBandar']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPersatuanPersekutuanDunia['refNegeri']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPersatuanPersekutuanDunia['refNegeri']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::emel?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->emel ? $modelPersatuanPersekutuanDunia->emel : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->no_telefon ? $modelPersatuanPersekutuanDunia->no_telefon : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::laman_web?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPersatuanPersekutuanDunia && $modelPersatuanPersekutuanDunia->laman_web ? $modelPersatuanPersekutuanDunia->laman_web : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
    
        <?php if($model->maklumat_anugerah): ?>
        <?php
            $modelAnugerah = AtletPencapaianAnugerah::find()
                ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-penajaan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_anugerah)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kategori?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelAnugerah['refKategoriAnugerah']['desc'])){echo GeneralFunction::getUpperCaseWords($modelAnugerah['refKategoriAnugerah']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::tahun?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAnugerah && $modelAnugerah->tahun ? $modelAnugerah->tahun : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_anugerah_pingat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAnugerah && $modelAnugerah->nama_anugerah_pingat ? GeneralFunction::getUpperCaseWords($modelAnugerah->nama_anugerah_pingat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelAnugerah['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelAnugerah['refSukan']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::nama_acara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelAnugerah['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($modelAnugerah['refAcara']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::remark?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelAnugerah && $modelAnugerah->remark ? GeneralFunction::getUpperCaseWords($modelAnugerah->remark) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_pencapaian_sukan_semasa): ?>
        
        <section>
            <div id="div_maklumat-pencapaign-sukan-semasa">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_pencapaian_sukan_semasa)?>
                </div>
                <?php
                    $modelPencapaian = AtletPencapaian::find()
                        ->where('atlet_id = :atlet_id', [':atlet_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
                ?>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_kejohanan_temasya?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPencapaian && $modelPencapaian->nama_kejohanan_temasya ? GeneralFunction::getUpperCaseWords($modelPencapaian->nama_kejohanan_temasya) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_anugerah_pingat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?php if(isset($modelPencapaian['refPeringkatKejohananTemasya']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaian['refPeringkatKejohananTemasya']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_mula?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPencapaian && $modelPencapaian->tarikh_mula_kejohanan ? GeneralFunction::getDatePrintFormat($modelPencapaian->tarikh_mula_kejohanan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPencapaian && $modelPencapaian->tarikh_tamat_kejohanan ? GeneralFunction::getDatePrintFormat($modelPencapaian->tarikh_tamat_kejohanan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPencapaian['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaian['refSukan']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::nama_acara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPencapaian['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaian['refAcara']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tempat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPencapaian && $modelPencapaian->lokasi_kejohanan ? GeneralFunction::getUpperCaseWords($modelPencapaian->lokasi_kejohanan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_rekod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPencapaian['refJenisRekod']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaian['refJenisRekod']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::pencapaian?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPencapaian['refKeputusan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaian['refKeputusan']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                    </table>
                </div>
                <div class="title_section_sub">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::keputusan)?>
                </div>
                <?php
                    $modelPencapaianRekods = null;
                
                    if($modelPencapaian && $modelPencapaian->pencapaian_id){
                    $modelPencapaianRekods = AtletPencapaianRekods::find()
                        ->where('pencapaian_id = :pencapaian_id', [':pencapaian_id' => $modelPencapaian->pencapaian_id])->orderBy(['created' => SORT_DESC,])->one();
                    }
                ?>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPencapaianRekods && $modelPencapaianRekods->tarikh ? GeneralFunction::getDatePrintFormat($modelPencapaianRekods->tarikh) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tempat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPencapaianRekods && $modelPencapaianRekods->venue ? GeneralFunction::getUpperCaseWords($modelPencapaianRekods->venue) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::pihak_lawan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPencapaianRekods && $modelPencapaianRekods->opponent ? GeneralFunction::getUpperCaseWords($modelPencapaianRekods->opponent) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jenis_rekod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPencapaianRekods['refJenisRekod']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPencapaianRekods['refJenisRekod']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::keputusan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPencapaianRekods && $modelPencapaianRekods->result ? GeneralFunction::getUpperCaseWords($modelPencapaianRekods->result) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_sejarah_pencapaian_sukan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelAtlet->atlet_id){
                    //filter by atlet id
                    $queryPar['AtletPencapaianRekodsSearch']['atlet_id'] = $modelAtlet->atlet_id;
                }
                
                $searchModelPencapaianRekods = new AtletPencapaianRekodsSearch();
                $dataProviderPencapaianRekods = $searchModelPencapaianRekods->search($queryPar);
            ?>
            <div id="div_maklumat-sejarah-pencapaian-sukan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_sejarah_pencapaian_sukan)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tarikh?></th>
                            <th class="table_records_th" ><?=GeneralLabel::pihak_lawan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tempat?></th>
                            <th class="table_records_th" ><?=GeneralLabel::jenis_rekod?></th>
                            <th class="table_records_th" ><?=GeneralLabel::keputusan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPencapaianRekods->getCount() > 0){ // got records
                            foreach($dataProviderPencapaianRekods->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tarikh ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->opponent ? GeneralFunction::getUpperCaseWords($modelLoop->opponent) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->venue ? GeneralFunction::getUpperCaseWords($modelLoop->venue) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisRekod']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisRekod']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->result ? GeneralFunction::getUpperCaseWords($modelLoop->result) : $no_data);
                                echo '</td>';
                                echo '</tr>';
                                $counter++;
                            }
                        } else {
                            // no records
                            echo '<tr><td class="table_no_records_td" colspan="5">';
                            echo $table_no_data;
                            echo '</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
	</section>
        <?php endif; ?>
    
    
        <?php if($model->maklumat_tawaran): ?>
        
        <section>
            <div id="div_maklumat-tawaran">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_tawaran)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::status_tawaran?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tawaran ? GeneralFunction::getUpperCaseWords($modelAtlet->tawaran) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::fail_rujukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelAtlet->tawaran_fail_rujukan ? $modelAtlet->tawaran_fail_rujukan : $no_data)?></td>
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
