<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

// table reference
use app\models\RefSukan;
use app\models\RefJenisBantuanSue;
use app\models\RefKelayakanAkademik;
use app\models\RefBandar;
use app\models\RefNegeri;
use app\models\RefBank;
use app\models\RefAgama;
use app\models\RefStatusPermohonanSue;
use app\models\RefNegara;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bantuan-penganjuran-kursus-pegawai-teknikal-laporan-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
   <?php
    if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
   ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <pre style="text-align: center"><strong><?php echo GeneralLabel::maklumat_kejohanan_kursus_cap; ?></strong></pre>
    <?php
        echo FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'autoGenerateColumns' => true,
    'rows' => [
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
               'tarikh' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' =>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=> DateControl::classname(),
                    'ajaxConversion'=>false,
                    'options'=>[
                        'pluginOptions' => [
                            'autoclose'=>true,
                        ]
                    ],
                    'columnOptions'=>['colspan'=>3]],
                 'tempat' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true]],
                 
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tujuan_kursus_kejohanan' => ['type'=>Form::INPUT_TEXT,'options'=>['maxlength'=>true]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'bilangan_pasukan' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bilangan_peserta' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bilangan_pegawai_teknikal' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
                'bilangan_pembantu' => ['type'=>Form::INPUT_TEXT, 'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>true]],
            ]
        ],
    ]
]);
        ?>
    
    <?php // Upload
    if($model->laporan_bergambar){
        echo "<label>" . $model->getAttributeLabel('laporan_bergambar') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_bergambar , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'laporan_bergambar'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'laporan_bergambar' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    
    $label = $model->getAttributeLabel('penyata_perbelanjaan_resit_yang_telah_disahkan');
    
    if($model->penyata_perbelanjaan_resit_yang_telah_disahkan){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('penyata_perbelanjaan_resit_yang_telah_disahkan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->penyata_perbelanjaan_resit_yang_telah_disahkan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    if(!$readonly){
        echo "<div class='required'>";
        echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                    [
                        'columns'=>12,
                        'autoGenerateColumns'=>false, // override columns setting
                        'attributes' => [
                            'penyata_perbelanjaan_resit_yang_telah_disahkan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
        echo "<br>";
    }
        
    ?>
    
    <?php // Upload
    if($model->jadual_keputusan_pertandingan){
        echo "<label>" . $model->getAttributeLabel('jadual_keputusan_pertandingan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->jadual_keputusan_pertandingan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'jadual_keputusan_pertandingan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'jadual_keputusan_pertandingan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->senarai_peserta){
        echo "<label>" . $model->getAttributeLabel('senarai_peserta') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_peserta , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'senarai_peserta'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'senarai_peserta' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->statistik_penyertaan){
        echo "<label>" . $model->getAttributeLabel('statistik_penyertaan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->statistik_penyertaan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'statistik_penyertaan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'statistik_penyertaan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3], 'hint' => '( JURULATIH / ATLET (LELAKI / WANITA / BANGSA) )'],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->senarai_pegawai_penceramah){
        echo "<label>" . $model->getAttributeLabel('senarai_pegawai_penceramah') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_pegawai_penceramah , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'senarai_pegawai_penceramah'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'senarai_pegawai_penceramah' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <?php // Upload
    if($model->senarai_urusetia_sukarelawan){
        echo "<label>" . $model->getAttributeLabel('senarai_urusetia_sukarelawan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->senarai_urusetia_sukarelawan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id, 'field'=> 'senarai_urusetia_sukarelawan'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
    } else {
        echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'senarai_urusetia_sukarelawan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <br>
    
    <h3>Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan (Jika Ada)</h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                ],
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    
    <?php Pjax::begin(['id' => 'bantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        //'filterModel' => $searchModelBantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan,
        'id' => 'bantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id',
            //'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id',
            'kejohanan_kursus_seminar_bengkel',
            [
                'attribute' => 'tarikh_mula',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_mula, GeneralFunction::TYPE_DATE);
                },
            ],
            [
                'attribute' => 'tarikh_tamat',
                 'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_tamat, GeneralFunction::TYPE_DATE);
                },
            ],
            'tempat',
            'jumlah_kelulusan',
            'pendahuluan_80',
            // 'no_cek',
            // 'no_boucer',
            'jumlah_yang_dituntut_20',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan/delete', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id]).'", "'.GeneralMessage::confirmDelete.'", "bantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan/update', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id]).'", "'.GeneralLabel::updateTitle . ' Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan (Jika Ada)");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan/view', 'id' => $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id]).'", "'.GeneralLabel::viewTitle . ' Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan (Jika Ada)");',
                        ]);
                    }
                ],
                'template' => $template,
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
     <?php if(!$readonly): ?>
    <p>
        <?php 
        $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id = "";
        
        if(isset($model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id)){
            $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id = $model->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bantuan-penganjuran-kursus-pegawai-teknikal-laporan-tuntutan/create', 
                            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id
                                , 'kejohanan_kursus_seminar_bengkel' => $model->tujuan_kursus_kejohanan
                                , 'tarikh_mula' => $model->tarikh
                                , 'tarikh_tamat' => $model->tarikh_tamat
                                , 'tempat' => $model->tempat
                                , 'jumlah_kelulusan' => $model->jumlah_kelulusan
                                ]).'", "'.GeneralLabel::createTitle . ' Tuntutan Baki Dua Puluh Peratus (20%) Daripada Jumlah Kelulusan (Jika Ada)");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton(GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
