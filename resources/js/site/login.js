const login_form = document.querySelector('#login-form')
const remember_form = document.querySelector('#remember-form')

document.querySelector('#remember-link').addEventListener('click', (elem) => {

    login_form.classList.remove('active')
    remember_form.classList.add('active')

})

document.querySelector('#login-link').addEventListener('click', (elem) => {

    remember_form.classList.remove('active')
    login_form.classList.add('active')

})
