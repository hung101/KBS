<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bsp-elaun-latihan-praktikal-form">
    
    <div class="panel panel-danger">
        <div class="panel-body">
            <strong>Arahan</strong>
  </div>
        <ul>
            <li >Borang ini hanya untuk kegunaan Penerima Biasiswa Sukan Persekutuan KBS.</li>
            <li >Tuntutan ini hendaklah dibuat selepas tamat praktikal dan perlu dikemukakan dalam tempoh 1 bulan.</li>
            <li >Sila sertakan surat dari Fakulti / Jabatan / Majikan sebagai bukti pengesahan latihan praktikal.</li>
        </ul>
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
                'jenis_latihan_amali' => ['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[''=>'-- Pilih Latihan Amali --'],'columnOptions'=>['colspan'=>3]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tempat_latihan_praktikal' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>4],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'tarikh_mula' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'tarikh_tamat' => ['type'=>Form::INPUT_WIDGET, 'widgetClass'=>'\kartik\widgets\DatePicker','columnOptions'=>['colspan'=>3]],
                'jumlah_hari' => ['type'=>Form::INPUT_TEXT,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>90]],
            ],
        ],
        [
            'columns'=>12,
            'autoGenerateColumns'=>false, // override columns setting
            'attributes' => [
                'muat_naik' => ['type'=>Form::INPUT_FILE,'columnOptions'=>['colspan'=>2],'options'=>['maxlength'=>90]],
            ],
        ],
    ]
]);
        ?>
    <br>
    <br>
    <p>
        <?= Html::a('Tambah Praktikal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bsp_elaun_latihan_praktikal_month_id',
            //'bsp_elaun_latihan_praktikal_id',
            'bulan',
            'jumlah_hari',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <!--<?= $form->field($model, 'bsp_pemohon_id')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput() ?>

    <?= $form->field($model, 'jenis_latihan_amali')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'tempat_latihan_praktikal')->textInput(['maxlength' => 90]) ?>

    <?= $form->field($model, 'tarikh_mula')->textInput() ?>

    <?= $form->field($model, 'tarikh_tamat')->textInput() ?>

    <?= $form->field($model, 'jumlah_hari')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Hantar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
