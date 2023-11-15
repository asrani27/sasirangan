/*
 Template Name: Agroxa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Xeditable js
 */

$(function () {

    //modify buttons style
    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
        '<button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>';


    //inline

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.update').editable({

           url: '/data/bahan/update',
           type: 'text',
           pk: 1,
           name: 'username',
           title: 'Enter name',
           mode: 'inline',
           dataType: 'JSON',
           
           params: function(params) {
               
            params.name = $(this).editable().data('name');
            console.log(params);
            return params;
        }

    });
    
    $('.inline-username').editable({
        type: 'post',
        url: '/input/harga/updat',
        pk: 1,
        name: 'username',
        title: 'Enter username',
        mode: 'inline',
        inputclass: 'form-control-sm',
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Only numbers are allowed';
            }
        },
        params: function(params) {
               
            params.pasar = $(this).editable().data('pasar');
            params.tanggal = $(this).editable().data('tanggal');
            
            return params;
        }
    });
    $('.inline-username2').editable({
        type: 'post',
        url: '/input/stok/update',
        pk: 1,
        name: $(this).editable().data('pasar_id'),
        title: 'Enter username',
        mode: 'inline',
        inputclass: 'form-control-sm',
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Only numbers are allowed';
            }
        },
        params: function(params) {               
            params.pasar_id = $(this).editable().data('pasar_id');
            params.minggu = $(this).editable().data('minggu');
            params.bulan = $(this).editable().data('bulan');
            params.tahun = $(this).editable().data('tahun');
            return params;
        }
    });
    
    $('#inline-username2').editable({
        type: 'text',
        pk: 2,
        name: 'username',
        title: 'Enter username',
        mode: 'inline',
        inputclass: 'form-control-sm'
    });

    $('#inline-firstname').editable({
        validate: function (value) {
            if ($.trim(value) == '') return 'This field is required';
        },
        mode: 'inline',
        inputclass: 'form-control-sm'
    });

    $('#inline-sex').editable({
        prepend: "not selected",
        mode: 'inline',
        inputclass: 'form-control-sm',
        source: [
            {value: 1, text: 'Male'},
            {value: 2, text: 'Female'}
        ],
        display: function (value, sourceData) {
            var colors = {"": "#98a6ad", 1: "#5fbeaa", 2: "#5d9cec"},
                elem = $.grep(sourceData, function (o) {
                    return o.value == value;
                });

            if (elem.length) {
                $(this).text(elem[0].text).css("color", colors[value]);
            } else {
                $(this).empty();
            }
        }
    });

    $('#inline-status').editable({
        mode: 'inline',
        inputclass: 'form-control-sm'
    });

    $('#inline-group').editable({
        showbuttons: false,
        mode: 'inline',
        inputclass: 'form-control-sm'
    });

    $('#inline-dob').editable({
        mode: 'inline',
        inputclass: 'form-control-sm'
    });

    $('#inline-comments').editable({
        showbuttons: 'bottom',
        mode: 'inline',
        inputclass: 'form-control-sm'
    });


});