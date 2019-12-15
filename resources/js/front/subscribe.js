$(function () {
    // FILTERS
    let dataTable = $('#formSubscribe');
    if (dataTable.length < 1) {
        return false;
    }

    // alert(dataTable.data('action'))
    $(document).on("submit","#formSubscribe",function(e){
        var data = new FormData(this);
        if($("#formSubscribe")[0].checkValidity()) {
            //updateAllMessageForms();
            e.preventDefault();
            $.ajax({
                url         : dataTable.data('action'),
                type        : 'post',
                data        : data,
                dataType    : 'JSON',
                contentType : false,
                cache       : false,
                processData : false,
                beforeSend  : function (){
                    $('#loading').html('<div class="alert alert-info"><i class="fa fa-spinner fa-2x fa-spin"></i>&nbsp;Please wait for a few minutes</div>');
                },
                success : function (data) {
                    $('#loading').html('&nbsp;'+data.pesan);

                    if(data.success==true){
                        $("#loading").empty().html("<div class='alert alert-success'>"+data.message+"</div>");
                    }else{
                        $("#loading").empty().html("<pre>"+data.error+"</pre>");
                    }

                    document.getElementById("formSubscribe").reset();
                },
                error   :function() {  
                    $('#loading').html('<div class="alert alert-danger">Your request not Sent...</div>');
                }
            });
        }else console.log("invalid form");
    })
});