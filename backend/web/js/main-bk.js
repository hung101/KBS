function viewUpload(url){
    window.open(url);
}


function removeUploadModalAjax(url, confirmMsg, gridId){
    var r = confirm(confirmMsg);
       
    if (r == true) {
    
        $.ajax({
           url: url,
           type: 'post',
           success: function(html) {
                //console.log(html);
                $.pjax.defaults.timeout = 6000;
                $.pjax.reload({container:'#' + gridId});
                $('#modalContent').html(html);
           }
        });
    } else {
        return false;
    }
    
   return false;
}

function loadModalRenderAjax(url, modalTitle){
    $('#modalContent').html('');
    $('#modalTitle').html(modalTitle);
    $('#modal').modal('show')
                .find('#modalContent')
                .load(url);
    
   return false;
}

function deleteRecordModalAjax(url, confirmMsg, gridId){
    var r = confirm(confirmMsg);
       
    if (r == true) {
    
        $.ajax({
           url: url,
           type: 'post',
           success: function(html) {
               $.pjax.defaults.timeout = 50000;
               $.pjax.reload({container:'#' + gridId});
            //console.log(html);
           }
        });
    } else {
        return false;
    }
    
   return false;
}

function deleteRecordSubModalAjax(url, confirmMsg, gridId){
    var r = confirm(confirmMsg);
       
    if (r == true) {
    
        $.ajax({
           url: url,
           type: 'post',
           success: function(html) {
               var resArr = html.split("/pipe?");
               
                if(resArr[0] != 1){
                    $('#modalContent').html(resArr[1]);
                } else {
                    $.pjax.defaults.timeout = 100000;
                    $.pjax.reload({container:'#keputusanGrid'});
                    //$('#' + gridId).html(resArr[1]);
                }
            //console.log(html);
           }
        });
    } else {
        return false;
    }
    
   return false;
}


function updateRenderAjax(url, tabId){
    $("#" + tabId).showLoading();
        
    $.ajax({
       url: url,
       type: 'post',
       success: function(html) {
        //console.log(html);
            $("#" + tabId).hideLoading();
           $("#" + tabId).html(html);
       }
    });
    
   return false;
}
        
function deleteRecordAjax(url, tabId, confirmMsg){
    var r = confirm(confirmMsg);
       
    if (r == true) {
        $("#" + tabId).showLoading();
    
        $.ajax({
           url: url,
           type: 'post',
           success: function(html) {
            //console.log(html);
                $("#" + tabId).hideLoading();
               $("#" + tabId).html(html);
           }
        });
    } else {
        return false;
    }
    
   return false;
}

