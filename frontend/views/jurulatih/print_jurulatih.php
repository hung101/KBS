<!DOCTYPE html>
<?php

use app\models\Jurulatih;
use app\models\JurulatihSukan;
use app\models\JurulatihSukanSearch;
use frontend\models\JurulatihSukanAcaraSearch;
use app\models\AtletSearch;
use app\models\JurulatihKesihatan;
use frontend\models\JurulatihKesihatanMasalahSearch;
use app\models\JurulatihKeluarga;
use frontend\models\JurulatihPendidikanSearch;
use frontend\models\JurulatihPengalamanSearch;
use frontend\models\JurulatihSpkkSearch;
use frontend\models\JurulatihKursusTertinggiSearch;
use app\models\PengurusanPemantauanDanPenilaianJurulatihKetua;
use frontend\models\PengurusanPenilaianKategoriJurulatihKetuaSearch;
use frontend\models\PengurusanPemantauanDanPenilaianJurulatihSearch;
use frontend\models\PengurusanPenilaianKategoriJurulatihSearch;

// table reference
use app\models\RefJantina;
use app\models\RefCawangan;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefNegara;
use app\models\RefBangsa;
use app\models\RefAgama;
use app\models\RefTarafPerkahwinan;
use app\models\RefBahagianJurulatih;
use app\models\RefProgramJurulatih;
use app\models\RefSubProgramPelapisJurulatih;
use app\models\RefLainProgramJurulatih;
use app\models\RefSukan;
use app\models\RefAcara;
use app\models\RefStatusJurulatih;
use app\models\RefStatusPermohonanJurulatih;
use app\models\RefKeaktifanJurulatih;
use app\models\RefSektorPekerjaan;
use app\models\RefStatusTawaran;
use app\models\RefAgensiJurulatih;

use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;
?>

