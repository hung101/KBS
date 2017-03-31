<?php
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\datecontrol\DateControl;

// table reference
use app\models\RefKategoriPermohonanProgramBinaan;
use app\models\RefJenisPermohonanProgramBinaan;
use app\models\RefSukan;
use app\models\RefAtletTahap;
use app\models\RefNegeri;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefStatusPermohonanProgramBinaan;
use app\models\RefJenisPermohonan;
use app\models\RefTahapProgramBinaan;
use app\models\RefKategoriProgramBinaan;
//
use app\models\RefJenisLaporan;
use app\models\RefJenisAktivitiLaporanPenganjuran;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

$this->title = GeneralLabel::laporan_penganjuran_penyertaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_program_binaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_program_binaan, 'url' => ['view', 'id' => $parentModel->pengurusan_program_binaan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-program-binaan-laporan-penganjuran">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if($readonly): ?>
            <?= Html::a(GeneralLabel::update, ['laporan-penganjuran', 'id' => $model->pengurusan_program_binaan_id, 'readonly' => false], ['class' => 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(isset($model->pengurusan_program_binaan_laporan_penganjuran_id) && $readonly): ?>
        <?= Html::a(GeneralLabel::cetak, ['print-laporan-penganjuran', 'id' => $parentModel->pengurusan_program_binaan_id], ['class' => 'btn btn-success custom_button', 'target' => '_blank']) ?><br /><br />
    <?php endif; ?>


    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
            
            $pengurusan_program_binaan_id = "";
        
            if(isset($parentModel->pengurusan_program_binaan_id)){
                $pengurusan_program_binaan_id = $parentModel->pengurusan_program_binaan_id;
            }
            
        } else {
            $template = '{view}';
        }
        
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
    
    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    
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
                            'jenis_laporan' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                    [
                                        'append' => [
                                            'content' => Html::a(Html::icon('edit'), ['/ref-jenis-laporan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : null,
                                    'data'=>ArrayHelper::map(RefJenisLaporan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                     'options' => ['placeholder' => Placeholder::jenis_laporan],
                                        'pluginOptions' => [
                                        'allowClear' => true
                                    ],],
                                'columnOptions'=>['colspan'=>3]],
                            'negeri' => [
                                'type'=>Form::INPUT_WIDGET, 
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                    [
                                        'append' => [
                                            'content' => Html::a(Html::icon('edit'), ['/ref-negeri/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                            'asButton' => true
                                        ]
                                    ] : null,
                                    'data'=>ArrayHelper::map(RefNegeri::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                    'options' => ['placeholder' => Placeholder::negeri],
                                        'pluginOptions' => [
                                        'allowClear' => true
                                    ],],
                                'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    ?>
    
    <h3><?php echo GeneralLabel::sukan; ?></h3>
    
    <?php Pjax::begin(['id' => 'pengurusanProgramBinaanLaporanPenganjuranSukanGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderProgramBinaanLaporanPenganjuranSukan,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'pengurusanProgramBinaanLaporanPenganjuranSukanGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'sukan_id',
                'value' => 'refSukan.desc'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['pengurusan-program-binaan-laporan-penganjuran-sukan/delete', 'id' => $model->laporan_penganjuran_sukan_id]).'", "'.GeneralMessage::confirmDelete.'", "pengurusanProgramBinaanLaporanPenganjuranSukanGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-laporan-penganjuran-sukan/update', 'id' => $model->laporan_penganjuran_sukan_id]).'", "'.GeneralLabel::updateTitle . ' Sukan");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-laporan-penganjuran-sukan/view', 'id' => $model->laporan_penganjuran_sukan_id]).'", "'.GeneralLabel::viewTitle . ' Sukan");',
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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['pengurusan-program-binaan-laporan-penganjuran-sukan/create', 'pengurusan_program_binaan_id' => $pengurusan_program_binaan_id]).'", "'.GeneralLabel::createTitle . ' Sukan");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php
/*         echo FormGrid::widget([
            'model' => $model,
            'form' => $form,
            'autoGenerateColumns' => true,
            'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                            'sukan' => [
                                    'type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2',
                                    'id' => 'pengurusanprogrambinaan-sukan',
                                    'name' => 'PengurusanProgramBinaan[sukan]',
                                    //'value' => $sukan_selected, // initial value
                                    'options'=>[
                                        'data'=>ArrayHelper::map(RefSukan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                        'options' => ['placeholder' => Placeholder::sukan, 'multiple' => true],
                                    'pluginOptions' => [
                                            'tags' => true,
                                            'maximumInputLength' => 10
                                        ]
                                    ],
                                'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]); */
    ?>
    
    <pre style="text-align: center"><strong>MAKLUMAT AKTIVITI</strong></pre>
    
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
                        'aktiviti' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
    ?>
    
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
                        'tahap' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-tahap-program-binaan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefTahapProgramBinaan::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::tahap],],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    ?>
    
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
                        'jenis_aktiviti' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-jenis-aktiviti-laporan-penganjuran/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefJenisAktivitiLaporanPenganjuran::find()->where(['=', 'aktif', 1])->all(),'id', 'desc'),
                                  'options' => ['placeholder' => Placeholder::jenisAktiviti],
                                    'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    ?>
    
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
                        'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>true]],
                    ],
                ],
            ]
        ]);
    ?>
    
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
                        'tarikh_mula' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                        'columnOptions'=>['colspan'=>3]],
                        'tarikh_tamat' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                        'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    ?>
   
    <pre style="text-align: center"><strong>MAKLUMAT PESERTA</strong></pre>
    
    <table align="center" border="0">
        <tr>
            <td style="border:none"></td><td style="padding:10px 15px; text-align:center">ATLET</td><td style="padding:10px 15px; text-align:center">JURULATIH</td><td style="padding:10px 15px; text-align:center">PEGAWAI</td><td style="padding:10px 15px; text-align:center">TEKNIKAL</td><td style="padding:10px 15px; text-align:center">URUSETIA</td>
        </tr>
        <tr>
            <td style="padding:10px 15px">LELAKI</td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'atlet_lelaki')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'jurulatih_lelaki')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'pegawai_lelaki')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'teknikal_lelaki')->textInput() ?></td>
            <td style="text-align:center"><?= $form->field($model, 'urusetia_lelaki')->textInput() ?></td>
        </tr>
        <tr>
            <td style="padding:10px 15px">WANITA</td>        
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'atlet_perempuan')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'jurulatih_perempuan')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'pegawai_perempuan')->textInput() ?></td>
            <td style="text-align:center; padding-right:20px"><?= $form->field($model, 'teknikal_perempuan')->textInput() ?></td>
            <td style="text-align:center"><?= $form->field($model, 'urusetia_perempuan')->textInput() ?></td>
        </tr>
    </table>
    <br />
    <pre style="text-align: center"><strong>MAKLUMAT PERBELANJAAN</strong></pre>
    <table border="0" width="92%" cellpadding="10" cellspacing="10" align="center">
      <tr>
        <th></th>
        <th></th>
        <th style="text-align:center">MSN</th>
        <th style="text-align:center">MS NEGERI/PSN</th>
      </tr>
      <tr>
        <td><?= GeneralLabel::peruntukan_dipohon ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td style="padding:0px 20px"><?= $form->field($model, 'peruntukan_dipohon_msn')->textInput()->label('') ?></td>
        <td style="padding:0px 0px 0px 20px"><?= $form->field($model, 'peruntukan_dipohon_psn')->textInput()->label('') ?></td>
      </tr>
      <tr>
        <td><?= GeneralLabel::peruntukan_dilulus ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td style="padding:0px 20px"><?= $form->field($model, 'peruntukan_dilulus_msn')->textInput()->label('') ?></td>
        <td style="padding:0px 0px 0px 20px"><?= $form->field($model, 'peruntukan_dilulus_psn')->textInput()->label('') ?></td>
      </tr>
      <tr>
        <td><?= GeneralLabel::jumlah_diterima ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td style="padding:0px 20px"><?= $form->field($model, 'jumlah_diterima_msn')->textInput()->label('') ?></td>
        <td style="padding:0px 0px 0px 20px"><?= $form->field($model, 'jumlah_diterima_psn')->textInput()->label('') ?></td>
      </tr>
      <tr>
        <td><?= GeneralLabel::jumlah_perbelanjaan ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td colspan="2" style="padding:0px 0px 0px 20px"><?= $form->field($model, 'jumlah_perbelanjaan')->textInput()->label('') ?></td>
      </tr>
      <tr>
        <td style="font-weight:bold"><?= GeneralLabel::perbelanjaan_sebenar ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td colspan="2" style="padding:0px 0px 0px 20px"><?= $form->field($model, 'perbelanjaan_sebenar')->textInput()->label('') ?></td>
      </tr>
      <tr>
        <td style="font-weight:bold"><?= GeneralLabel::baki_dituntut ?></td>
        <td align="right" style="font-weight:bold">RM</td>
        <td colspan="2" style="padding:0px 0px 0px 20px"><?= $form->field($model, 'baki_dituntut')->textInput()->label('') ?></td>
      </tr>
    </table>
    <br />
    <?php if(!$readonly): ?>
    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::update, ['class' => 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
    </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
    
</div>
