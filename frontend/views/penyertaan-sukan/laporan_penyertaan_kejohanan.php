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

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

$this->title = GeneralLabel::laporan_penyertaan_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penyertaan_sukan, 'url' => ['view', 'id' => $parentModel->penyertaan_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;

$penyertaan_sukan_id = "";

if(isset($parentModel->penyertaan_sukan_id)){
    $penyertaan_sukan_id = $parentModel->penyertaan_sukan_id;
}

$model->sukan = $parentModel->nama_sukan;
$model->nama_kejohanan = $parentModel->nama_kejohanan_temasya;
$model->tarikh_mula = $parentModel->tarikh_mula;
$model->tarikh_tamat = $parentModel->tarikh_tamat;
$model->tempat = $parentModel->tempat_penginapan;

?>
<div class="laporan-penyertaan-kejohanan">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(isset($model->laporan_penyertaan_kejohanan_id)): ?>
        <?= Html::a(GeneralLabel::cetak, ['print-laporan-penyertaan-kejohanan', 'id' => $parentModel->penyertaan_sukan_id], ['class' => 'btn btn-primary custom_button', 'target' => '_blank']) ?><br /><br />
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
                        'nama_kejohanan' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                // 'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                // [
                                    // 'append' => [
                                        // 'content' => Html::a(Html::icon('edit'), ['/ref-sukan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        // 'asButton' => true
                                    // ]
                                // ] : null,
                                'data'=>ArrayHelper::map(\app\models\PerancanganProgramPlan::find()->joinWith('refKategoriPelan')
                                        ->where(['LIKE', 'desc', 'kejohanan'])->all(),'perancangan_program_id', 'nama_program'),
                                'options' => ['placeholder' => Placeholder::kejohanan_temasya],
                                'pluginOptions' => [
                                    'allowClear' => true,
									'disabled' => true,
                                ],],
                            'columnOptions'=>['colspan'=>6]],
                    ],
                ],
                [
                    'columns'=>12,
                    'autoGenerateColumns'=>false, // override columns setting
                    'attributes' => [
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
                        'status' => [
                            'type'=>Form::INPUT_WIDGET, 
                            'widgetClass'=>'\kartik\widgets\Select2',
                            'options'=>[
                                'addon' => (isset(Yii::$app->user->identity->peranan_akses['Admin']['is_admin'])) ? 
                                [
                                    'append' => [
                                        'content' => Html::a(Html::icon('edit'), ['/ref-status-kejohanan/index'], ['class'=>'btn btn-success', 'target' => '_blank']),
                                        'asButton' => true
                                    ]
                                ] : null,
                                'data'=>ArrayHelper::map(RefStatusKejohanan::find()->where(['aktif' => 1])->all(),'id', 'desc'),
                                'options' => ['placeholder' => Placeholder::status],
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

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananPegawaiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananPegawai,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananPegawaiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-pegawai/delete', 'id' => $model->laporan_penyertaan_kejohanan_pegawai_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananPegawaiGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pegawai/update', 'id' => $model->laporan_penyertaan_kejohanan_pegawai_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pegawai.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pegawai/view', 'id' => $model->laporan_penyertaan_kejohanan_pegawai_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pegawai.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pegawai/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pegawai.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    
    <h3><?php echo GeneralLabel::pengurus; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananPengurusGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananPengurus,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananPengurusGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-pengurus/delete', 'id' => $model->laporan_penyertaan_kejohanan_pengurus_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananPengurusGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pengurus/update', 'id' => $model->laporan_penyertaan_kejohanan_pengurus_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::pengurus.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pengurus/view', 'id' => $model->laporan_penyertaan_kejohanan_pengurus_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::pengurus.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-pengurus/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::pengurus.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    
    <h3><?php echo GeneralLabel::jurulatih; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananJurulatihGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananJurulatih,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananJurulatihGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'format' => 'raw',
				'label' => GeneralLabel::nama,
				'value' => function ($data) {
					$query = \app\models\Jurulatih::findOne(['jurulatih_id' => $data->jurulatih_id]);
					return $query['nama'];
				},
			],
            
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-jurulatih/delete', 'id' => $model->laporan_penyertaan_kejohanan_jurulatih_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananJurulatihGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-jurulatih/update', 'id' => $model->laporan_penyertaan_kejohanan_jurulatih_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::jurulatih.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-jurulatih/view', 'id' => $model->laporan_penyertaan_kejohanan_jurulatih_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::jurulatih.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-jurulatih/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::jurulatih.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    
    <h3><?php echo GeneralLabel::atlet; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananAtletGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananAtlet,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananAtletGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'format' => 'raw',
				'label' => GeneralLabel::nama,
				'value' => function ($data) {
					$query = \app\models\Atlet::findOne(['atlet_id' => $data->atlet_id]);
					return $query['name_penuh'];
				},
			],
            [
				'format' => 'raw',
				'label' => GeneralLabel::jantina,
				'value' => function ($data) {
					$query = \app\models\Atlet::findOne(['atlet_id' => $data->atlet_id]);
					$ref =  RefJantina::findOne(['id' => $query->jantina]);
                                        return $ref['desc'];
				},
			],
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-atlet/delete', 'id' => $model->laporan_penyertaan_kejohanan_atlet_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananAtletGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-atlet/update', 'id' => $model->laporan_penyertaan_kejohanan_atlet_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::atlet.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-atlet/view', 'id' => $model->laporan_penyertaan_kejohanan_atlet_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::atlet.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-atlet/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::atlet.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <br />
    
    <?= $form->field($model, 'penginapan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'makan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'pengangkutan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'venue_pertandingan')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'penyertaan_negara_lain')->textarea(['rows' => '4']) ?>

    <?php // Upload
    
    $label = $model->getAttributeLabel('jadual_pertandingan');
    
    if(isset($model->jadual_pertandingan) && $model->jadual_pertandingan != '' && $model->jadual_pertandingan != null){
        echo "<div class='required'>";
        echo "<label>" . $model->getAttributeLabel('jadual_pertandingan') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->jadual_pertandingan , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                        'jadual_pertandingan' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    echo "<br />";
        
    ?>
    
    <h3><?php echo GeneralLabel::prestasi_atlet_negara; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananPrestasiGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananPrestasi,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananPrestasiGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'format' => 'raw',
				'label' => GeneralLabel::nama,
				'value' => function ($data) {
					$query = \app\models\Atlet::findOne(['atlet_id' => $data->atlet_id]);
					return $query['name_penuh'];
				},
			],
            [
				'format' => 'raw',
				'label' => GeneralLabel::acara,
				'value' => function ($data) {
					$query = \app\models\RefAcara::findOne(['id' => $data->acara]);
					return $query['desc'];
				},
			],
            'sasaran',
            'pencapaian',
            'catatan',
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-prestasi/delete', 'id' => $model->laporan_penyertaan_kejohanan_prestasi_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananPrestasiGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-prestasi/update', 'id' => $model->laporan_penyertaan_kejohanan_prestasi_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::prestasi_atlet_negara.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-prestasi/view', 'id' => $model->laporan_penyertaan_kejohanan_prestasi_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::prestasi_atlet_negara.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-prestasi/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::prestasi_atlet_negara.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    
    <h3><?php echo GeneralLabel::kedudukan_ranking; ?></h3>

    <?php Pjax::begin(['id' => 'laporanPenyertaanKejohananRankingGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderKejohananRanking,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'id' => 'laporanPenyertaanKejohananRankingGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ranking',
            'negara',
            'emas',
            'perak',
            'gangsa',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['laporan-penyertaan-kejohanan-ranking/delete', 'id' => $model->laporan_penyertaan_kejohanan_ranking_id]).'", "'.GeneralMessage::confirmDelete.'", "laporanPenyertaanKejohananRankingGrid");',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-ranking/update', 'id' => $model->laporan_penyertaan_kejohanan_ranking_id]).'", "'.GeneralLabel::updateTitle . ' '.GeneralLabel::kedudukan_ranking.'");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-ranking/view', 'id' => $model->laporan_penyertaan_kejohanan_ranking_id]).'", "'.GeneralLabel::viewTitle . ' '.GeneralLabel::kedudukan_ranking.'");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['laporan-penyertaan-kejohanan-ranking/create', 'penyertaan_sukan_id' => $penyertaan_sukan_id]).'", "'.GeneralLabel::createTitle . ' '.GeneralLabel::kedudukan_ranking.'");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    
    <br />
    <?= $form->field($model, 'ulasan_prestasi')->textarea(['rows' => '4']) ?>
    <?= $form->field($model, 'rumusan_prestasi')->textarea(['rows' => '4']) ?>
    <br />
    
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
    echo "<br />";
        
    ?>
    <?= $form->field($model, 'rumusan')->textarea(['rows' => '4']) ?>
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
	$("#laporanpenyertaankejohanan-sukan").prop("disabled", false);
	$("#laporanpenyertaankejohanan-nama_kejohanan").prop("disabled", false);

});
     

JS;
        
$this->registerJs($script);
?>