<html>
<head>
	<title>Jurulatih Profil</title>
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
                    margin-top: 9cm;
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
                
                .title_section_message{
                    border:1px solid black;
                    //color:red;
                    font-weight: bold;
                    font-size: 12px;
                    padding-left: 5px;
                    margin-top: 5px;
                }
                
                .field_label{
                    width:31%;
                    padding-top:2px;
                    padding-bottom:2px;
                    vertical-align: top;
                    font-weight: bold;
                }
                
                .field_colon{
                    width:2%;
                    padding-top:2px;
                    padding-bottom:2px;
                    vertical-align: top;
                    font-weight: bold;
                }
                
                .field_value{
                    width:67%;
                    //color:black;
                    //font-weight: bold;
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
                    font-weight: bold;
                }
                
                .field_colon_2{
                    width:1%;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
                    font-weight: bold;
                }
                
                .field_value_2{
                    width:24.5%;
                    //color:red;
                    //font-weight: bold;
                    padding-top:5px;
                    padding-bottom:5px;
                    vertical-align: top;
                }
                
                .field_value_col_4{
                    //color:red;
                    //font-weight: bold;
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
                    //color:red;
                    //font-weight: bold;
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
        $modelJurulatih = null;
        $no_data = GeneralLabel::tiada;
        $table_no_data = GeneralLabel::tiada_rekod; 
        
        if ($id != "" && ($modelJurulatih = Jurulatih::findOne($id)) !== null) {
            // get atlet dropdown value's descriptions
            $ref = RefJantina::findOne(['id' => $modelJurulatih->jantina]);
            $modelJurulatih->jantina = $ref['desc'];

            $ref = RefCawangan::findOne(['id' => $modelJurulatih->cawangan]);
            $modelJurulatih->cawangan = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelJurulatih->alamat_rumah_bandar]);
            $modelJurulatih->alamat_rumah_bandar = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelJurulatih->alamat_rumah_negeri]);
            $modelJurulatih->alamat_rumah_negeri = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelJurulatih->alamat_surat_menyurat_bandar]);
            $modelJurulatih->alamat_surat_menyurat_bandar = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelJurulatih->alamat_surat_menyurat_negeri]);
            $modelJurulatih->alamat_surat_menyurat_negeri = $ref['desc'];

            $ref = RefBandar::findOne(['id' => $modelJurulatih->alamat_majikan_bandar]);
            $modelJurulatih->alamat_majikan_bandar = $ref['desc'];

            $ref = RefNegeri::findOne(['id' => $modelJurulatih->alamat_majikan_negeri]);
            $modelJurulatih->alamat_majikan_negeri = $ref['desc'];

            $ref = RefNegara::findOne(['id' => $modelJurulatih->warganegara]);
            $modelJurulatih->warganegara = $ref['desc'];

            $ref = RefBangsa::findOne(['id' => $modelJurulatih->bangsa]);
            $modelJurulatih->bangsa = $ref['desc'];

            $ref = RefAgama::findOne(['id' => $modelJurulatih->agama]);
            $modelJurulatih->agama = $ref['desc'];

            $ref = RefTarafPerkahwinan::findOne(['id' => $modelJurulatih->taraf_perkahwinan]);
            $modelJurulatih->taraf_perkahwinan = $ref['desc'];

            $ref = RefBahagianJurulatih::findOne(['id' => $modelJurulatih->bahagian]);
            $modelJurulatih->bahagian = $ref['desc'];

            $ref = RefProgramJurulatih::findOne(['id' => $modelJurulatih->program]);
            $modelJurulatih->program = $ref['desc'];

            $ref = RefSubProgramPelapisJurulatih::findOne(['id' => $modelJurulatih->sub_cawangan_pelapis]);
            $modelJurulatih->sub_cawangan_pelapis = $ref['desc'];

            $ref = RefLainProgramJurulatih::findOne(['id' => $modelJurulatih->lain_lain_program]);
            $modelJurulatih->lain_lain_program = $ref['desc'];

            $ref = RefSukan::findOne(['id' => $modelJurulatih->nama_sukan]);
            $modelJurulatih->nama_sukan = $ref['desc'];

            $ref = RefAcara::findOne(['id' => $modelJurulatih->nama_acara]);
            $modelJurulatih->nama_acara = $ref['desc'];

            $ref = RefStatusJurulatih::findOne(['id' => $modelJurulatih->status_jurulatih]);
            $modelJurulatih->status_jurulatih = $ref['desc'];

            $ref = RefStatusPermohonanJurulatih::findOne(['id' => $modelJurulatih->status_permohonan]);
            $modelJurulatih->status_permohonan = $ref['desc'];

            $ref = RefKeaktifanJurulatih::findOne(['id' => $modelJurulatih->status_keaktifan_jurulatih]);
            $modelJurulatih->status_keaktifan_jurulatih = $ref['desc'];

            $ref = RefSektorPekerjaan::findOne(['id' => $modelJurulatih->sektor]);
            $modelJurulatih->sektor = $ref['desc'];

            $ref = RefStatusTawaran::findOne(['id' => $modelJurulatih->status_tawaran]);
            $modelJurulatih->status_tawaran = $ref['desc'];

             $ref = RefAgensiJurulatih::findOne(['id' => $modelJurulatih->agensi]);
            $modelJurulatih->agensi = $ref['desc'];
        
        
            $modelSukanProgram = JurulatihSukan::find()->joinWith(['refSukan'])
                ->joinWith(['refBahagianJurulatih'])
                ->joinWith(['refProgramJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refGajiElaunJurulatih'])
                ->where('jurulatih_id = :jurulatih_id', [':jurulatih_id' => $id])->orderBy(['tarikh_mula_lantikan' => SORT_DESC,])->one();
    ?>
	<htmlpageheader name="MyCustomHeader">
            <div>
                <table>
                    <tr>
                        <td style="width:20%" text-align: center;>
                            <img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="200px">
                        </td>
                        <td style="width:80%; text-align: center;">
                            <h1 >MAKLUMAT DIRI JURULATIH</h1>
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
                                    <td class="field_value"><?=($modelJurulatih->nama ? GeneralFunction::getUpperCaseWords($modelJurulatih->nama) : $no_data)?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::no_fail?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelJurulatih->no_fail ? $modelJurulatih->no_fail : $no_data)?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::program?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?php if(isset($modelSukanProgram['refProgramJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refProgramJurulatih']['desc']);} else { echo $no_data;} ?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::sukan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?php if(isset($modelSukanProgram['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refSukan']['desc']);} else { echo $no_data;} ?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::pusat_latihan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelJurulatih->pusat_latihan ? GeneralFunction::getUpperCaseWords($modelJurulatih->pusat_latihan) : $no_data)?></td>
                                </tr>
                                <tr>
                                    <td class="field_label"><?=GeneralLabel::tempoh_lantikan?></td>
                                    <td class="field_colon">:</td>
                                    <td class="field_value"><?=($modelSukanProgram->tarikh_mula_lantikan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_lantikan) : $no_data)?> - <?=($modelSukanProgram->tarikh_tamat_lantikan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_lantikan) : $no_data)?></td>
                                </tr>
                            </table>
                        </td>
                        <td class="atlet_photo" style="width:25%; text-align: center;">
                            <?php
                                if($modelJurulatih !== null && $modelJurulatih->gambar){
                                    echo '<img src="'.\Yii::$app->request->BaseUrl.'/'.$modelJurulatih->gambar.'" height="135px">';
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
                            <td class="field_label_2"><?=GeneralLabel::no_kad_pengenalan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->ic_no ? GeneralFunction::getFormatIc($modelJurulatih->ic_no) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp; </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_lahir?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->tarikh_lahir ? GeneralFunction::getDatePrintFormat($modelJurulatih->tarikh_lahir) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::umur?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->tarikh_lahir ? GeneralFunction::ageCalculator($modelJurulatih->tarikh_lahir) . ' TAHUN' : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jantina?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->jantina ? GeneralFunction::getUpperCaseWords($modelJurulatih->jantina) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::warganegara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->warganegara ? GeneralFunction::getUpperCaseWords($modelJurulatih->warganegara) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::agama?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->agama ? GeneralFunction::getUpperCaseWords($modelJurulatih->agama) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bangsa?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->bangsa ? GeneralFunction::getUpperCaseWords($modelJurulatih->bangsa) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tempat_lahir?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih->tempat_lahir ? GeneralFunction::getUpperCaseWords($modelJurulatih->tempat_lahir) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::taraf_perkahwinan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->taraf_perkahwinan ? GeneralFunction::getUpperCaseWords($modelJurulatih->taraf_perkahwinan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bil_tanggungan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->bil_tanggungan ? $modelJurulatih->bil_tanggungan : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_rumah_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih->alamat_rumah_1 ? GeneralFunction::joinAddress($modelJurulatih->alamat_rumah_1, $modelJurulatih->alamat_rumah_2, $modelJurulatih->alamat_rumah_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->alamat_rumah_poskod ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_rumah_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->alamat_rumah_bandar ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_rumah_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->alamat_rumah_negeri ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_rumah_negeri) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_rumah_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->no_telefon ? GeneralFunction::getPhoneFormat($modelJurulatih->no_telefon) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_bimbit_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->no_telefon_bimbit ? GeneralFunction::getPhoneFormat($modelJurulatih->no_telefon_bimbit) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::passport_no?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->passport_no ? $modelJurulatih->passport_no : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->tamat_tempoh ? GeneralFunction::getDatePrintFormat($modelJurulatih->tamat_tempoh) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_visa?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->no_visa ? $modelJurulatih->no_visa : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->tamat_visa_tempoh ? GeneralFunction::getDatePrintFormat($modelJurulatih->tamat_visa_tempoh) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_permit_kerja?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->no_permit_kerja ? $modelJurulatih->no_permit_kerja : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tamat_tempoh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->tamat_permit_tempoh ? GeneralFunction::getDatePrintFormat($modelJurulatih->tamat_permit_tempoh) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_surat_menyurat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih && $modelJurulatih->alamat_surat_menyurat_1 ? GeneralFunction::joinAddress($modelJurulatih->alamat_surat_menyurat_1, $modelJurulatih->alamat_surat_menyurat_2, $modelJurulatih->alamat_surat_menyurat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->alamat_surat_menyurat_poskod ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_surat_menyurat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->alamat_surat_menyurat_bandar ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_surat_menyurat_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih && $modelJurulatih->alamat_surat_menyurat_negeri ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_surat_menyurat_negeri) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::emel?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih->emel ? $modelJurulatih->emel : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>
    
        <?php if($model->maklumat_pelantikan): ?>
        <section>
            <div id="div_maklumat-pelantikan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_pelantikan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::agensi_pelantik?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->agensi ? GeneralFunction::getUpperCaseWords($modelJurulatih->agensi) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::status_keaktifan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->status_keaktifan_jurulatih ? GeneralFunction::getUpperCaseWords($modelJurulatih->status_keaktifan_jurulatih) : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::status_jurulatih?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih->status_jurulatih ? GeneralFunction::getUpperCaseWords($modelJurulatih->status_jurulatih) : $no_data)?></td>
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
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refProgramJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refProgramJurulatih']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refSukan']['desc']);} else { echo $no_data;} ?></td> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::bahagian?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refBahagianJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refBahagianJurulatih']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::cawangan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refCawangan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refCawangan']['desc']);} else { echo $no_data;} ?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_mula_lantikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tarikh_mula_lantikan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_mula_lantikan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_tamat_lantikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->tarikh_tamat_lantikan ? GeneralFunction::getDatePrintFormat($modelSukanProgram->tarikh_tamat_lantikan) : $no_data)?> </td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::gaji_elaun_geran?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelSukanProgram['refGajiElaunJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSukanProgram['refGajiElaunJurulatih']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::jumlah?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelSukanProgram && $modelSukanProgram->jumlah ? $modelSukanProgram->jumlah : $no_data)?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <br>
        </section>
        <?php endif; ?>
    
        <?php if($model->maklumat_acara): ?>
        <section>
            
            <?php
                $queryPar = null;
                
                if($modelSukanProgram->jurulatih_sukan_id){
                    //filter by sukan id
                    $queryPar['JurulatihSukanAcaraSearch']['jurulatih_sukan_id'] = $modelSukanProgram->jurulatih_sukan_id;
                }
                
                $searchModelSukan = new JurulatihSukanAcaraSearch();
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
                                echo '</td><td class="table_records_td">';
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


        <?php if($model->maklumat_atlet): ?>
        <section>
            
            <?php
                $queryPar = null;
                
                if($modelJurulatih->jurulatih_id){
                    //filter by sukan id
                    $queryPar['AtletSearch']['jurulatih'] = $modelJurulatih->jurulatih_id;
                }
                
                $searchModelAtlet = new AtletSearch();
                $dataProviderAtlet = $searchModelAtlet->search($queryPar);
            ?>
            <div id="div_maklumat-atlet">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_atlet)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::bil?></th>
                            <th class="table_records_th" width="90%"><?=GeneralLabel::nama_atlet?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderAtlet->getCount() > 0){ // got records
                            foreach($dataProviderAtlet->models as $Atletmodel){
                                echo '<tr><td class="table_records_td">';
                                echo $counter;
                                echo '</td><td class="table_records_td">';
                                echo ($Atletmodel && $Atletmodel->name_penuh ? GeneralFunction::getUpperCaseWords($Atletmodel->name_penuh) : $no_data);
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


        <?php if($model->maklumat_kesihatan): ?>
        <?php
            $modelKesihatan = JurulatihKesihatan::find()
                ->where('jurulatih_id = :jurulatih_id', [':jurulatih_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-kesihatan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kesihatan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::tinggi?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKesihatan && $modelKesihatan->tinggi ? GeneralFunction::getWeightHeight($modelKesihatan->tinggi) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::berat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKesihatan && $modelKesihatan->berat ? GeneralFunction::getWeightHeight($modelKesihatan->berat) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::penyakit_penyakit_lain?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKesihatan && $modelKesihatan->catatan ? GeneralFunction::getUpperCaseWords($modelKesihatan->catatan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::pembedahan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKesihatan && $modelKesihatan->pembedahan ? GeneralFunction::getUpperCaseWords($modelKesihatan->pembedahan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alahan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKesihatan && $modelKesihatan->alahan ? GeneralFunction::getUpperCaseWords($modelKesihatan->alahan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::sejarah_perubatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKesihatan && $modelKesihatan->sejarah_perubatan ? GeneralFunction::getUpperCaseWords($modelKesihatan->sejarah_perubatan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::kecacatan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKesihatan && $modelKesihatan->kecacatan ? GeneralFunction::getUpperCaseWords($modelKesihatan->kecacatan) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <?php
                        $queryPar = null;

                        if($modelKesihatan && $modelKesihatan->jurulatih_kesihatan_id){
                            //filter by sukan id
                            $queryPar['JurulatihKesihatanMasalahSearch']['jurulatih_kesihatan_id'] = $modelKesihatan->jurulatih_kesihatan_id;
                        }

                        $searchModelKesihatanMasalah = new JurulatihKesihatanMasalahSearch();
                        $dataProviderKesihatanMasalah = $searchModelKesihatanMasalah->search($queryPar);
                    ?>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::bil?></th>
                            <th class="table_records_th" width="90%"><?=GeneralLabel::masalah_kesihatan?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKesihatanMasalah->getCount() > 0){ // got records
                            foreach($dataProviderKesihatanMasalah->models as $modelLoop){
                                echo '<tr><td class="table_records_td">';
                                echo $counter;
                                echo '</td><td class="table_records_td">';
                                if(isset($modelLoop['refMasalahKesihatan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refMasalahKesihatan']['desc']); } else { echo $no_data;}
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
    
        
        <?php if($model->maklumat_keluarga_jika_berlaku_kecemasan): ?>
        <?php
            $modelKeluarga = JurulatihKeluarga::find()
                ->where('jurulatih_id = :jurulatih_id', [':jurulatih_id' => $id])->orderBy(['created' => SORT_DESC,])->one();
        ?>
        <section>
            <div id="div_maklumat-keluarga-jika-berlaku-kecemasan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_keluarga_jika_berlaku_kecemasan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_suami_isteri_waris?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->nama_suami_isteri_waris ? GeneralFunction::getUpperCaseWords($modelKeluarga->nama_suami_isteri_waris) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::hubungan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->hubungan_keluargaan ? GeneralFunction::getUpperCaseWords($modelKeluarga->hubungan_keluargaan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_surat_menyurat_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKeluarga && $modelKeluarga->alamat_surat_menyurat_1 ? GeneralFunction::joinAddress($modelKeluarga->alamat_surat_menyurat_1, $modelKeluarga->alamat_surat_menyurat_2, $modelKeluarga->alamat_surat_menyurat_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->alamat_surat_menyurat_poskod ? GeneralFunction::getUpperCaseWords($modelKeluarga->alamat_surat_menyurat_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->alamat_surat_menyurat_bandar ? GeneralFunction::getUpperCaseWords($modelKeluarga->alamat_surat_menyurat_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelKeluarga && $modelKeluarga->alamat_surat_menyurat_negeri ? GeneralFunction::getUpperCaseWords($modelKeluarga->alamat_surat_menyurat_negeri) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_rumah_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->no_telefon ? GeneralFunction::getPhoneFormat($modelKeluarga->no_telefon) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_bimbit_print?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelKeluarga && $modelKeluarga->no_telefon_bimbit ? GeneralFunction::getPhoneFormat($modelKeluarga->no_telefon_bimbit) : $no_data)?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php if($model->maklumat_pendidikan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelJurulatih->jurulatih_id){
                    //filter by atlet id
                    $queryPar['JurulatihPendidikanSearch']['jurulatih_id'] = $modelJurulatih->jurulatih_id;
                }
                
                $searchModelPendidikan = new JurulatihPendidikanSearch();
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
                            <th class="table_records_th" ><?=GeneralLabel::tahun?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPendidikan->getCount() > 0){ // got records
                            foreach($dataProviderPendidikan->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refTahapPendidikan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refTahapPendidikan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->gred ? GeneralFunction::getUpperCaseWords($modelLoop->gred) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->sekolah_kolej_universiti ? GeneralFunction::getUpperCaseWords($modelLoop->sekolah_kolej_universiti) : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun ? $modelLoop->tahun : $no_data);
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


        <?php if($model->maklumat_majikan): ?>
        <section>
            <div id="div_maklumat-majikan">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_majikan)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jawatan_hakiki?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->jawatan ? GeneralFunction::getUpperCaseWords($modelJurulatih->jawatan) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::majikan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->nama_majikan ? GeneralFunction::getUpperCaseWords($modelJurulatih->nama_majikan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::alamat_majikan_1?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih && $modelJurulatih->alamat_majikan_1 ? GeneralFunction::joinAddress($modelJurulatih->alamat_majikan_1, $modelJurulatih->alamat_majikan_2, $modelJurulatih->alamat_majikan_3) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::poskod?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->alamat_majikan_poskod ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_majikan_poskod) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::bandar?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->alamat_majikan_bandar ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_majikan_bandar) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::negeri?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelJurulatih && $modelJurulatih->alamat_majikan_negeri ? GeneralFunction::getUpperCaseWords($modelJurulatih->alamat_majikan_negeri) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::no_telefon_pejabat?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->no_telefon_pejabat ? GeneralFunction::getPhoneFormat($modelJurulatih->no_telefon_pejabat) : $no_data)?></td>
                            <td class="field_label_2">&nbsp;</td>
                            <td class="field_colon_2">&nbsp;</td>
                            <td class="field_value_2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php if($model->maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelJurulatih->jurulatih_id){
                    //filter by jurulatih id
                    $queryPar['JurulatihPengalamanSearch']['jurulatih_id'] = $modelJurulatih->jurulatih_id;
                }
                
                $searchModelPendidikan = new JurulatihPengalamanSearch();
                $dataProviderPendidikan = $searchModelPendidikan->search($queryPar);
            ?>
            <div id="div_maklumat-pengalaman-penglibatan-sukan-dan-kejurulatihan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_pengalaman_penglibatan_sukan_dan_kejurulatihan)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_mula?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahun_tamat?></th>
                            <th class="table_records_th" ><?=GeneralLabel::perkara_aktiviti?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPendidikan->getCount() > 0){ // got records
                            foreach($dataProviderPendidikan->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun ? $modelLoop->tahun : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun_akhir ? $modelLoop->tahun_akhir : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->perkara_aktiviti ? GeneralFunction::getUpperCaseWords($modelLoop->perkara_aktiviti) : $no_data);
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


        <?php if($model->maklumat_skim_pensijilan_kejurulatihan_kebangsaan): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelJurulatih->jurulatih_id){
                    //filter by jurulatih id
                    $queryPar['JurulatihSpkkSearch']['jurulatih_id'] = $modelJurulatih->jurulatih_id;
                }
                
                $searchModelSpkk = new JurulatihSpkkSearch();
                $dataProviderSpkk = $searchModelSpkk->search($queryPar);
            ?>
            <div id="div_maklumat-skim-pensijilan-kejurulatihan-kebangsaan">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_skim_pensijilan_kejurulatihan_kebangsaan)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::sijil?></th>
                            <th class="table_records_th" ><?=GeneralLabel::tahap?></th>
                            <th class="table_records_th" ><?=GeneralLabel::sukan?></th>
                            <th class="table_records_th" ><?=GeneralLabel::no_sijil?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderSpkk->getCount() > 0){ // got records
                            foreach($dataProviderSpkk->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refJenisSijilKelayakanJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refJenisSijilKelayakanJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refTahapKelayakanJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refTahapKelayakanJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSukan']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->no_sijil ? $modelLoop->no_sijil : $no_data);
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


        <?php if($model->maklumat_kelayakan_kursus_tertinggi_spesifik): ?>
        <section>
            <?php
                $queryPar = null;

                if($modelJurulatih->jurulatih_id){
                    //filter by jurulatih id
                    $queryPar['JurulatihKursusTertinggiSearch']['jurulatih_id'] = $modelJurulatih->jurulatih_id;
                }
                
                $searchModelKursusTertinggi = new JurulatihKursusTertinggiSearch();
                $dataProviderKursusTertinggi = $searchModelKursusTertinggi->search($queryPar);
            ?>
            <div id="div_maklumat-kelayakan-kursus-tertinggi-spesifik">
                <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_kelayakan_kursus_tertinggi_spesifik)?>
                </div>
                <div>
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" ><?=GeneralLabel::tahun?></th>
                            <th class="table_records_th" ><?=GeneralLabel::kursus?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderKursusTertinggi->getCount() > 0){ // got records
                            foreach($dataProviderKursusTertinggi->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->tahun ? $modelLoop->tahun : $no_data);
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->kursus ? GeneralFunction::getUpperCaseWords($modelLoop->kursus) : $no_data);
                                echo '</td>';
                                echo '</tr>';
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



        <?php if($model->maklumat_penilaian_ketua_jurulatih): ?>
        <?php
            $modelPenilaianKetuaJurulatih = PengurusanPemantauanDanPenilaianJurulatihKetua::find()
                ->where('nama_jurulatih_dinilai = :nama_jurulatih_dinilai', [':nama_jurulatih_dinilai' => $id])->orderBy(['created' => SORT_DESC])->one();
        ?>
        <?php
            $queryPar = null;

            if($modelPenilaianKetuaJurulatih && $modelPenilaianKetuaJurulatih->pengurusan_pemantauan_dan_penilaian_jurulatih_id){
                //filter by pengurusan_pemantauan_dan_penilaian_jurulatih_id
                $queryPar['PengurusanPenilaianKategoriJurulatihKetuaSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $modelPenilaianKetuaJurulatih->pengurusan_pemantauan_dan_penilaian_jurulatih_id;
            

            $searchModelPenilaianKategoriJurulatihKetua = new PengurusanPenilaianKategoriJurulatihKetuaSearch();
            $dataProviderPenilaianKategoriJurulatihKetua = $searchModelPenilaianKategoriJurulatihKetua->search($queryPar);
        ?>
        <section>
            <div id="div_maklumat-penilaian-ketua-jurulatih">
                <div class="title_section">
                    <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_penilaian_ketua_jurulatih)?>
                </div>
                <div>
                    <table>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::nama_sukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPenilaianKetuaJurulatih['refSukan']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenilaianKetuaJurulatih['refSukan']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::nama_acara?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPenilaianKetuaJurulatih['refAcara']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenilaianKetuaJurulatih['refAcara']['desc']);} else { echo $no_data;} ?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::pusat_latihan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($modelPenilaianKetuaJurulatih && $modelPenilaianKetuaJurulatih->pusat_latihan ? GeneralFunction::getUpperCaseWords($modelPenilaianKetuaJurulatih->pusat_latihan) : $no_data)?></td>
                        </tr>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::penilai_oleh?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?php if(isset($modelPenilaianKetuaJurulatih['refPenilaianJurulatihKetua']['desc'])){echo GeneralFunction::getUpperCaseWords($modelPenilaianKetuaJurulatih['refPenilaianJurulatihKetua']['desc']);} else { echo $no_data;} ?></td>
                            <td class="field_label_2"><?=GeneralLabel::tarikh_dinilai?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelPenilaianKetuaJurulatih && $modelPenilaianKetuaJurulatih->tarikh_dinilai ? GeneralFunction::getDatePrintFormat($modelPenilaianKetuaJurulatih->tarikh_dinilai) : $no_data)?></td>
                        </tr>
                        <?php
                        $jumlah_markah_ketua_jurulatih = 0;
                        if($dataProviderPenilaianKategoriJurulatihKetua->getCount() > 0){ // got records
                            foreach($dataProviderPenilaianKategoriJurulatihKetua->models as $modelLoop){
                                $jumlah_markah_ketua_jurulatih += $modelLoop->markah_penilaian;
                            }
                        } 
                        ?>
                        <tr>
                            <td class="field_label_2"><?=GeneralLabel::jumlah_markah_penilaian?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_col_4" colspan="4"><?=($jumlah_markah_ketua_jurulatih ? $jumlah_markah_ketua_jurulatih : $no_data)?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    
                    <table class="table_records">
                        <tr>
                            <th class="table_records_th" width="45%"><?=GeneralLabel::kategori?></th>
                            <th class="table_records_th" width="45%"><?=GeneralLabel::sub_kategori?></th>
                            <th class="table_records_th" width="10%"><?=GeneralLabel::markah?></th>
                        </tr>
                        <?php
                        $counter = 1;
                        
                        if($dataProviderPenilaianKategoriJurulatihKetua->getCount() > 0){ // got records
                            foreach($dataProviderPenilaianKategoriJurulatihKetua->models as $modelLoop){
                                echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refKategoriPenilaianJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refKategoriPenilaianJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelLoop['refSubKategoriPenilaianJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelLoop['refSubKategoriPenilaianJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelLoop && $modelLoop->markah_penilaian ? $modelLoop->markah_penilaian : $no_data);
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
            <?php } ?>
        <?php endif; ?>


        <?php if($model->maklumat_penilaian): ?>
        <section>
            <div class="title_section">
                <?=GeneralFunction::getUpperCaseWords(GeneralLabel::maklumat_penilaian)?>
            </div>
        <?php
            $queryPar = null;

            if($modelJurulatih->jurulatih_id){
                //filter by pengurusan_pemantauan_dan_penilaian_jurulatih_id
                $queryPar['PengurusanPemantauanDanPenilaianJurulatihSearch']['jurulatih'] = $modelJurulatih->jurulatih_id;
            }

            $searchModelPenilaianJurulatih = new PengurusanPemantauanDanPenilaianJurulatihSearch();
            $dataProviderPenilaianJurulatih = $searchModelPenilaianJurulatih->search($queryPar);
            
            $dataProviderPenilaianJurulatih->pagination->pageSize=0;
            
            $counter = 1;
            
            if($dataProviderPenilaianJurulatih->getCount() > 0){ // got records
                foreach($dataProviderPenilaianJurulatih->models as $modelLoop){
                    $jumlah_markah_jurulatih = 0;
                    
                    $querySubPar = null;

                    if($modelLoop && $modelLoop->pengurusan_pemantauan_dan_penilaian_jurulatih_id){
                        //filter by pengurusan_pemantauan_dan_penilaian_jurulatih_id
                        $querySubPar['PengurusanPenilaianKategoriJurulatihSearch']['pengurusan_pemantauan_dan_penilaian_jurulatih_id'] = $modelLoop->pengurusan_pemantauan_dan_penilaian_jurulatih_id;
                    

                    $searchModelPenilaianKategoriJurulatih = new PengurusanPenilaianKategoriJurulatihSearch();
                    $dataProviderPenilaianKategoriJurulatih = $searchModelPenilaianKategoriJurulatih->search($querySubPar);
                    
                    $dataProviderPenilaianKategoriJurulatih->pagination->pageSize=0;
                    
                    if($dataProviderPenilaianKategoriJurulatih->getCount() > 0){ // got records
                        foreach($dataProviderPenilaianKategoriJurulatih->models as $modelSubLoop){
                            $jumlah_markah_jurulatih += $modelSubLoop->markah_penilaian;
                        }
                    } 
                    echo '<div class="title_section_sub" style="text-align: center;">'
                                . GeneralFunction::getUpperCaseWords(GeneralLabel::penilai) . ' ' . $counter . ':' .
                            '</div>
                            <div>
                                <table>
                                    <tr>
                                        <td class="field_label_2">'.GeneralLabel::nama_sukan.'</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_2">' . (isset($modelLoop['refSukan']['desc']) ? GeneralFunction::getUpperCaseWords($modelLoop['refSukan']['desc']) : $no_data) . '</td>
                                        <td class="field_label_2">' . GeneralLabel::nama_acara. '</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_2">' . (isset($modelLoop['refAcara']['desc']) ? GeneralFunction::getUpperCaseWords($modelLoop['refAcara']['desc']) : $no_data) . '</td>
                                    </tr>
                                    <tr>
                                        <td class="field_label_2">' . GeneralLabel::jumlah_markah_penilaian. '</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_col_4" colspan="4">' . ($jumlah_markah_jurulatih ? $jumlah_markah_jurulatih : $no_data). '</td>
                                    </tr>
                                    <tr>
                                        <td class="field_label_2">' . GeneralLabel::pusat_latihan. '</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_col_4" colspan="4">' . ($modelLoop && $modelLoop->pusat_latihan ? GeneralFunction::getUpperCaseWords($modelLoop->pusat_latihan) : $no_data). '</td>
                                    </tr>
                                    <tr>
                                        <td class="field_label_2">' . GeneralLabel::penilai_oleh. '</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_2">' . (isset($modelLoop['refPenilaianJurulatih']['desc']) ? GeneralFunction::getUpperCaseWords($modelLoop['refPenilaianJurulatih']['desc']) : $no_data) . '</td>
                                        <td class="field_label_2">' . GeneralLabel::tarikh_dinilai. '</td>
                                        <td class="field_colon_2">:</td>
                                        <td class="field_value_2">' . ($modelLoop && $modelLoop->tarikh_dinilai ? GeneralFunction::getDatePrintFormat($modelLoop->tarikh_dinilai) : $no_data). '</td>
                                    </tr>
                                </table>
                            </div>';
                    
                    echo '<div>
                            <table class="table_records">
                                <tr>
                                    <th class="table_records_th" width="45%">' .GeneralLabel::kategori . '</th>
                                    <th class="table_records_th" width="45%">' .GeneralLabel::sub_kategori . '</th>
                                    <th class="table_records_th" width="10%">' .GeneralLabel::markah . '</th>
                                </tr>';
                    
                    if($dataProviderPenilaianKategoriJurulatih->getCount() > 0){ // got records
                        
                        
                        foreach($dataProviderPenilaianKategoriJurulatih->models as $modelSubLoop){
                            echo '<tr>';
                                echo '<td class="table_records_td">';
                                if(isset($modelSubLoop['refKategoriPenilaianJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSubLoop['refKategoriPenilaianJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                if(isset($modelSubLoop['refSubKategoriPenilaianJurulatih']['desc'])){echo GeneralFunction::getUpperCaseWords($modelSubLoop['refSubKategoriPenilaianJurulatih']['desc']); } else { echo $no_data;}
                                echo '</td>';
                                echo '<td class="table_records_td">';
                                echo ($modelSubLoop && $modelSubLoop->markah_penilaian ? $modelSubLoop->markah_penilaian : $no_data);
                                echo '</td>';
                                echo '</tr>';
                        } 
                        
                        
                    } else {
                        // no records
                        echo '<tr><td class="table_no_records_td" colspan="3">';
                        echo $table_no_data;
                        echo '</td></tr>';
                    }
                    
                    echo '</table>
                        </div>';
                    
                    $counter++;
                    }
                }
            } else {
                // no records
                echo '<div class="title_section_message">';
                echo $table_no_data;
                echo '</div>';
            }
            
            
        ?>
        
            <div id="div_maklumat-penilaian">
                
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
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->status_tawaran ? GeneralFunction::getUpperCaseWords($modelJurulatih->status_tawaran) : $no_data)?></td>
                            <td class="field_label_2"><?=GeneralLabel::fail_rujukan?></td>
                            <td class="field_colon_2">:</td>
                            <td class="field_value_2"><?=($modelJurulatih && $modelJurulatih->no_fail ? GeneralFunction::getUpperCaseWords($modelJurulatih->no_fail) : $no_data)?></td>
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
