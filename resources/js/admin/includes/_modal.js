    /*
    * Confirm Question
    */

    //callBack = function() { console.log('Executa') }
 
    modal = function(content) {

        __append(content, 'body')
        
        __select('body').classList.toggle('modal-open')
 
            __select('.modal-backdrop').classList.add('show')
            __select('.modal-dialog').classList.add('fade')

            setTimeout(function() {
                __select('.modal-dialog').classList.add('show')
            },0)
         
        __on('.modal', 'click', 'button.btn-cancel-modal', function() { 


        })

        __on('.modal', 'click', 'button.btn-modal-confirm', function(e) { 

            e.preventDefault();

            window.location = e.dataset.href
            
        })

        __on('.modal', 'click', 'button.btn-modal-confirm-js', function(e) {  })

    }

    modalClose = function() {
  
        if(__exists(__select('.modal-dialog'))) {

            setTimeout(function() {
                __select('.modal-dialog').classList.remove('show')
            }, 0)

            setTimeout(function() {
                __select('.modal-dialog').classList.remove('fade')
            }, 0)

            __select('.modal-backdrop').classList.remove('show') 


            setTimeout(function() {
                __remove('.modal-backdrop', true)
                __remove('.modal', true)
                if(__exists(__select('body.modal-open'))) { __select('body.modal-open').classList.remove('modal-open') }
            }, 500)

        }
    }

    modalCloseFast = function() {

        if(__exists(__select('.modal-dialog'))) {

            __remove('.modal-backdrop', true)
            __remove('.modal', true)
            if(__exists(__select('body.modal-open'))) { __select('body.modal-open').classList.remove('modal-open') }

        }

    }

    modalConfirm = function (classname = '', modal_header, modal_icon, modal_title, modal_text, modal_link, modal_link_js, type, type_txt) {
    
        __remove('.modal-backdrop', true)
        __remove('.modal', true)

        /* Link JS */
        let modal_button_type = (modal_link_js) ? '-js' : ''
        let modal_link_html = (modal_link_js) ? 'onclick="'+ modal_link +'"' : 'data-href="'+ modal_link +'"'
        let modal_icon_html = (modal_icon !== '') ? '<div class="modal-icon"><i class="'+ modal_icon +'"></i></div>' : ''
 
        classname = (classname !== '') ? 'modal-'+ classname : ''

        /* Html Structure */
        let html =  
        '<div class="modal" id="ModalConfirm" tabindex="-1">' + 
            '<div class="modal-backdrop fade"></div>' +
            '<div class="modal-dialog">' + 
                '<div class="modal-content '+ classname +'">' + 
                    '<div class="modal-header '+ classname +'">' + 
                        '<h4 class="modal-title">'+ modal_header +'</h4>' + 
                        '<div class="close"><i class="icon-times"></i></div>' + 
                    '</div>' + 
                    '<div class="modal-body">'+                     
                        modal_icon_html + 
                        '<h1>'+ modal_title +'</h1>' + 
                        '<h2>'+ modal_text +'</h2>' + 
                    '</div>' + 
                    '<div class="modal-footer">' + 
                        '<button type="button" class="button buttonStandard buttonIcon btn-cancel-modal"><i class="icon-times"></i>Cancelar</button>' + 
                        '<button type="button" class="button button'+ type +' btn-icon btn-round btn-modal-confirm'+ modal_button_type +'"'+ modal_link_html +'><i class="icon-check"></i>'+ type_txt +'</button>' + 
                    '</div>' + 
                '</div>' + 
            '</div>' + 
        '</div>'
    
        modal(html)
        
        __select('.modal .btn-cancel-modal').addEventListener('click', function() { modalClose() })
        __select('.modal .close').addEventListener('click', function() { modalClose() })
        __select('.modal-backdrop').addEventListener('click', function() { modalClose() })

    
        // $('.modal-footer a, .modal-footer button').click(function() { closeModal(); })
        // $('#ModalConfirm').modal('show');
        // $('#ModalConfirm').on('hidden.bs.modal', function () {
        // $('#ModalConfirm').remove();
        // $('.modal-backdrop').remove();
        // $('body').removeClass('modal-open').removeAttr('style');
    
        // }).on('shown.bs.modal', function() { $('.modal-confirm').click(function() { closeModal(); }); });
    
    }

    modalAlert = function (classname = '', modal_header, modal_title, modal_text) {
    
        __remove('.modal-backdrop', true)
        __remove('.modal', true)
 
        classname = (classname !== '') ? 'modal-'+ classname : ''

        /* Html Structure */
        let html =  
        '<div class="modal" id="ModalAlert" tabindex="-1">' + 
            '<div class="modal-backdrop fade"></div>' +
            '<div class="modal-dialog">' + 
                '<div class="modal-content '+ classname +'">' + 
                    '<div class="modal-header '+ classname +'">' + 
                        '<h4 class="modal-title">'+ modal_header +'</h4>' + 
                        '<div class="close"><i class="icon-times"></i></div>' + 
                    '</div>' + 
                    '<div class="modal-body">'+   
                        '<h1>'+ modal_title +'</h1>' + 
                        '<h2>'+ modal_text +'</h2>' + 
                    '</div>' +  
                '</div>' + 
            '</div>' + 
        '</div>'
    
        modal(html)
         
        __select('.modal .close').addEventListener('click', function() { modalClose() })
        __select('.modal-backdrop').addEventListener('click', function() { modalClose() })
  
    }
    
    modalWindow = function (windowTitle, frameUrl, windowMsg) {

        __remove('.modal-backdrop', true)
        __remove('.modal', true)
 
        var window_h = document.documentElement.clientHeight - 200;
      
        closeLoader();
     
        var classname = 'bg-primary';

        let html = 
        '<div class="modal" id="ModalWindow" tabindex="-1">' + 
            '<div class="modal-backdrop fade"></div>' +
            '<div class="modal-dialog">' + 
                '<div class="modal-content '+ classname +'">' + 
                    '<div class="modal-header '+ classname +'">' + 
                        '<h4 class="modal-title">'+ windowTitle +'</h4>' + 
                        '<div class="close"><i class="icon-times"></i></div>' + 
                    '</div>' + 
                    '<div class="modal-body">'+     
                        windowMsg +
                        '<iframe frameborder=\"0\" id=\"frameComment\" width=\"100%\" height=\"'+ window_h +'\" src=\"'+ frameUrl +'\" scrolling=\"auto\"></iframe>' +
                    '</div>' +  
                '</div>' + 
            '</div>' + 
        '</div>';

        modal(html)

        __select('.modal .close').addEventListener('click', function() { modalClose() })
        __select('.modal-backdrop').addEventListener('click', function() { modalClose() })
 
    }

    modalContent = function (windowTitle, frameUrl) {

        __remove('.modal-backdrop', true)
        __remove('.modal', true)
 
        var window_h = document.documentElement.clientHeight - 200;
      
        closeLoader();
     
        var classname = 'bg-primary';

        let html = 
        '<div class="modal" id="ModalContent" tabindex="-1">' + 
            '<div class="modal-backdrop fade"></div>' +
            '<div class="modal-dialog">' + 
                '<div class="modal-content '+ classname +'" style="max-height: '+ window_h +'px">' + 
                    '<div class="modal-header '+ classname +'">' + 
                        '<h4 class="modal-title">'+ windowTitle +'</h4>' + 
                        '<div class="close"><i class="icon-times"></i></div>' + 
                    '</div>' + 
                    '<div class="modal-body"><iframe frameborder=\"0\" id=\"frameComment\" width=\"100%\" height=\"'+ window_h +'\" src=\"'+ frameUrl +'\" scrolling=\"auto\"></iframe></div>' +  
                '</div>' + 
            '</div>' + 
        '</div>';

        modal(html)

        __select('.modal .close').addEventListener('click', function() { modalClose() })
        __select('.modal-backdrop').addEventListener('click', function() { modalClose() })
 
    }
    
    modalContentHtml = function (windowTitle, windowContent, footerContent = '', modalClass = '', backdropClose = true, modalWidth = '') {

        __remove('.modal-backdrop', true)
        __remove('.modal', true)
 
        var window_h = document.documentElement.clientHeight - 200;
      
        closeLoader();
      
        let html = 
        '<div class="modal'+ modalClass + '" id="ModalContentHtml" tabindex="-1">' + 
            '<div class="modal-backdrop fade"></div>' +
            '<div class="modal-dialog"'+ ( (modalWidth !== '') ? ' style="max-width: '+ modalWidth +' !important;"' : '') +'>' + 
                '<div class="modal-content">' + 
                    '<div class="modal-header">' + 
                        '<h4 class="modal-title"><img src="/web/assets/img/logo/logo.png" /> '+ windowTitle +'</h4>' + 
                        '<div class="close"><i class="icon-times"></i></div>' + 
                    '</div>' + 
                    '<div class="modal-body">' + windowContent + '</div>' +  
                    ((footerContent !== '') ? '<div class="modal-footer">' + footerContent + '</div>' : '') + 
                '</div>' + 
            '</div>' + 
        '</div>'

        modal(html)

        __select('.modal .close').addEventListener('click', function() { modalClose() })
        
        if(backdropClose) {
            __select('.modal-backdrop').addEventListener('click', function() { modalClose() })
        }
 
    }