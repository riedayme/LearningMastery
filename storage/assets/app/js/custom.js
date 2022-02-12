/**
 * Module LSM Course
 */
 $(".button-section-create").click(function() {
    $(".input-section-title,.input-section-id").val('');
    $(".modal-title").html($(this).data('modaltitle'));
})

 $('#modal-section').on('shown.bs.modal', function() {
    $(".input-section-title").focus();
})

 $(".button-section-update").on("click", function() {
    var title = $(this).data("title"),
    id = $(this).data("id");
    $(".modal-title").html($(this).data('modaltitle'));
    $(".input-section-title").val(title);
    $(".input-section-id").val(id);    
});

 function FormatCurrency(objNum)
 {
   var num = objNum.value
   var ent, dec;
   if (num != '' && num != objNum.oldvalue)
   {
     num = HapusTitik(num);
     if (isNaN(num))
     {
       objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
   } else {
       var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
       if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
       {
         alert(num.split('.')[1]);
         objNum.value = TambahTitik(num.split('.')[0])+'.'+num.split('.')[1];
     }
     else
     {
         objNum.value = TambahTitik(num.split('.')[0]);
     }
     objNum.oldvalue = objNum.value;
 }
}
}
function HapusTitik(num)
{
   return (num.replace(/\./g, ''));
}

function TambahTitik(num)
{
   numArr=new String(num).split('').reverse();
   for (i=3;i<numArr.length;i+=3)
   {
     numArr[i]+='.';
 }
 return numArr.reverse().join('');
} 

$.urlParam = function(name = 'courses'){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results || 0;
}

$('#tab-courses').click(function() {
    window.history.pushState('obj', 'newtitle', window.location.href.split('?')[0] );
});

$('#tab-material').click(function() {
    if ($.urlParam('tab') === 0) {        
        window.history.pushState('obj', 'newtitle', window.location.href +'?tab=material');
    }
});


/**
 * Module LMS Category
 */
 $('.category-parent').on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional == 'None') {
        $('.input-parent').show();
    } else {
        $('.input-parent').hide();
    }
});


/**
 * Module Alert
 */

 $(".alert-automatic").fadeTo(1000, 500).fadeOut(500, function() {
    $(".alert-automatic").fadeOut(500);
});

/**
 * Module Setting General, Meta
 */
 $('.select-schema').on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional == 'Organization') {
        $('.type-organization').show();
        $('.type-person').hide();
    } else {
        $('.type-organization').hide();
        $('.type-person').show();
    }
});

 $('.select-comment-type').on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional == 'Disable') {
        $('.type-system').hide();
        $('.type-disqus').hide();
    }
    else if (optional == 'System') {
        $('.type-system').show();
        $('.type-disqus').hide();
    } else {
        $('.type-system').hide();
        $('.type-disqus').show();
    }
});

 $('.select-payment').on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional == 'Manual') {
        $('.type-manual').show();
        $('.type-midtrans').hide();
    } else {
        $('.type-manual').hide();
        $('.type-midtrans').show();
    }
});

 $('.select-cookie').on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional == 'Yes') {
        $('.cookie-message').show();
    } else {
        $('.cookie-message').hide();
    }
});


/**
 * Module Setting Payment
 */

 $(".button-payment-transaction-create").click(function() {
    $(".input-transaction-type").val(null).trigger('change');
    $(".input-transaction-account_number,.input-transaction-receiver,.input-transaction-identity").val('');
    $('#form-transaction').on('shown.bs.modal', function() {
        $(".input-transaction-type").focus();
    })
});

 $(".button-payment-transaction").on("click", function() {
    $(".input-transaction-type").val($(this).data("type")).trigger('change');
    $(".input-transaction-account_number").val($(this).data("account_number"));
    $(".input-transaction-receiver").val($(this).data("receiver"));    
    $(".input-transaction-identity").val($(this).data("identity"));    
});

 $(".button-payment-confirmation-create").click(function() {
    $(".input-confirmation-type").val(null).trigger('change');
    $(".input-confirmation-data,.input-confirmation-identity").val('');
    $('#form-confirmation').on('shown.bs.modal', function() {
        $(".input-confirmation-type").focus();
    })
});

 $(".button-payment-confirmation").on("click", function() {
    $(".input-confirmation-type").val($(this).data("type")).trigger('change');
    $(".input-confirmation-data").val($(this).data("data"));
    $(".input-confirmation-identity").val($(this).data("identity"));    
});

/**
* Module Blog Post, Blog Pages
*/

function open_popup(url) {
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);
    var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w +
        ",height=" + h + ",top=" + t + ",left=" + l);
}

/**
 * permalink
 */
 $('input[name="permalink_auto"]').click(function(){
    if($(this).is(":checked")) {
        if (this.value == 'auto') {
            $('input[name="permalink"]').attr('type','hidden'); 
            text = slugify($('#title').val());
            $('#permalink').val(text);            
        }else {
            $('input[name="permalink"]').attr('type','text');  
        }
    }
});

/**
 * image
 */
 $("#button-filemanager").click(function() {
    let iframe = $("<iframe/>", { src: $(this).data('src'), width: '100%', height: '600px', border: 'none' });
    $('.target-filemanager').html(iframe)
});

 if ($("#image").val()) {
    $('.btn-remove-image').show();
}else{
    $('.btn-remove-image').hide();
}

