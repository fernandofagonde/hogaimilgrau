  
    let submenus_arrow = __selectAll('div.has-submenu')
 
    submenus_arrow.forEach((elem, i) => {

        elem.addEventListener('click', (e) => {

            let elemParent = e.target.parentElement.parentElement

            elemParent.classList.toggle('show-submenu')

        }) 

    })
 
    let sidebar = __select('aside');
    let sidebarButton = __select('.toggle-menu');

    sidebarButton.addEventListener('click', (e) => {
        
        var w=window,
        d=document,
        e=d.documentElement,
        g=d.getElementsByTagName('body')[0],
        x=w.innerWidth||e.clientWidth||g.clientWidth,
        y=w.innerHeight||e.clientHeight||g.clientHeight;

        if(x > 767) {
            sidebar.classList.toggle('close')
            sidebarButton.classList.toggle('icon-chevron-left')
            sidebarButton.classList.toggle('icon-menu')
        }
        else {
            sidebar.classList.toggle('show')
            sidebarButton.classList.toggle('icon-chevron-left')
            sidebarButton.classList.toggle('icon-menu')
        }

    }); 
    
    let resizeSizebar = function() {  

        let width = window.innerWidth;

        if(width > 767) {

            sidebar.classList.add('close')
            sidebarButton.classList.toggle('icon-chevron-left')
            sidebarButton.classList.toggle('icon-menu')

        }
        else { 
        
            sidebar.classList.remove('close')
            sidebarButton.classList.toggle('icon-chevron-left')
            sidebarButton.classList.toggle('icon-menu')
        
        } 

    }

    // __load(resizeSizebar());

    

    