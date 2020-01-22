$(function () {
    // FILTERS
    let dataTable = $('#tampilGalleryFile');
    if (dataTable.length < 1) {
        return false;
    }

    var per_page=0;
    $("a[rel^='prettyPhoto']").prettyPhoto();

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
                $.each(result.default,function(a,b){
                    el+='<div class="col-md-4 col-sm-6 col-xs-12 default-portfolio-item">';
                        if(b.file_type == "image"){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:270px; width:370px;" src="'+b.image_url+'" alt="">'+
                                '</figure>'+
                                '<div class="content" style="text-shadow: 2px 2px 4px black;">'+
                                    '<div class="inner-box imageGallery1">'+
                                        '<h3>'+b.title+'</h3>'+
                                        '<a href="'+b.image_url+'" rel="prettyPhoto['+b.gallery_id+']" class="bg-color-1 tampilfoto" alamat="'+b.image_url+'">View Photo</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                            // <a href="images/fullscreen/2.jpg" rel="prettyPhoto" title="This is the description">
                            //     <img src="images/thumbnails/t_2.jpg" width="60" height="60" alt="This is the title" /></a>
                        }else if(b.file_type == 'video'){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:270px; width:370px;" src="https://img.youtube.com/vi/'+b.video_url+'/mqdefault.jpg" alt="Kids Republic"></figure>'+
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

                $.each(result.tambahan,function(a,b){
                    el+='<div class="col-md-4 col-sm-6 col-xs-12 default-portfolio-item" style="display:none;">';
                        if(b.file_type == "image"){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:270px; width:370px;" src="'+b.image_url+'" alt="">'+
                                '</figure>'+
                                '<div class="content" style="text-shadow: 2px 2px 4px black;">'+
                                    '<div class="inner-box imageGallery1">'+
                                        '<h3>'+b.title+'</h3>'+
                                        '<a href="'+b.image_url+'" rel="prettyPhoto['+b.gallery_id+']" class="bg-color-1 tampilfoto" alamat="'+b.image_url+'">View Photo</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                            // <a href="images/fullscreen/2.jpg" rel="prettyPhoto" title="This is the description">
                            //     <img src="images/thumbnails/t_2.jpg" width="60" height="60" alt="This is the title" /></a>
                        }else if(b.file_type == 'video'){
                            el+='<div class="inner-box">'+
                                '<figure class="image-box">'+
                                    '<img style="height:270px; width:370px;" src="https://img.youtube.com/vi/'+b.video_url+'/mqdefault.jpg" alt="Kids Republic"></figure>'+
                                    '<div class="content">'+
                                        '<div class="inner-box imageGallery1">'+
                                            '<h3>'+b.title+'</h3>'+
                                            '<a testprety href="https://www.youtube.com/watch?v='+b.video_url+'" rel="prettyPhoto['+b.gallery_id+']" class="bg-color-1">View Video<span class=""></span></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                        }

                    el+='</div>';
                })

                var al="";
                if(result.tambahan.length > 0){
                    al+='<div id="btnloadmore" class="link-btn center"><a href="javascript:void(0)" class="theme-btn btn-style-one">load more</a></div>';
                }

                if(per_page == 0){
                    al+='<div id="btnloadmore" class="link-btn center"><a href="javascript:void(0)" class="theme-btn btn-style-one">load more</a></div>';
                }

                $("#tampilGalleryFile").empty().html(el);
                // $("#tampilLoadMore").empty().html(al);

                $("[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed: 'normal',
                    opacity: 1,
                    show_title: true,
                    allow_resize: true,
                    counter_separator_label: '/',
                    theme: 'light_square',
                });
            }
        })

    }

    // $(document).on("click",".tampilfoto",function(e){
    //     e.preventDefault();

    //     var el='';

    //     el+='<div class="carousel slide article-slide" id="article-photo-carousel">'+
    //         '<div class="carousel-inner cont-slider">'+
    //             '<div class="item active">'+
    //                 '<img alt="" title="" src="http://placehold.it/600x400">'+
    //             '</div>'+
    //             '<div class="item">'+
    //                 '<img alt="" title="" src="http://placehold.it/600x400">'+
    //             '</div>'+
    //             '<div class="item">'+
    //                 '<img alt="" title="" src="http://placehold.it/600x400">'+
    //             '</div>'+
    //             '<div class="item">'+
    //                 '<img alt="" title="" src="http://placehold.it/600x400">'+
    //             '</div>'+
    //         '</div>'+
            
    //         '<ol class="carousel-indicators">'+
    //             '<li class="active" data-slide-to="0" data-target="#article-photo-carousel">'+
    //                 '<img alt="" src="http://placehold.it/250x180">'+
    //             '</li>'+
    //             '<li class="" data-slide-to="1" data-target="#article-photo-carousel">'+
    //                 '<img alt="" src="http://placehold.it/250x180">'+
    //             '</li>'+
    //             '<li class="" data-slide-to="2" data-target="#article-photo-carousel">'+
    //                 '<img alt="" src="http://placehold.it/250x180">'+
    //             '</li>'+
    //             '<li class="" data-slide-to="3" data-target="#article-photo-carousel">'+
    //                 '<img alt="" src="http://placehold.it/250x180">'+
    //             '</li>'+
    //         '</ol>'+
    //     '</div>';

    //     $("#tampilSlideCarousel").empty().html(el);
    //     $("#myModal").modal("show");
    // })

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