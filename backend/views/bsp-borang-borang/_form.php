<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\general\Placeholder;

/* @var $this yii\web\View */
/* @var $model app\models\BspBorangBorang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-borang-borang-form">
    
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
        </div>
        <ul >
            <li >Sila muat turun borang-borang dan isi dengan betul.</li>
            <li >Sila muat naik selepas lengkap isi borang-borang yang muat turun.</li>
          </ul>
    </div>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>
    
    <?php
        if(!$readonly){
            $template = '{view} {update} {delete}';
        } else {
            $template = '{view}';
        }
    ?>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php // Senarai Semak Dokumen Untuk Tawaran Biasiswa Upload
    $label = $model->getAttributeLabel('bsp_01') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-01.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_01){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_01 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_01'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_01' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Borang Persetujuan Penerima Tawaran Biasiswa Upload
    $label = $model->getAttributeLabel('bsp_02') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-02.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_02){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_02 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_02'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_02' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Maklumat Pelajar dan Penjamin 1 & Penjamin 2 Upload
    
    $label = $model->getAttributeLabel('bsp_03') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-03.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_03){
        echo "<div class='required'>";
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_03 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'bsp_03' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php // Borang Perakuan Kedudukan Kewangan Penjamin 1 Upload
    
    $label = $model->getAttributeLabel('bsp_04') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-04.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_04){
        echo "<div class='required'>";
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_04 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'bsp_04' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php // Borang Perakuan Kedudukan Kewangan Penjamin 2 Upload
    
    $label = $model->getAttributeLabel('bsp_05') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-05.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_05){
        echo "<div class='required'>";
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_05 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
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
                            'bsp_05' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                        ],
                    ],
                ]
            ]);
        echo "</div>";
    }
        
    ?>
    
    <?php echo "<div class='required'><label>" . $model->getAttributeLabel('bsp_06') . " - " . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-06.pdf' , ['class'=>'btn-link', 'target'=>'_blank']) . "</label></div>"; ?>
    
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
    
    <?php Pjax::begin(['id' => 'bspPrestasiAkademikGrid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBspPrestasiAkademik,
        //'filterModel' => $searchModelBspPrestasiAkademik,
        'id' => 'bspPrestasiAkademikGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_prestasi_akademik_id',
            //'bsp_pemohon_id',
            'tarikh',
            'png',
            'pngk',
            [
                'attribute' => 'semester',
                'value' => 'refSemesterTerkini.desc'
            ],
            [
                'attribute' => 'muat_naik',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->muat_naik){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->muat_naik .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-prestasi-akademik/delete', 'id' => $model->bsp_prestasi_akademik_id]).'", "'.GeneralMessage::confirmDelete.'", "bspPrestasiAkademikGrid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-prestasi-akademik/update', 'id' => $model->bsp_prestasi_akademik_id]).'", "'.GeneralLabel::updateTitle . ' KBS/BSP-06 - Borang Maklumat Terkini Prestasi Akademik/Sukan Mengikut Semester");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-prestasi-akademik/view', 'id' => $model->bsp_prestasi_akademik_id]).'", "'.GeneralLabel::viewTitle . ' KBS/BSP-06 - Borang Maklumat Terkini Prestasi Akademik/Sukan Mengikut Semester");',
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
        $bsp_borang_borang_id = "";
        
        if(isset($model->bsp_borang_borang_id)){
            $bsp_borang_borang_id = $model->bsp_borang_borang_id;
        }
        
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>', 'javascript:void(0);', [
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-prestasi-akademik/create', 'bsp_borang_borang_id' => $bsp_borang_borang_id]).'", "'.GeneralLabel::createTitle . ' ' . $model->getAttributeLabel('bsp_06') . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_07') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-07.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_07){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_07 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_07'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_07' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_08') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-08.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_08){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_08 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_08'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_08' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_09') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-09.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_09){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_09 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_09'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_09' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php echo "<label>" . $model->getAttributeLabel('bsp_10') . " - " . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-10.pdf' , ['class'=>'btn-link', 'target'=>'_blank']) . "</label>"; ?>
    
    <?php Pjax::begin(['id' => 'bspBorang10Grid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBspBorang10,
        //'filterModel' => $searchModelBspBorang10,
        'id' => 'bspPrestasiAkademikGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_borang_10_id',
            //'bsp_borang_borang_id',
            [
                'attribute' => 'bsp_10',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->bsp_10){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->bsp_10 .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',
            

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-borang-10/delete', 'id' => $model->bsp_borang_10_id]).'", "'.GeneralMessage::confirmDelete.'", "bspBorang10Grid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-10/update', 'id' => $model->bsp_borang_10_id]).'", "'.GeneralLabel::updateTitle . ' KBS/BSP-10 - Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-10/view', 'id' => $model->bsp_borang_10_id]).'", "'.GeneralLabel::viewTitle . ' KBS/BSP-10 - Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-10/create', 'bsp_borang_borang_id' => $bsp_borang_borang_id]).'", "'.GeneralLabel::createTitle . ' ' . $model->getAttributeLabel('bsp_10') . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    <?php echo "<label>" . $model->getAttributeLabel('bsp_11') . " - " . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-11.pdf' , ['class'=>'btn-link', 'target'=>'_blank']) . "</label>"; ?>
    
    <?php Pjax::begin(['id' => 'bspBorang11Grid', 'timeout' => 100000]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderBspBorang11,
        //'filterModel' => $searchModelBspBorang11,
        'id' => 'bspPrestasiAkademikGrid',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_borang_11_id',
            //'bsp_borang_borang_id',
            [
                'attribute' => 'bsp_11',
                'format' => 'raw',
                'value'=>function ($model) {
                    if($model->bsp_11){
                        return Html::a(GeneralLabel::viewAttachment, 'javascript:void(0);', 
                                        [ 
                                            'onclick' => 'viewUpload("'.\Yii::$app->request->BaseUrl.'/' . $model->bsp_11 .'");'
                                        ]);
                    } else {
                        return "";
                    }
                },
            ],
            //'session_id',
            //'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',
            

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Delete'),
                        'onclick' => 'deleteRecordModalAjax("'.Url::to(['bsp-borang-11/delete', 'id' => $model->bsp_borang_11_id]).'", "'.GeneralMessage::confirmDelete.'", "bspBorang11Grid");',
                        //'data-confirm' => 'Czy na pewno usunąć ten rekord?',
                        ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'Update'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-11/update', 'id' => $model->bsp_borang_11_id]).'", "'.GeneralLabel::updateTitle . ' KBS/BSP-10 - Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara");',
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 'javascript:void(0);', [
                        'title' => Yii::t('yii', 'View'),
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-11/view', 'id' => $model->bsp_borang_11_id]).'", "'.GeneralLabel::viewTitle . ' KBS/BSP-10 - Borang Permohonan Bayaran Tuntutan Elaun Perjalanan Udara");',
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
                        'onclick' => 'loadModalRenderAjax("'.Url::to(['bsp-borang-11/create', 'bsp_borang_borang_id' => $bsp_borang_borang_id]).'", "'.GeneralLabel::createTitle . ' ' . $model->getAttributeLabel('bsp_11') . '");',
                        'class' => 'btn btn-success',
                        ]);?>
    </p>
    <?php endif; ?>
    
    <br>
    
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_12') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-12.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_12){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_12 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_12'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_12' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_13') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-13.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_13){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_13 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_13'], 
            [
                'class'=>'btn btn-danger', 
                'data' => [
                    'confirm' => GeneralMessage::confirmRemove,
                    'method' => 'post',
                ]
            ]).'<p>';
        }
        echo '<br>';
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
                        'bsp_13' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <?php // Borang Pengesahan Tuntutan Elaun Tesis
    $label = $model->getAttributeLabel('bsp_14') . ' - ' . Html::a(GeneralLabel::downloadForm, \Yii::$app->request->BaseUrl.'/downloads/permohonan_e_biasiswa/BSP-14.pdf' , ['class'=>'btn-link', 'target'=>'_blank']);
    
    if($model->bsp_14){
        echo "<label>" . $label . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->bsp_14 , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_borang_borang_id, 'field'=> 'bsp_14'], 
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
                        'bsp_14' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3],'label'=>$label],
                    ],
                ],
            ]
        ]);
    }
    ?>
    
    <!--
    <?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'bsp_03')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_04')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_05')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_07')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_08')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_09')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bsp_14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::send : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
