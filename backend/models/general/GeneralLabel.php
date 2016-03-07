<?php
namespace app\models\general;

use Yii;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GeneralLabel{
    /*const create = "Create";
    const update = "Update";
    const delete = "Delete";
    const view = "View";
    const other = "Others";
    const backToList = "Back To List";
    const backToForm = "Back To Form";
    const viewTitle = "View";
    const updateTitle = "Update";
    const createTitle = "Create";
    const remove = "Keluarkan";
    const viewAttachment = "View Attachment";
    const removeImage = "Keluarkan Gambar";
    const mandatoryField = "lapangan mandatori";
    const yes = "Ya";
    const no = "Tidak";*/
    
    const create = "Simpan";
    const update = "Kemas Kini";
// eddie (print) start
    const print_pdf = "Cetak";
    const print_spt = "SLIP PANGGILAN TEMUDUGA";
    const print_sbdb = "SLIP BERJAYA DAPAT BIASISWA";
    const print_sstb = "SURAT SETUJU TERIMA BANTUAN KEMENTERIAN BELIA DAN SUKAN MALAYSIA";
    const print_lpp = "LAPORAN PELAKSANAAN PROGRAM";
    const print_pppb = "PERAKUAN PERMOHONAN PEMBERIAN BANTUAN";
// eddie (print) end
    const delete = "Hapus";
    const send = "Hantar";
    const view = "Papar";
    const other = "Lain-lain";
    const backToList = "Kembali Ke Senarai";
    const backToForm = "Kembali Ke Borang";
    const viewTitle = "Papar";
    const updateTitle = "Kemas Kini";
    const createTitle = "Tambah";
    const remove = "Keluarkan";
    const viewAttachment = "Papar Attachment";
    const downloadForm = "Muat Turun Borang";
    const removeImage = "Keluarkan Gambar";
    const mandatoryField = "Medan Mandatori";
    const yes = "Ya";
    const no = "Tidak";
    
    public static function getYesNoLabel($bool){
        $return = "Sedang Disemak";
        if(!is_null($bool)){
            if($bool){
                $return = "Ya";
            } else if(!$bool) {
                $return = "Tidak";
            } 
        }
        
        return $return;
    }
}