+function($){
"use strict";

function downloadModal(token, filter) {
    
    var $downloadModal = $('#downloadModal'),
        $closeButton = $downloadModal.find('button[data-close]'),
        $progressBar = $downloadModal.find('.progress-bar'),
        $downloadLink = $downloadModal.find('a[data-start-download]'),
        $emptyP = $downloadModal.find('p[data-empty]'),
        busy = true,
        stepCalledNum = 0,
        aborted = false;
    
    $downloadModal.modal({
        backdrop: 'static',
        keyboard: false
    });

    //close click button
    $closeButton.on('click', function(){
        var answer;

        if (busy){
            answer = confirm($downloadModal.data('confirm'));

            if (!answer) {
                return;
            }
        }
        aborted = true;
        $downloadModal.modal('hide');
    });
    
    //close click button
    $downloadLink.on('click', function(){
        $downloadModal.modal('hide');
    });
    
    //cleanup
    $downloadModal.one('hidden.bs.modal', function () {
        $closeButton.off('click');
        $downloadLink
            .off('click')
            .addClass('hide');
        $emptyP.addClass('hide');
        updateProgress(0);
        
        document.title = $downloadModal.data('doc-title'); //restore
    });
    
    var updateProgress = function (percent){
        $progressBar.width(percent + '%').text(percent + '%');
        
        document.title = percent + '%' + ' - ' + $downloadModal.data('progress-title').toLowerCase();
    };
    
    
    var stepCall = function(token, taskName){
        stepCalledNum++;
        //start downloading
        serviceCtrl.callAjax( 'plugin/Download_images/multiple-step', 
            function(callsRemainedNum){
                if (aborted)
                    return;
                
                var percent = Math.round(100 / (callsRemainedNum + stepCalledNum) * stepCalledNum);
                updateProgress(percent);
                
                if(callsRemainedNum > 0){
                    stepCall(token, taskName); //repeat
                }
                else{
                    busy = false;
                    setTimeout(function(){
                        $downloadLink
                            .attr('href', serviceCtrl.path + 'plugin/Download_images/multiple-step?token=' + token + '&name=' + taskName)
                            .removeClass('hide');
                    }, 400);
                }
            }, 
            {token: token, name: taskName}, 
            true, //without blocker
            null, //error callback 
            'GET');
    };
    
    
    $downloadModal.data('doc-title', document.title); //store old
    
    //start downloading
    serviceCtrl.callAjax( 'plugin/Download_images/multiple-start', 
        function(data){
            if (aborted)
                return;
            
            if(data === 'no-files'){
                busy = false;
                updateProgress(100);
                $emptyP.removeClass('hide');
                return;
            }
            stepCall(token, data);
        }, 
        {token: token, filter: filter}, 
        true, //without blocker
        null, //error callback 
        'GET');
        

};

function downloadButtonHandler(event){
    event.preventDefault();
    event.stopImmediatePropagation(); //do not allow to run up in event tree

    var filename = $(this).closest('.thumb,.controls').data('filename'),
        gallery_token = PhotoSelector.gallery.sharing_token;

    window.location.href = PhotoSelector.siteUrl + 
            'plugin/Download_images/single/?token=' + gallery_token + '&filename=' + filename;
}

//on event
pageGalleryBrowse.on('init:DownloadImages', function(){
    
    //not enabled, stop
    if(!PhotoSelector.gallery.download_enabled){
        return;
    }
    
    var $downloadDropdown = $('#downloadDropdown');

    $downloadDropdown.on('click', 'a', function(event){
       event.preventDefault();
       
       var filter = $(this).data('download');
       
       if (filter === 'filter'){
           filter = filterCtrl.data;
       }
       else{
           filter = '';
       }
       
       downloadModal(PhotoSelector.gallery.sharing_token, filter);
    });

    pageGalleryBrowse.$thumbs.on('click', 'button[data-download]', downloadButtonHandler);
    pageGalleryBrowse.$gallery.on('click', 'button[data-download]', downloadButtonHandler);
});

}($);