<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-kedudukan-kewangan-penjamin-form">

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly]); ?>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
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
                'pendapatan_bulanan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'pinjaman_perumahan_baki_terkini' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'sebagai_penjamin_siberhutang' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
                'lain_lain_pinjaman_tanggungan' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>10]],
            ],
        ],
        [
            'attributes' => [
                'perkerjaan' => ['type'=>Form::INPUT_TEXT],
            ]
        ],
        [
            'attributes' => [
                'nama_alamat_majikan' => ['type'=>Form::INPUT_TEXTAREA],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'nama_isteri_suami' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>80]],
                'no_kp_isteri_suami' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>12]],
                'jumlah_anak' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>3],'options'=>['maxlength'=>80]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pertalian_keluarga_dengan_pelajar' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>90]],
            ]
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'pelajar_lain_selain_daripada_penerima_di_atas' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>5],'options'=>['maxlength'=>255]],
            ]
        ],
    ]
]);
        ?>
    
    <br>
    
    <h3>Jenis Harta</h3>
    
    <?php 
            Modal::begin([
                'header' => '<h3 id="modalTitle"></h3>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
            ]);
            
            echo '<div id="modalContent"></div>';
            
            Modal::end();
        ?>
    

    <?php Pjax::begin(['id' => 'bspKedudukanKewanganPenjaminJenisHartaGrid', 'timeout' => 100000]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProviderBspKedudukanKewanganPenjaminJenisHarta,
        //'filterModel' => $searchModelBspKedudukanKewanganPenjaminJenisHarta,
        'id' => 'bspKedudukanKewanganPenjaminJenisHartaGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_kedudukan_kewangan_penjamin_jenis_harta_id',
            //'bsp_kedudukan_kewangan_penjamin_id',
            //'jenis_harta',
            [
                'attribute' => 'jenis_harta',
                'value' => 'refJenisHarta.desc'
            ],
            'jumlah_ekar_kaki_persegi',
            'nilai',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-kedudukan-kewangan-penjamin-jenis-harta/delete', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id]).'", "'.GeneralMessage::confirmDelete.'", "bspKedudukanKewanganPenjaminJenisHartaGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-kedudukan-kewangan-penjamin-jenis-harta/update', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id]).'", "'.GeneralLabel::updateTitle . ' Jenis Harta");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-kedudukan-kewangan-penjamin-jenis-harta/view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id]).'", "'.GeneralLabel::viewTitle . ' Jenis Harta");',
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
        $bsp_kedudukan_kewangan_penjamin_id = "";
        
        if(isset($model->bsp_kedudukan_kewangan_penjamin_id)){
            $bsp_kedudukan_kewangan_penjamin_id = $model->bsp_kedudukan_kewangan_penjamin_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-kedudukan-kewangan-penjamin-jenis-harta/create', 'bsp_kedudukan_kewangan_penjamin_id' => $bsp_kedudukan_kewangan_penjamin_id]).'", "'.GeneralLabel::createTitle . ' Jenis Harta");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>

    <!--<?= $form->field($model, 'bsp_penjamin_id')->textInput() ?>

    <?= $form->field($model, 'pendapatan_bulanan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pinjaman_perumahan_baki_terkini')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'sebagai_penjamin_siberhutang')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'lain_lain_pinjaman_tanggungan')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'perkerjaan')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'nama_alamat_majikan')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nama_isteri_suami')->textInput(['maxlength' => 80]) ?>

    <?= $form->field($model, 'no_kp_isteri_suami')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'jumlah_anak')->textInput() ?>

    <?= $form->field($model, 'pertalian_keluarga_dengan_pelajar')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'pelajar_lain_selain_daripada_penerima_di_atas')->textInput(['maxlength' => 255]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
