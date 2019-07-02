/*
@package sunsettheme

    ===============================
        Admin page scripts
    =============================== */

jQuery(document).ready(function($){
   
    var mediaUploader;
        
    $("#upload_btn").on("click", function(e){
        e.preventDefault();
        if(mediaUploader){
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
           title: "Chose a Profile Picture" ,
            button: {
                text: "Chose Picture"
            },
            multiple: false
        });
        
        /*mediaUploader.on("select", function(){
            attachment = mediaUploader.state().get("selection").first().toJson();
            $("#sidebar_profile_picture_picker").val(attachment.url)
        });*/
        
        mediaUploader.on("select", function(){
            attachment = mediaUploader.state().get("selection").first().toJSON();
            $("#sidebar_profile_picture_picker").val(attachment.url);
            $(".sidebar-profile-image").css('background-image', 'url('+attachment.url+')');
        })
        
        mediaUploader.open();
    });
    
    $("#remove_btn").on("click", function(e){
        e.preventDefault();
        var answer = confirm("Are you sure you want to remove the profile picture?");
        if(answer == true){
            $("#sidebar_profile_picture_picker").val('');
            $(".sunset-general-form").submit();
        }
    })
    
});