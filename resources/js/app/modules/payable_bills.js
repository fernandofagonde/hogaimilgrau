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
