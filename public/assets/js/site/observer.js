let fixed__navbar = document.querySelector('[data-nav]')
let navbar = document.querySelector('[data-normal-nav]')

//observer na navbar

let observeNavbar = new IntersectionObserver(entries =>{
    entries.forEach(entry =>{
       if(entry.isIntersecting){
        
        fixed__navbar.classList.remove('nav__active')
       }
    })
},{
    threshold:0.1,
})

observeNavbar.observe(navbar)

//observer na div de diferenciais
let diferenciais = document.querySelector('.diferenciais__box');
let observeDiferenciais = new IntersectionObserver(entries =>{
    entries.forEach(entry =>{
       if(entry.isIntersecting){
        
        fixed__navbar.classList.add('nav__active')
       }
    })
},{
    threshold:0.1,
})

observeDiferenciais.observe(diferenciais)