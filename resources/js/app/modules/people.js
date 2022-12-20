__on('#module-form', 'change', '#document_type', (elem) => {

    let field = elem.target
    let target = __select('#document')

    target.value = ''

    if(field.value == 'CPF') {

        target.setAttribute('data-mask', 'cpf')
        target.setAttribute('maxlength', 14)
        target.addEventListener('keyup', () => { mask(target, maskCPF) })
        target.addEventListener('touchend', () => { mask(target, maskCPF) })

    }
    else {

        target.setAttribute('data-mask', 'cnpj')
        target.setAttribute('maxlength', 18)
        target.addEventListener('keyup', () => { mask(target, maskCNPJ) })
        target.addEventListener('touchend', () => { mask(target, maskCNPJ) })
    }

    target.focus()

})
