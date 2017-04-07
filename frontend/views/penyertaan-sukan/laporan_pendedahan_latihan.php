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
use app\models\RefKategoriPenilaian;
use app\models\RefSukan;
use app\models\Atlet;
use app\models\PerancanganProgram;
use app\models\RefJenisAktiviti;
use app\models\RefPeringkatKejohananTemasya;
use app\models\RefProgramSemasaSukanAtlet;
use app\models\RefKategoriKejohanan;
use app\models\RefStatusKejohanan;
use app\models\RefJantina;
use app\models\RefAktivitiPendedahan;


// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

$this->title = GeneralLabel::laporan_pendedahan_latihan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penyertaan_sukan, 'url' => ['view', 'id' => $parentModel->penyertaan_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;

$penyertaan_sukan_id = "";

if(isset($parentModel->penyertaan_sukan_id)){
    $penyertaan_sukan_id = $parentModel->penyertaan_sukan_id;
}

$model->sukan = $parentModel->nama_sukan;
$model->tarikh_mula = $parentModel->tarikh_mula;
$model->tarikh_tamat = $parentModel->tarikh_tamat;
$model->tempat = $parentModel->tempat_penginapan;
?>
<div class="laporan-pendedahan-latihan">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(isset($model->laporan_pendedahan_latihan_id)): ?>
        <?= Html::a(GeneralLabel::cetak, ['print-laporan-pendedahan-latihan', 'id' => $parentModel->penyertaan_sukan_id], ['class' => 'btn btn-primary custom_button', 'target' => '_blank']) ?><br /><br />
    <?php endif; ?>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'id'=>$model->formName(), 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
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
                        'aktiviti' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-aktiviti-pendedahan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefAktivitiPendedahan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
                                 'options' => ['placeholder' => Placeholder::aktiviti],
                                    'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                        'sukan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefSukan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
                                 'options' => ['placeholder' => Placeholder::sukan],
                                    'pluginOptions' => [
                                    'allowClear' => true,
									'disabled' => true,
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                        'kategori_kejohanan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-kategori-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefKategoriKejohanan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
                                 'options' => ['placeholder' => Placeholder::kategori],
                                    'pluginOptions' => [
                                    'allowClear' => true
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                    ],
                ],
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
                                ],
								'options'=>['disabled'=>true]
                            ],
                            'columnOptions'=>['colspan'=>5]],
                        'tarikh_tamat' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ],
								'options'=>['disabled'=>true]
                            ],
                            'columnOptions'=>['colspan'=>5]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'tempat' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>6],'options'=>['maxlength'=>true, 'disabled' => true]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'tarikh_bertolak' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>5]],
                        'tarikh_balik' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=> DateControl::classname(),
                            'ajaxConversion'=>false,
                            'options'=>[
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                ]
                            ],
                            'columnOptions'=>['colspan'=>5]],
                    ],
                ],
            ]
        ]);
    ?>
    <?= $form->field($model, 'objektif')->textarea(['rows' => '3']) ?>
    
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
    
    <br />
    
    <h3><?php echo GeneralLabel::pegawai; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPendedahanLatihanPegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPendedahanPegawai,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPendedahanLatihanPegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-pendedahan-latihan-pegawai/delete', 'id' => $model->laporan_pendedahan_latihan_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPendedahanLatihanPegawaiGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-pegawai/update', 'id' => $model->laporan_pendedahan_latihan_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-pegawai/view', 'id' => $model->laporan_pendedahan_latihan_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    }
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-pegawai/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pegawai.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    
    <br />
    
    <h3><?php echo GeneralLabel::jurulatih; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPendedahanLatihanJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPendedahanJurulatih,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPendedahanLatihanJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'format' => 'raw',
				'label' => GeneralLabel::nama,
				'value' => function ($data) {
					$query = \app\models\Jurulatih::findOne(['jurulatih_id' => $data->jurulatih_id]);
					return $query->nama;
				},
			],
            
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-pendedahan-latihan-jurulatih/delete', 'id' => $model->laporan_pendedahan_latihan_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPendedahanLatihanJurulatihGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-jurulatih/update', 'id' => $model->laporan_pendedahan_latihan_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-jurulatih/view', 'id' => $model->laporan_pendedahan_latihan_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    }
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-jurulatih/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jurulatih.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    
    <h3><?php echo GeneralLabel::atlet; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPendedahanLatihanAtletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPendedahanAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPendedahanLatihanAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'format' => 'raw',
				'label' => GeneralLabel::nama,
				'value' => function ($data) {
					$query = \app\models\Atlet::findOne(['atlet_id' => $data->atlet_id]);
					return $query->name_penuh;
				},
			],
            [
				'format' => 'raw',
				'label' => GeneralLabel::jantina,
				'value' => function ($data) {
					$query = \app\models\Atlet::findOne(['atlet_id' => $data->atlet_id]);
					return RefJantina::findOne(['id' => $query->jantina])->desc;
				},
			],
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-pendedahan-latihan-atlet/delete', 'id' => $model->laporan_pendedahan_latihan_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPendedahanLatihanAtletGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-atlet/update', 'id' => $model->laporan_pendedahan_latihan_atlet_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::atlet.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-atlet/view', 'id' => $model->laporan_pendedahan_latihan_atlet_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::atlet.'");',
                        ]);
                    }
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
    <p>
        <?php 
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-pendedahan-latihan-atlet/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::atlet.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    <?= $form->field($model, 'penginapan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'makan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'pengangkutan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'venue_latihan')->textarea(['rows' => '4']) ?>
    
    <?php // Upload
    
    $label = $model->getAttributeLabel('jadual_latihan');
    
    if(isset($model->jadual_latihan) && $model->jadual_latihan != '' && $model->jadual_latihan != null){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('jadual_latihan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->jadual_latihan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'jadual_latihan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    echo "<br />";
        
    ?>
    <?= $form->field($model, 'latihan_aktiviti')->textarea(['rows' => '4'])->label('Latihan / Aktiviti') ?>
    <?= $form->field($model, 'hal_lain')->textarea(['rows' => '4'])->label('Hal-Hal Lain') ?>
    
    <?php // Upload
    
    $label = $model->getAttributeLabel('laporan_kewangan');
    
    if(isset($model->laporan_kewangan) && $model->laporan_kewangan != '' && $model->laporan_kewangan != null){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('laporan_kewangan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->laporan_kewangan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        echo "</div>";
        
        $label = false;
    }
    
    echo FormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => true,
        'rows' => [
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
                        'laporan_kewangan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    ?> 
    
    <?= $form->field($model, 'rumusan')->textarea(['rows' => '4'])->label('Rumusan / Ulasan') ?>
    <br />
    <div class="form-group">
        <?= Html::submitButton(GeneralLabel::update, ['class' => 'btn btn-primary',
            'data' => [
                    'confirm' => GeneralMessage::confirmSave,
                ],]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
        
$('form#{$model->formName()}').on('beforeSubmit', function (e) {

    var form = $(this);

    $("form#{$model->formName()} input").prop("disabled", false);	
	$("#laporanpendedahanlatihan-sukan").prop("disabled", false);
	$("#laporanpendedahanlatihan-tempat").prop("disabled", false);

});
     

JS;
        
$this->registerJs($script);
?>