$('.btn-remove-image').on('click', function(e) {
    $("#image").val(''); 
    $('#preview-image').attr('src', $('#preview-image').data('default_image'));
    $(this).hide();
});

function responsive_filemanager_callback(){ 
    var base_url = $('#preview-image').data('base_url');
    var pict = $('#image').val();
    var url = base_url + pict;
    $('#preview-image').attr('src', url).show();
    $('.btn-remove-image').show();
}

/* https://stackoverflow.com/questions/11189136/fire-oninput-event-with-jquery */
$('#title').on('input', function() {
    let title = this;
    $('input[name="permalink_auto"]:checked').each(function() {
        if (this.value == 'auto') {
            text = slugify($(title).val());
            $('#permalink').val(text);            
        };
    });
});

/**
 * Select 2
 */
 $(".select2").select2({
    placeholder: "Select",
    width: '100%',
    minimumResultsForSearch: -1
});

 $(".select2-search").select2({
    placeholder: "Select",
    width: '100%',
});

/**
 * Select 2 Category
 */
 $(".select2category").select2({
    width: '100%',
    placeholder: "Select",
    tags: true,
    tokenSeparators: [','],
    closeOnSelect: true,
    casesensitive: true,
    createTag: function(params) {

        var term = $.trim(params.term);

        if (term === '') {
            return null;
        }
        return {
            id: params.term,
            text: params.term,
            newOption: true,
            newTag: true,
        }

    },
    templateResult: function(data) {
        var $result = $("<span></span>");

        $result.text(data.text);

        if (data.newOption) {
            $result.append(" <em>(new)</em>");
        }

        return $result;
    },
    insertTag: function(data, tag) {
        var $found = false;
        $.each(data, function(index, value) {
            if ($.trim(tag.text).toUpperCase() == $.trim(value.text).toUpperCase()) {
                $found = true;
            }
        });

        if (!$found) data.unshift(tag);
    }
});   

 if ($("select[name='id_category']").val()) {
    $('.btn-remove-category').show();
}else{
    $('.btn-remove-category').hide();
}

$('.btn-remove-category').on('click', function(e) {
    $("select[name='id_category']").val('').change(); 
    $(this).hide();
});

$("select[name='id_category']").on('change', function() {
    var optional = $(this).find('option:selected').text();
    if (optional) {
        $('.btn-remove-category').show();
    }
});

/**
 * Select 2 Tags
 */
 $(".select2tags").select2({
    width: '100%',
    placeholder: "Select",
    tags: true,
    tokenSeparators: [','],
    closeOnSelect: false,
    casesensitive: true,
    createTag: function(params) {

        var term = $.trim(params.term);

        if (term === '') {
            return null;
        }
        return {
            id: params.term,
            text: params.term,
            newOption: true,
            newTag: true,
        }

    },
    templateResult: function(data) {
        var $result = $("<span></span>");

        $result.text(data.text);

        if (data.newOption) {
            $result.append(" <em>(new)</em>");
        }

        return $result;
    },
    insertTag: function(data, tag) {
        var $found = false;
        $.each(data, function(index, value) {
            if ($.trim(tag.text).toUpperCase() == $.trim(value.text).toUpperCase()) {
                $found = true;
            }
        });

        if (!$found) data.unshift(tag);
    }
});


/**
 * sluger url
 * https://stackoverflow.com/questions/1053902/how-to-convert-a-title-to-a-url-slug-in-jquery
 */
 function slugify(string) {
  return string
  .toString()
  .trim()
  .toLowerCase()
  .replace(/\s+/g, "-")
  .replace(/[^\w\-]+/g, "")
  .replace(/\-\-+/g, "-")
  .replace(/^-+/, "")
  .replace(/-+$/, "");
}

/**
 * Modul Template Widget Link
 */
 function add_link(id_widget){
    var identity = '_' + Math.random().toString(36).substr(2, 9);
    var html = '\
    <div class="c-field u-mb-small col-md-5 '+identity+'">\
    <input required="" class="c-input" name="'+id_widget+'[link][text][]" type="text" placeholder="Enter Text">\
    </div>\
    <div class="c-field u-mb-small col-md-5 '+identity+'">\
    <input required="" class="c-input" name="'+id_widget+'[link][url][]" type="text" placeholder="https://example.com/">\
    </div>\
    <div class="c-field u-mb-small col-md-2 '+identity+'">\
    <button tabindex="-1" type="button" class="c-btn c-btn--danger" onclick="remove_link(\''+identity+'\')"><i class="fa fa-minus-circle fa-2x"></i></button>\
    </div>\
    ';
    $('.master-linking_'+ id_widget).append(html);
}

function remove_link(target){
    var message = confirm("Are you sure want to delete this item ?");
    if(message === true) {
        $("."+target).remove();
    }

}

/**
 * Module Widget
 */

 $('.single-action').on('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: $(this).data('title'),
        text: $(this).data('text'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            window.location.href = $(this).data('href');
        }
    })
});

/**
 * Module User
 */
 function toggle(id,button) {
    var password = document.getElementById(id);
    if (password.type == "password") {
        password.type = "text";
        button.innerHTML = '<i class="fa fa-eye"></i>';
    }
    else {
        password.type = "password";
        button.innerHTML = '<i class="fa fa-eye-slash"></i>';
    }
}