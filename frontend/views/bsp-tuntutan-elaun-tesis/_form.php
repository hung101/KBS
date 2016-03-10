<?php

use kartik\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\datecontrol\DateControl;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-tuntutan-elaun-tesis-form">
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
  </div>
        <ul>
            <li >Borang ini hanya untuk kegunaan Penerima Biasiswa Sukan Persekutuan Kementerian Belia dan Sukan Malaysia.</li>
            <li >Permohonan tuntuan elaun tesis hanya boleh dibuat setelah keputusan penilaian tesis diterima.</li>
            <li >Syarat-syarat tuntutan elaun tesis adalah seperti berikut:</li>
            <ul>
                <li >Tuntutan dibayar jika kursus mewajibkan pelajar menyediakan tesis;</li>
                <li >Sekali sepanjang tempoh pengajian;</li>
                <li >Sekurang-kurangnya 6 jam kredit dan disediakan secara individu;</li>
                <li >Mendapat surat pengesahan IPT; dan</li>
                <li >Buku tesis lengkap <i>(hard cover)</i> ditandatangani oleh penerima dan penyelia/pensyarah.</li>
            </ul>
            <li>Borang pengesahan yang telah lengkap hendaklah dikemukakan ke:</li>
        </ul>
        <p style="padding-left:60px;">
                Kementerian Belia dan Sukan <br>
                Cawangan Pembangunan Sumber Manusia,<br>
                Bahagian Pengurusan Sumber Manusia,<br>
                Aras 5, Menara KBS, No. 27 Persiaran Perdana Presint 4,<br>
                62570 Putrajaya.<br>
                (u.p.: Urusetia Biasiswa Sukan Persekutuan)
        </p>
        <br>
        <p style="padding-left:60px;">
            <strong><i>
                * Tuntutan yang tidak memunuhi syarat di atas akan ditolak.
            </i></strong>
        </p>
    </div>

    <p class="text-muted"><span style="color: red">*</span> <?= GeneralLabel::mandatoryField?></p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL, 'staticOnly'=>$readonly, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    
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
                'tarikh' => [
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
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tajuk_tesis' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>90]],
            ],
        ],
    ]
]);
        ?>
    
    <?php // Muat Naik
    if($model->muat_naik){
        echo "<label>" . $model->getAttributeLabel('muat_naik') . "</label><br>";
        echo Html::a(GeneralLabel::viewAttachment, \Yii::$app->request->BaseUrl.'/' . $model->muat_naik , ['class'=>'btn btn-link', 'target'=>'_blank']) . "&nbsp;&nbsp;&nbsp;";
        if(!$readonly){
            echo Html::a(GeneralLabel::remove, ['deleteupload', 'id'=>$model->bsp_tuntutan_elaun_tesis_od, 'field'=> 'muat_naik'], 
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
                        'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>3]],
                    ],
                ],
            ]
        ]);
    }
    ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'tajuk_tesis')->textInput(['maxlength' => 90]) ?>-->

    <div class="form-group">
        <?php if(!$readonly): ?>
        <?= Html::submitButton($model->isNewRecord ? GeneralLabel::create : GeneralLabel::update, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
