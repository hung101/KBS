<table width="100%" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center"><img src="<?php echo \Yii::$app->request->BaseUrl;?>/img/msn_logo.jpg" alt="" width="100"></td>
		<td align="center">
			<div class="titleSize text-bold"><?= strtoupper($title) ?></div><br />
                        MAJLIS SUKAN NEGARA
		</td>
	</tr>
</table>
<br>
<table>
    <tr>
        <td>SUKAN</td><td>:</td><td><?= $model->sukan ?></td>
    </tr>
    <tr>
        <td>NEGERI</td><td>:</td><td><?= $model->alamat_negeri ?></td>
    </tr>
</table>
<hr>
<br>
<div class="title-header-wrap" style="margin:20px 0px; padding:5px">
    BUTIRAN PUSAT
</div>
<section>
<table>
    <tr>
        <td>Nama</td><td>:</td><td colspan="4"><?= $model->nama_pusat_latihan ?></td>
    </tr>
    <tr>
        <td valign="top">Alamat</td><td valign="top">:</td><td><?= ($model->alamat_1)?$model->alamat_1.'<br />':null ?><?= ($model->alamat_2)?$model->alamat_2.'<br />':null ?><?= ($model->alamat_3)?$model->alamat_3.'<br />':null ?></td>
    </tr>
    <tr>
        <td >Poskod</td><td >:</td><td ><?= ($model->alamat_poskod)?$model->alamat_poskod:null ?></td>
        <td style="padding-left:140px">Bandar</td><td >:</td><td><?= ($model->alamat_bandar)?$model->alamat_bandar:null ?></td>
    </tr>
    <tr>
        <td>Negeri</td><td>:</td><td colspan="4"><?= ($model->alamat_negeri)?$model->alamat_negeri:null ?></td>
    </tr>
    <tr>
        <td >No Tel</td><td >:</td><td ><?= ($model->no_telefon)?$model->no_telefon:null ?></td>
        <td style="padding-left:140px">No Fax</td><td >:</td><td><?= ($model->no_faks)?$model->no_faks:null ?></td>
    </tr>
    <tr>
        <td >Hakmilik</td><td >:</td><td ><?= ($model->hakmilik)?$model->hakmilik:null ?></td>
        <td style="padding-left:140px">Sewaan</td><td >:</td><td><?= ($model->kadar_sewaan)?$model->kadar_sewaan:null ?></td>
    </tr>
</table>
<br>
</section>


<section>
<h4>Kemudahan</h4>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>BIL</th>
            <th>JENIS KEMUDAHAN</th>
            <th>SUKAN</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1;
            foreach($ProfilPusatLatihanKemudahan as $item){
                
                $SukanListID = explode(',', $item->sukan);
                $SukanListName = "";

                foreach($SukanListID as $SukanID){
                    $ref = app\models\RefSukan::findOne(['id' => $SukanID]);
                    if($SukanListName != ""){
                        $SukanListName .= ', ';
                    }
                    $SukanListName .= $ref['desc'];
                }

            ?>
                    <tr>
                            <td align="center"><?= $count ?></td>
                            <td align="center"><?= ($item['refJenisKemudahan']['desc'])?$item['refJenisKemudahan']['desc']:null ?></td>
                            <td align="center"><?= $SukanListName ?></td>
                    </tr>
            <?php
                    $count++;
            }
            
            if($count==1){?>
                <tr>
                    <td align="center" colspan="3">TIADA REKOD</td>
                </tr>
            <?php } ?>
            
    </tbody>
</table>
<br>
</section>


<section>
<h4>Peralatan</h4>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>BIL</th>
            <th>NAMA PERALATAN</th>
            <th>STATUS PERALATAN</th>
            <th>SUKAN</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1;
            foreach($ProfilPusatLatihanPeralatan as $item){
                
                $SukanListID = explode(',', $item->sukan);
                $SukanListName = "";

                foreach($SukanListID as $SukanID){
                    $ref = app\models\RefSukan::findOne(['id' => $SukanID]);
                    if($SukanListName != ""){
                        $SukanListName .= ', ';
                    }
                    $SukanListName .= $ref['desc'];
                }

            ?>
                    <tr>
                            <td align="center"><?= $count ?></td>
                            <td align="center"><?= ($item->nama_peralatan)?$item->nama_peralatan:null ?></td>
                            <td align="center"><?= ($item->status_peralatan)?$item->status_peralatan:null ?></td>
                            <td align="center"><?= $SukanListName ?></td>
                    </tr>
            <?php
                    $count++;
            }
            
            if($count==1){?>
                <tr>
                    <td align="center" colspan="4">TIADA REKOD</td>
                </tr>
            <?php } ?>
            
    </tbody>
</table>
<br>
</section>

