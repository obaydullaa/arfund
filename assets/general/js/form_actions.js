(function($){
    "use strict"

    $('[name=form_type]').on('change',function(){
        var formType = $(this).val();
        var extraFields = formGenerator.extraFields(formType);
        $('.extra_area').html(extraFields);
        $('.extra_area').find('select').select2({
            dropdownParent: $('#formGenerateModal')
        });
    }).change();
    
    
    $(document).on('click','.addOption',function(){
        var html = formGenerator.addOptions();
        $('.options').append(html);
    });
    
    $(document).on('click','.removeOption',function(){
        $(this).closest('.form-group').remove();
    });
    
    $(document).on('click','.editFormData',function () {
        formGenerator.formEdit($(this));
        $('.extra_area').find('select').select2({
            dropdownParent: $('#formGenerateModal')
        });
        
    });
    
    $(document).on('click','.removeFormData',function () {
        
        $(this).closest('.col-xl-4.col-lg-6.col-md-6').remove();
    });

    
    $('.form-generate-btn').on('click',function(){
        formGenerator.showModal();
    });
    
    
    var updateId = formGenerator.totalField;
    $(formGenerator.formClassName).submit(function (e) {
        updateId += 1;
        e.preventDefault();
        var form = $(this);
        console.log(form);
        var formItem = formGenerator.formsToJson(form);
        formGenerator.makeFormHtml(formItem,updateId);
        formGenerator.closeModal();
    });
})(jQuery)

