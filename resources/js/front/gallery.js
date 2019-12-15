$(function () {
    // FILTERS
    let dataTable = $('#tampilGalleryFile');
    if (dataTable.length < 1) {
        return false;
    }

    var per_page=6;

    function getFile(){
        var pilihgallery=$("#pilihgallery").val();

        $.ajax({
            url:dataTable.data('url')+"?per_page="+per_page+"&kode="+pilihgallery,
            type:"GET",
            beforeSend:function(){
                // $('[role="status"]').show();
                $("#tampilGalleryFile").empty().html("<div class='alert alert-info'>Please wait...</div>");
                $("#tampilLoadMore").empty();
            },
            success:function(result){
                // $('[role="status"]').hide();

                var el="";
                $.each(result,function(a,b){
                    el+='<div class="col-md-4 col-sm-6 col-xs-12 default-portfolio-item">';
                        if(b.file_type == "image"){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:321.73px; width:370px;" src="'+b.image_url+'" alt="">'+
                                '</figure>'+
                                '<div class="content" style="text-shadow: 2px 2px 4px black;">'+
                                    '<div class="inner-box imageGallery1">'+
                                        '<h3>'+b.title+'</h3>'+
                                        '<a href="'+b.image_url+'" rel="prettyPhoto[pp_gal]" class="bg-color-1 tampilfoto" alamat="'+b.image_url+'">View Photo</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                            // <a href="images/fullscreen/2.jpg" rel="prettyPhoto" title="This is the description">
                            //     <img src="images/thumbnails/t_2.jpg" width="60" height="60" alt="This is the title" /></a>
                        }else if(b.file_type == 'video'){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:321.73px; width:370px;" src="https://img.youtube.com/vi/'+b.video_url+'/mqdefault.jpg" alt="Kids Republic"></figure>'+
                                    '<div class="content">'+
                                        '<div class="inner-box imageGallery1">'+
                                            '<h3>'+b.title+'</h3>'+
                                            '<a testprety href="https://www.youtube.com/watch?v='+b.video_url+'" rel="prettyPhoto[gallery]" class="bg-color-1">View Video<span class=""></span></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                        }

                    el+='</div>';
                })

                var al="";
                if(result.length > 0){
                    al+='<div id="btnloadmore" class="link-btn center"><a href="javascript:void(0)" class="theme-btn btn-style-one">load more</a></div>';
                }

                $("#tampilGalleryFile").empty().html(el);
                $("#tampilLoadMore").empty().html(al);

                $('.imageGallery1 a').simpleLightbox();
            }
        })

    }

    $(document).on("click",".alamat",function(e){
        
    })

    $(document).on("click","#btnloadmore",function(e){
        e.preventDefault();
        per_page=per_page+6;

        getFile(per_page);

    });

    $(document).on("change","#pilihgallery",function(e){
        e.preventDefault();
        per_page=6;

        getFile(per_page);
    })

    getFile();
})    