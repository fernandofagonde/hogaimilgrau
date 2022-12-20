

    /*
    * Execute On Dom Load
    */
    document.addEventListener("DOMContentLoaded", function() {


        /*
        * Loader Control
        */
        window.addEventListener('load', () => {

            closeLoader()

            lazyLoad()

            lazyStyles()

            if(window.innerWidth < 1200) {

                __select('aside').classList.add('close')
                __select('.toggle-menu').classList.remove('icon-chevron-left')
                __select('.toggle-menu').classList.add('icon-menu')

            }
            else {

                __select('aside').classList.remove('close')
                __select('.toggle-menu').classList.remove('icon-menu')
                __select('.toggle-menu').classList.add('icon-chevron-left')

            }

        })


        window.addEventListener('pageshow', (event) => {
            if (event.persisted) { closeLoader() }
        })

        var resizeTimer = 0

        window.addEventListener('resize', (event) => {

            clearTimeout(resizeTimer)

            resizeTimer = setTimeout(() => {

                if(window.innerWidth < 1200) {
                    __select('aside').classList.add('close')
                }
                else {
                    __select('aside').classList.remove('close')
                }

            }, 200)
        })


        /*
        * Apply Mask on Inputs .masked
        */
        Array.from(__selectAll('input.masked')).forEach(function(element) {

            let fieldMask = element.getAttribute('data-mask');

            switch(fieldMask) {

                case "date":
                    element.setAttribute('maxlength', 10)
                    element.addEventListener('keyup', () => { mask(element, maskDate) })
                    element.addEventListener('touchend', () => { mask(element, maskDate) })
                    break

                case "date-min":
                    element.setAttribute('maxlength', 5)
                    element.addEventListener('keyup', () => { mask(element, maskDateMin) })
                    element.addEventListener('touchend', () => { mask(element, maskDateMin) })
                    break

                case "hour":
                    element.setAttribute('maxlength', 5)
                    element.addEventListener('keyup', () => { mask(element, maskHour) })
                    element.addEventListener('touchend', () => { mask(element, maskHour) })
                    break

                case "phone":
                    element.setAttribute('maxlength', 15)
                    element.addEventListener('keyup', () => { mask(element, maskPhone) })
                    element.addEventListener('touchend', () => { mask(element, maskPhone) })
                    break

                case "zipcode":
                    element.setAttribute('maxlength', 10)
                    element.addEventListener('keyup', () => { mask(element, maskZipcode) })
                    element.addEventListener('touchend', () => { mask(element, maskZipcode) })
                    break

                case "cpf":
                    element.setAttribute('maxlength', 14)
                    element.addEventListener('keyup', () => { mask(element, maskCPF) })
                    element.addEventListener('touchend', () => { mask(element, maskCPF) })
                    break

                case "cnpj":
                    element.setAttribute('maxlength', 18)
                    element.addEventListener('keyup', () => { mask(element, maskCNPJ) })
                    element.addEventListener('touchend', () => { mask(element, maskCNPJ) })
                    break

                case "percent":
                    element.setAttribute('maxlength', 5)
                    element.addEventListener('keyup', () => { mask(element, maskPercent) })
                    element.addEventListener('touchend', () => { mask(element, maskPercent) })
                    break

                case "letters":
                    element.addEventListener('keyup', () => { mask(element, maskLetters) })
                    element.addEventListener('touchend', () => { mask(element, maskLetters) })
                    break

                case "letters-uppercase":
                    element.addEventListener('keyup', () => { mask(element, maskLettersUpperCase) })
                    element.addEventListener('touchend', () => { mask(element, maskLettersUpperCase) })
                    break

                case "letters-lowercase":
                    element.addEventListener('keyup', () => { mask(element, maskLettersLowerCase) })
                    element.addEventListener('touchend', () => { mask(element, maskLettersLowerCase) })
                    break

                case "uppercase":
                    element.addEventListener('keyup', () => { mask(element, maskUpperCase) })
                    element.addEventListener('touchend', () => { mask(element, maskUpperCase) })
                    break

                case "lowercase":
                    element.addEventListener('keyup', () => { mask(element, maskLowerCase) })
                    element.addEventListener('touchend', () => { mask(element, maskLowerCase) })
                    break

                case "name":
                    element.addEventListener('keyup', () => { mask(element, maskNames) })
                    element.addEventListener('touchend', () => { mask(element, maskNames) })
                    break

                case "credit-card":
                    element.setAttribute('maxlength', 19)
                    element.addEventListener('keyup', () => { mask(element, maskCreditCard) })
                    element.addEventListener('touchend', () => { mask(element, maskCreditCard) })
                    break

                case "money":
                    element.setAttribute('maxlength', 11)
                    element.addEventListener('touchend', () => { formatMoney(element) })
                    element.addEventListener('keyup', () => { formatMoney(element) })
                    element.addEventListener('blur', () => { formatMoney(element) })
                    break

                case "number":
                    element.addEventListener('keydown', (e) => {

                        if(
                            e.keyCode == 8 || // backspace
                            e.keyCode == 46 || // delete
                            e.keyCode == 36 || //home
                            e.keyCode == 35 || //end
                            e.keyCode == 37 || //left key
                            e.keyCode == 39 || //right key
                            (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) //numeric keys
                        ) {

                            return true;
                        }
                        else {
                            e.preventDefault();
                        }

                    })

                    element.addEventListener('keyup', (e) => {

                        if(e.keyCode == 40) {

                            var val = element.value;

                            element.value = (parseInt(val) > 1) ? parseInt(val) - 1 : 0;

                        }
                        else if(e.keyCode == 38) {

                            var val = element.value;

                           element.value = (val != '') ? parseInt(val) + 1 : 1;

                        }

                    })
                    break

            }

        })


        /*
        * Active Tab
        */
        getActiveTab = function() {
            var elem = __select('.nav-link.active')
            return (elem.dataset.target !== '#main') ? '&tab='+ elem.dataset.target.replace('#', '') : ''
        }


        /* Prepare Lists to Responsive Breakpoints */
        if(__exists(__select('#module-list .list'))) {

            __selectAll('#module-list .list').forEach((listElement) => {

                var headerColumns = listElement.querySelectorAll('.list-header div')
                var numColumns = headerColumns.length

                let indexElement = 0;

                listElement.querySelectorAll('.list-body .list-item div').forEach((colElement) => {

                    colElement.setAttribute('data-header', headerColumns[(indexElement)].innerText)

                    indexElement++

                    indexElement = (indexElement == numColumns) ? 0 : indexElement;

                })

            })

        }


        /* Prepare Lightbox */
        zoomImages = () => {

            if(__exists('.glightbox')) {

                __selectAll('.glightbox').forEach((el) => {

                    GLightbox({
                        selector: el.dataset.selector,
                        zoomable: false
                    })

                })

            }

        }

        zoomImages();

        // List Sortable
        if(__exists(__select('#listMain.sortable .list-item'))) {

            new Sortable(__getById('listMain'), {
                draggable: '> .list-item',
                animation: 150,
                filter: '.blocked',
                ghostClass: 'drag-background-class',
                onMove: (evt) => {
                    return !evt.related.classList.contains('blocked')
                },
                onEnd: function (evt) {

                    listMainSortable(evt)

                },
            })

            listItems = (items) => {

                let jsonOrder = []

                return new Promise((resolve, reject) => {

                    items.forEach((elem, index) => {

                        jsonOrder[index] = elem.dataset.id

                    })

                    setTimeout(
                        (
                            resolve(actionOrder(jsonOrder))
                        )(),
                    3000)

                })

            }

            listMainSortable = (evt) => {

                let items = __selectAll('#listMain.sortable .list-item')

                let jsonOrder = listItems(items)

            }

        }


        actionOrder = (items) => {

            let module = __getById('Form_MOD').value

            var jsonData = {
                'fnc': encode('ORDER'),
                'items': encode(JSON.stringify(items))
            }

            callAPI('PUT', [module], jsonData).then((RESPONSE) => {

                if(RESPONSE.result == 'success') {

                    notify('success', 'Ordem salva!')

                }
                else {

                    modalAlert('danger', ADMIN_NAME, 'Ocorreram erros!', RESPONSE['message'])

                }

            })

        }


        __on('body', 'click', '.request-view', (elem) => {

            modalContent(elem.target.dataset.title, ADMIN_PATH + 'fnc/requests.php?id='+ elem.target.dataset.id)

        })


        __on('body', 'click', '.button-view-property', (elem) => {

            modalContent(elem.target.dataset.title, ADMIN_PATH + 'fnc/property.php?id='+ elem.target.dataset.id)

        })


        /*
        * Search
        */
        if(__exists(__select('.input-search input'))) {

            __select('.input-search input').addEventListener('keyup', function(evt) {

                if (evt.keyCode == 13) {

                    __select('.input-search button').click()

                }

            })

        }

    })







