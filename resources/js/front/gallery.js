$(function () {
    // FILTERS
    let dataTable = $('#tampilGalleryFile');
    if (dataTable.length < 1) {
        return false;
    }

    var per_page=6;

    function getFile(){
        $.ajax({
            url:dataTable.data('url')+"?per_page="+per_page,
            type:"GET",
            beforeSend:function(){
                // $('[role="status"]').show();
                $("#tampilGalleryFile").empty().html("<div class='alert alert-info'>Please wait...</div>");
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
                                    '<div class="inner-box">'+
                                        '<h3>'+b.title+'</h3>'+
                                        '<a href="'+b.image_url+'" rel="prettyPhoto[pp_gal]" class="bg-color-1">View Photo</a>'+
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
                                        '<div class="inner-box">'+
                                            '<h3>'+b.title+'</h3>'+
                                            '<a testprety href="https://www.youtube.com/watch?v='+b.video_url+'" rel="prettyPhoto[gallery]" class="bg-color-1">View Video<span class=""></span></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                        }

                    el+='</div>';
                })

                if(result.length > 0){
                    el+='<div id="btnloadmore" class="link-btn center"><a href="javascript:void(0)" class="theme-btn btn-style-one">load more</a></div>';
                }

                $("#tampilGalleryFile").empty().html(el);

                $("a[rel^='prettyPhoto']").prettyPhoto();
            }
        })

    }

    getFile();
})    