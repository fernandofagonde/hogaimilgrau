function paydayFocus(field) {

    field.type = 'date'

}

function paydayBlur(field) {

    if(field.value.length < 10) {
        field.type = 'tel'
        field.value = ''
    }

}
