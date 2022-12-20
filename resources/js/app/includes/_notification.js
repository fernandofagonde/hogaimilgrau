    
    notify = (className, content, withCallback = false, callbackFunction = ''  ) => {
        
        var options = { 
            className: 'notification',
            text: content,
            duration: 4000,
            close: false,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "var(--color-"+ className +")", 
            }            
            
        } 

        if(typeof callback === 'function') {
            options.onClick = () => { callbackFunction }
        }
        
        Toastify(options).showToast();

    }

    __selectAll('a.toast').forEach((item) => { 
        
        item.addEventListener('click', (element) => {
 
            const content = element.target.dataset.content;
            const className = element.target.dataset.class;

            notify(className, content);

        })

    })