<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

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

    <p class="text-muted"><span style="color: red">*</span> lapangan mandatori</p>

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
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
                'tarikh' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tajuk_tesis' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>30]],
            ],
        ],
    ]
]);
        ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'tajuk_tesis')->textInput(['maxlength' => 90]) ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