// atlet pendidikan form submit
$('body').on('beforeSubmit', 'form#atlet_pendidikan_form', function () {
    var tabId = 'pendidikan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet karrier form submit
$('body').on('beforeSubmit', 'form#atlet_karrier_form', function () {
    var tabId = 'karrier_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet karrier form submit
$('body').on('beforeSubmit', 'form#atlet_aset_form', function () {
    var tabId = 'aset_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet perubatan form submit
$('body').on('beforeSubmit', 'form#atlet_perubatan_form', function () {
    var tabId = 'perubatan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet perubatan sejarah form submit
$('body').on('beforeSubmit', 'form#atlet_perubatan_sejarah_form', function () {
    var tabId = 'perubatan_sejarah_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet perubatan doktor form submit
$('body').on('beforeSubmit', 'form#atlet_perubatan_doktor_form', function () {
    var tabId = 'perubatan_doktor_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet perubatan insurans form submit
$('body').on('beforeSubmit', 'form#atlet_perubatan_insurans_form', function () {
    var tabId = 'perubatan_insurans_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet perubatan donator form submit
$('body').on('beforeSubmit', 'form#atlet_perubatan_donator_form', function () {
    var tabId = 'perubatan_donator_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet kewangan akaun form submit
$('body').on('beforeSubmit', 'form#atlet_kewangan_akaun_form', function () {
    var tabId = 'kewangan_akaun_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet kewangan elaun form submit
$('body').on('beforeSubmit', 'form#atlet_kewangan_elaun_form', function () {
    var tabId = 'kewangan_elaun_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet kewangan insentif form submit
$('body').on('beforeSubmit', 'form#atlet_kewangan_insentif_form', function () {
    var tabId = 'kewangan_insentif_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet pembangunan kursus/kem form submit
$('body').on('beforeSubmit', 'form#atlet_pembangunan_kursuskem_form', function () {
    var tabId = 'pembangunan_kursuskem_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet pembangunan kaunseling form submit
$('body').on('beforeSubmit', 'form#atlet_pembangunan_kaunseling_form', function () {
    var tabId = 'pembangunan_kaunseling_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet pembangunan kemahiran form submit
$('body').on('beforeSubmit', 'form#atlet_pembangunan_kemahiran_form', function () {
    var tabId = 'pembangunan_kemahiran_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet sukan form submit
$('body').on('beforeSubmit', 'form#atlet_sukan_form', function () {
    var tabId = 'sukan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet sukan persatuan/persekutuan dunia form submit
$('body').on('beforeSubmit', 'form#atlet_sukan_persatuanpersekutuandunia_form', function () {
    var tabId = 'sukan_persatuanpersekutuandunia_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet pakaian sukan form submit
$('body').on('beforeSubmit', 'form#atlet_pakaian_sukan_form', function () {
    var tabId = 'pakaian_sukan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet peralatan sukan form submit
$('body').on('beforeSubmit', 'form#atlet_peralatan_sukan_form', function () {
    var tabId = 'peralatan_sukan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet pencapaian form submit
$('body').on('beforeSubmit', 'form#atlet_pencapaian_form', function () {
    var tabId = 'pencapaian_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet anugerah form submit
$('body').on('beforeSubmit', 'form#atlet_pencapaian_anugerah_form', function () {
    var tabId = 'pencapaian_anugerah_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet penajaan form submit
$('body').on('beforeSubmit', 'form#atlet_penajaan_form', function () {
    var tabId = 'penajaan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet penajaan form submit
$('body').on('beforeSubmit', 'form#atlet_OKU_form', function () {
    var tabId = 'OKU_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// atlet keluarga form submit
$('body').on('beforeSubmit', 'form#atlet_keluarga_form', function () {
    var tabId = 'keluarga_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});


// jurulatih kelayakan form submit
$('body').on('beforeSubmit', 'form#jurulatih_kelayakan_form', function () {
    var tabId = 'kelayakan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// jurulatih pengalaman form submit
$('body').on('beforeSubmit', 'form#jurulatih_pengalaman_form', function () {
    var tabId = 'pengalaman_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// jurulatih pendidikan form submit
$('body').on('beforeSubmit', 'form#jurulatih_pendidikan_form', function () {
    var tabId = 'pendidikan_jurulatih_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// jurulatih kelayakan kursus tertinggi form submit
$('body').on('beforeSubmit', 'form#jurulatih_kelayakan_kursus_tertinggi_form', function () {
    var tabId = 'kelayakan_kursus_tertinggi_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// jurulatih kelayakan kursus tertinggi form submit
$('body').on('beforeSubmit', 'form#jurulatih_kesihatan_form', function () {
    var tabId = 'kesihatan_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});

// jurulatih keluarga form submit
$('body').on('beforeSubmit', 'form#jurulatih_keluarga_form', function () {
    var tabId = 'keluarga_jurulatih_tab';
    
     var form = $(this);
     // return false if form still have some validation errors
     //if (form.find('.has-error').length) {
       //  alert("false");
         // return false;
     //}
     
     $("#" + tabId).showLoading();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               // do something with response
               $("#" + tabId).hideLoading();
               $("#" + tabId).html(response);
          }
     });
     return false;
});