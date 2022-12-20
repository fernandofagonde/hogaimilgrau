function paydayFocus(field) {

    field.type = 'date'

}

function paydayBlur(field) {

    console.log(field.value)

    if(field.value.length < 10) {
        field.type = 'tel'
        field.value = ''
    }

}

__on('#module-form', 'change', '#people_id', (elem) => {

    var target = __select('#debtor')

    if(elem.target.value == 'other') {

        target.disabled = false
        target.focus()

    }
    else {

        target.value = ''
        target.disabled = true
        
    }

})
