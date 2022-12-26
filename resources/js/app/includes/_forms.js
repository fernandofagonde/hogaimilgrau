    const ADMIN_NAME = __select('.logo span').innerHTML;

    /*
    * Auto Validation Form
    */

    function formValidation (formSelector, dyn = false) {

        var TOP_ELEMENT = '';
        var ERROR_MESSAGES = 'Verifique os campos destacados no formulário.';
        var ERRORS = false;

        if(__exists(__select('.has-error'))) {
            __selectAll('.has-error').classList.remove('has-error');
        }

        if(!__exists(__select(formSelector))) {
            return {
                errors: true,
                errorMsg: 'Form Selector not Found ('+ formSelector +')',
                topElement: TOP_ELEMENT
            }
        }

        var error_msg_open = '<p class="modal-msg-error">';
        var error_msg_close = '</p>';

        __selectAll(formSelector + ((!dyn) ? ' .required:not(.dyn-form, .required-editor)' : ' .required:not(.required-editor)')).forEach(function(elem) {

            var ERROR = 0

            var FIELD = elem
            var FIELD_TYPE = FIELD.getAttribute('type')
            var FIELD_VALUE = trim(FIELD.value)
            var FIELD_CLASS = FIELD.classList
            var FIELD_LABEL = FIELD.dataset.label

            if(
                (arraySearchAnd(FIELD_CLASS, ['form-control', 'required']) || FIELD_CLASS.contains('required')) &&

                (FIELD_VALUE === '' ||
                    (
                        (__exists(FIELD.getAttribute('minlength')) && FIELD_VALUE.length < FIELD.getAttribute('minlength')) ||
                        (__exists(FIELD.getAttribute('maxlength')) && FIELD_VALUE.length > FIELD.getAttribute('maxlength'))
                    )
                )
                && FIELD_TYPE !== 'password'
            ) {

                if(__exists(FIELD.getAttribute('minlength')) && FIELD_VALUE.length < FIELD.getAttribute('minlength') && FIELD.getAttribute('minlength') > 0 && typeof FIELD.getAttribute('minlength') !== 'undefined') {
                    ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED-MIN'].replace('{{MIN}}', FIELD.getAttribute('minlength')))
                }
                else if(__exists(FIELD.getAttribute('maxlength')) && FIELD_VALUE.length > FIELD.getAttribute('maxlength') && FIELD.getAttribute('maxlength') > 0 && typeof FIELD.getAttribute('maxlength') !== 'undefined') {
                    ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED-MAX'].replace('{{MAX}}', FIELD.getAttribute('maxlength')))
                }
                else {
                    ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED'])
                }

                formError(FIELD, ERROR_MSG)

                ERRORS = true
                ERROR = 1
                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

            }

            if(ERROR === 0) {

                if(FIELD_TYPE === 'password') {

                    var MIN = (typeof FIELD.dataset.min !== 'undefined') ? FIELD.dataset.min : ''
                    var MAX = (typeof FIELD.dataset.max !== 'undefined') ? FIELD.dataset.max : ''

                    if(!FIELD_CLASS.contains('password-edit')) {

                        if(typeof FIELD.dataset.comp !== 'undefined') {

                            var COMP = __select('#'+ FIELD.dataset.comp)

                            if(FIELD_VALUE == '' || (MIN != '' && FIELD_VALUE.length < MIN)) {

                                ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED-MIN-MAX'].replace('{{MIN}}', MIN).replace('{{MAX}}', MAX))
                                formError(FIELD, ERROR_MSG)

                                ERRORS = true
                                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                            }

                            if(COMP.value === '' || COMP.value.length < 6) {

                                ERROR_MSG = formErrorTxt(COMP.dataset.label, ErrorMsg['REQUIRED-MIN-MAX'].replace('{{MIN}}', MIN).replace('{{MAX}}', MAX))
                                formError(COMP, ERROR_MSG)

                                ERRORS = true
                                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                            }

                            if(FIELD_VALUE !== '' && COMP.value != '' && FIELD_VALUE != COMP.value) {

                                ERROR_MSG = formErrorTxt(FIELD_LABEL +' e '+ COMP.dataset.label, 'não coincidem, revise-os')
                                formError(FIELD, ERROR_MSG)
                                formError(COMP, ERROR_MSG)

                                ERRORS = true;
                                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                            }

                        }
                        else {

                            if(FIELD_VALUE == '' || FIELD_VALUE.length < 6) {

                                ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED-MIN-MAX'].replace('{{MIN}}', MIN).replace('{{MAX}}', MAX))
                                formError(FIELD, ERROR_MSG)

                                ERRORS = true
                                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                            }

                        }

                    }
                    else if(FIELD.classList.contains('password-edit')) {

                        if(typeof FIELD.dataset.comp !== 'undefined') {

                            var COMP = __select('#'+ FIELD.dataset.comp);

                            if(FIELD_VALUE !== '' && FIELD_VALUE !== COMP.value) {

                                ERROR_MSG = formErrorTxt(FIELD.dataset.label +' e '+ COMP.dataset.label, 'não coincidem, revise-os')
                                formError(FIELD, ERROR_MSG)
                                formError(COMP, ERROR_MSG)

                                ERRORS = true
                                ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                            }

                        }

                    }
                    else  {

                        if(FIELD_VALUE === '' || FIELD_VALUE.length < 6) {

                            ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED'])
                            formError(FIELD, ERROR_MSG)

                            ERRORS = true
                            ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                        }

                    }

                }

                else if(FIELD_CLASS.contains('numeric') ) {

                    if(!ERnan.test(FIELD_VALUE )) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('email') ) {

                    if(FIELD_VALUE === '') {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['REQUIRED'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }
                    else if(!ERemail.test(FIELD_VALUE)) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['INVALID'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('phone') ) {

                    if (!ERtel.test(FIELD_VALUE)) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['INVALID'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('cpf') ) {

                    if (!ValidateCPF(FIELD_VALUE)) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['INVALID'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('cnpj') ) {

                    if (!ValidaCNPJ(FIELD_VALUE)) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['INVALID'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('LEGAL-AGE') ) {

                    if (!ERdate.test(FIELD_VALUE) || !legalAge(FIELD_VALUE )) {

                        ERROR_MSG += formErrorTxt(FIELD_LABEL, ErrorMsg['LEGAL-AGE'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

                else if(FIELD_CLASS.contains('data') ) {

                    if (!ERdate.test(FIELD_VALUE)) {

                        ERROR_MSG = formErrorTxt(FIELD_LABEL, ErrorMsg['INVALID'])
                        formError(FIELD, ERROR_MSG)

                        ERRORS = true
                        ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                    }

                }

            }

            if(TOP_ELEMENT == '') {
                TOP_ELEMENT = FIELD
            }

        });

        if(__exists(formSelector + ' div.div-editor:not(.dyn-form) .editor.required')) {

            __selectAll(formSelector +' div.div-editor:not(.dyn-form) .editor.required').forEach(function(elem) {

                var InstanceID = elem.getAttribute('id')
                var InstanceIndex = elem.dataset.index
                var InstanceVal = normalEditor[InstanceID].container.firstChild.innerHTML.replaceAll('<p><br></p>', '<br>').replaceAll('+', '{{plus}}')

                if(InstanceVal == '' || InstanceVal == '<br>') {

                    ERROR_MSG = formErrorTxt(elem.parentNode.querySelector('label.form-label').innerText, ErrorMsg['INVALID'])

                    formError(elem, ERROR_MSG)

                    ERRORS = true
                    ERROR_MESSAGES += error_msg_open + ERROR_MSG + error_msg_close

                }

            });

        }

        if(TOP_ELEMENT !== '') {
            TOP_ELEMENT.scrollIntoView()
        }

        return {
            errors: ERRORS,
            errorMsg: ERROR_MESSAGES,
            topElement: TOP_ELEMENT
        }

    }

    function formReset (formSelector, dyn = false) {

        if(!__exists(__select(formSelector))) {
            return {
                errors: true,
                errorMsg: 'Form Selector not Found ('+ formSelector +')',
                topElement: TOP_ELEMENT
            }
        }

        var RETURN = ' retorno: ';

        __selectAll(formSelector + ((!dyn) ? ' .form-control:not(.dyn-form)' : ' .dyn-form')).forEach(function(elem) {

            var FIELD = elem
            var FIELD_NAME = FIELD.getAttribute('name')
            var FIELD_TYPE = FIELD.getAttribute('type')
            var FIELD_TAG = FIELD.tagName

            RETURN += ' ' + FIELD_NAME;

            if(FIELD_TAG === 'SELECT') {
                FIELD.options.selectedIndex = 0
            }
            else if(FIELD_TYPE === 'checkbox' || FIELD_TYPE === 'radio') {
                FIELD.checked = false;
            }
            else {
                FIELD.value = ''
            }

        })

        __selectAll(formSelector + ((!dyn) ? ' input:not(.form-control,.dyn-form)' : ' input.dyn-form')).forEach(function(elem) {

            var FIELD = elem
            var FIELD_NAME = FIELD.getAttribute('name')
            var FIELD_TYPE = FIELD.getAttribute('type')
            var FIELD_TAG = FIELD.tagName

            RETURN += ' ' + FIELD_NAME;

            if(FIELD_NAME !== 'Form_MOD') {

                if(FIELD_TAG === 'SELECT') {
                    FIELD.options.selectedIndex = 0
                }
                else if(FIELD_TYPE === 'checkbox' || FIELD_TYPE === 'radio') {
                    FIELD.checked = false;
                }
                else {
                    FIELD.value = ''
                }

            }

        })

        return RETURN;

    }

    /*
    * Prepare Json
    */

    function prepareJson (formSelector) {

        var jsonData = {};

        __selectAll(formSelector +' input.form-control, '+ formSelector +' textarea, '+ formSelector +' select.form-control').forEach(function(elem) {

            var FIELD = elem
            var FIELD_TYPE = FIELD.getAttribute('type')
            var FIELD_NAME = FIELD.getAttribute('name')
            var FIELD_CLASS = FIELD.classList
            var FIELD_INDEX = FIELD.dataset.index

            if(!FIELD_CLASS.contains('npp')) {

                if(FIELD_TYPE == 'checkbox')
                {
                    jsonData[FIELD_INDEX] = encode((FIELD.checked) ? 1 : 0);
                }
                else if(FIELD_TYPE == 'radio')
                {
                    jsonData[FIELD_INDEX] = encode((FIELD.selected) ? 1 : 0);
                }
                else if(FIELD_TYPE == 'select')
                {
                    jsonData[FIELD_INDEX] = encode(FIELD.querySelector('option:selected').value);
                }
                else if(FIELD_TYPE == 'password')
                {
                    jsonData[FIELD_INDEX] = encode(FIELD.value);
                }
                else if(typeof FIELD_NAME === 'undefined') {

                    console.log(FIELD);

                }
                else
                {
                    jsonData[FIELD_INDEX] = encode(FIELD.value.replaceAll('+', '{{plus}}'));
                }

            }

        });

        // if(__exists(formSelector +' div.div-editor:not(.dyn-form)')) {

        //     __selectAll(formSelector +' div.div-editor:not(.dyn-form)').forEach(function(elem) {

        //         var el = elem.querySelector('.editor')

        //         var InstanceID = el.id
        //         var InstanceIndex = el.dataset.index
        //         var InstanceVal = normalEditor[InstanceID].container.firstChild.innerHTML.replaceAll('<p><br></p>', '<br>').replaceAll('+', '{{plus}}')

        //         jsonData[InstanceIndex] = encode(InstanceVal)

        //     });

        // }

        // if(__exists(formSelector +' div.div-editor-code:not(.dyn-form)')) {

        //     __selectAll(formSelector +' div.div-editor-code:not(.dyn-form)').forEach(function(elem) {

        //         var el = elem.querySelector('.editor-code')

        //         var InstanceID = el.id
        //         var InstanceIndex = el.dataset.index
        //         var InstanceVal = codeEditor[InstanceID].getText()

        //         jsonData[InstanceIndex] = encode(InstanceVal)

        //     });

        // }

        if(__exists(formSelector +' div.div-editor:not(.dyn-form)')) {

            __selectAll(formSelector +' div.div-editor:not(.dyn-form)').forEach(function(elem) {

                var el = elem.querySelector('.editor')

                var InstanceID = el.id
                var InstanceIndex = el.dataset.index
                var InstanceVal = normalEditor[InstanceID].container.firstChild.innerHTML.replaceAll('<p><br></p>', '<br>').replaceAll('+', '{{plus}}')

                jsonData[InstanceIndex] = encode(InstanceVal)

            });

        }

        if(__exists(formSelector +' div.editor-code:not(.dyn-form)')) {

            __selectAll(formSelector +' div.editor-code:not(.dyn-form)').forEach(function(elem) {

                var el = elem.querySelector('.ql-syntax')

                var InstanceIndex = elem.dataset.index
                var InstanceVal = el.innerHTML

                jsonData[InstanceIndex] = encode(InstanceVal)

            });

        }

        // if(__exists(formSelector +' .dynamic-list')) {

        //     __selectAll(formSelector +' .dynamic-list').forEach((list) => {

        //         let dataIndex = list.dataset.index
        //         let dataFields = list.dataset.values.split(';')
        //         let targetClass = list.dataset.target

        //         jsonData[dataIndex] = []

        //         let count = 0

        //         list.querySelectorAll('.'+ targetClass).forEach((item) => {

        //             if(item.classList.contains('active')) {

        //                 jsonData[dataIndex][count] = []

        //                 dataFields.forEach((field) => {
        //                     jsonData[dataIndex][count][field] = item.dataset[field]

        //                 })

        //                 count++
        //             }

        //         })

        //         console.log( JSON.stringify(jsonData[dataIndex]))

        //         jsonData[dataIndex] = encode(JSON.stringify(jsonData[dataIndex]))

        //     })

        // }

        return(jsonData);

    }

    function prepareJsonDyn (formSelector) {

        var jsonData = {};

        __selectAll(formSelector +' input.dyn-form, '+ formSelector +' textarea.dyn-form, '+ formSelector +' select.dyn-form').forEach(function(elem) {

            var FIELD = elem
            var FIELD_TYPE = FIELD.getAttribute('type')
            var FIELD_NAME = FIELD.getAttribute('name')
            var FIELD_CLASS = FIELD.classList
            var FIELD_INDEX = FIELD.dataset.index

            if(FIELD_TYPE == 'checkbox')
            {
                jsonData[FIELD_INDEX] = encode((FIELD.checked) ? 1 : 0);
            }
            else if(FIELD_TYPE == 'radio')
            {
                jsonData[FIELD_INDEX] = encode((FIELD.selected) ? 1 : 0);
            }
            else if(FIELD_TYPE == 'select')
            {
                jsonData[FIELD_INDEX] = encode(FIELD.querySelector('option:selected').value);
            }
            else if(FIELD_TYPE == 'password')
            {
                jsonData[FIELD_INDEX] = encode(FIELD.value);
            }
            else if(typeof FIELD_NAME === 'undefined') {
                console.log(elem);
            }
            else
            {
                jsonData[FIELD_INDEX] = encode(FIELD.value);
            }

        });

        if(__exists(formSelector + ' .editor')) {

            __selectAll(formSelector +' .editor').forEach(function(elem) {

                var InstanceID = elem.id
                var InstanceIndex = elem.dataset.index
                var InstanceVal = normalEditor[InstanceID].container.firstChild.innerHTML.replaceAll('<p><br></p>', '<br>').replaceAll('+', '{{plus}}')

                jsonData[InstanceIndex] = encode(InstanceVal)

            });

        }

        if(__exists(formSelector +' .editor-code')) {

            __selectAll(formSelector +' .editor-code').forEach(function(elem) {

                var InstanceID = elem.id
                var InstanceIndex = elem.dataset.index
                var InstanceVal = codeEditor[InstanceID].getText()

                jsonData[InstanceIndex] = encode(InstanceVal)

            });

        }

        return(jsonData);

    }

    /*
    * Form Messages
    */

    function formSuccess (FIELD, MSG) { __after('<small class="form-success form-text text-success"><i class="icon-check"></i>'+ MSG +'</small>', FIELD); };
    function formErrorTxt (LABEL, MSG) { var html = 'O campo <span>'+LABEL+'</span> '+ MSG; return(html); };
    function formError (FIELD, MSG) { __append('<small class="form-error form-text text-danger"><i class="icon-times"></i> '+ MSG +'</small>', FIELD.closest('.form-group')); };
    function formErrorRemove (FIELD) { __remove(CAMPO.closest('.form-group .form-text')); };

    /*
    * Form Validation Messages
    */

    var ErrorMsg = {
        'FAIL': ' é obrigatório(a)',
        'REQUIRED': ' é obrigatório(a)',
        'REQUIRED-MIN': 'é obrigatório(a), mínimo de {{MIN}} caracteres',
        'REQUIRED-MAX': 'é obrigatório(a), máximo de {{MIN}} caracteres',
        'REQUIRED-MIN-MAX': 'é obrigatório(a), entre {{MIN}} e {{MAX}} caracteres',
        'INVALID': 'é inválido(a)',
        'LEGAL-AGE': 'inválida, somente maiores de 18 anos'
    };

    /*
    * Error Handler
    */

    function Error_Handler (ERROR) {

        let MSG = ''

        if(ErrorMsg.contains(ERROR)) {
            MSG = capitalizeFirstLetter(ErrorMsg)
        }
        else if(ERROR == 'ERROR-LOGIN') {
            MSG = 'É preciso estar logado para executar esta ação!'
        }
        else if(ERROR == 'ERROR-EMAIL') {
            MSG = 'O E-mail informado já cadastrado, escolha outro.'
        }
        else if(ERROR == 'ERROR-CPF') {
            MSG = 'O CPF informado já cadastrado, escolha outro.'
        }
        else if(ERROR == 'ERROR-DADOS') {
            MSG = 'Dados incompletos, revise os campos e tente novamente.'
        }
        else if(ERROR == 'ERROR-DEL-CADASTRO') {
            MSG = 'Registro(s) não encontrado(s), tente novamente.'
        }
        else if(ERROR == 'ERROR-DEL-NENHUM') {
            MSG = 'Nenhum registro apagado.'
        }

        closeLoader()

        modalContent(ADMIN_NAME, '<strong>Ocorreu um erro!</strong><br>'+ MSG, 'danger')

    }

    __on('.div-checkbox', 'click', 'label', function(elem) {

        var elemInput = ''

    })


    // Button Add
    __on('body', 'click', '#btn-add-dyn', function(elem) {

        changeNavAction(' / Adicionando')

        let bar = __select('#module-bar')

        let list = __select('#module-list')

        let form = __select('#module-form');

        bar.classList.remove('active')

        list.classList.remove('active')

        form.classList.add('active')

        __select('#Form_FNC').value = 'ADD'

        let buttonDelete = __select('#btn-form-del');

        if(buttonDelete !== undefined) {
            buttonDelete.style.display = 'none';
        }

    })


    // Button Edit
    __on('body', 'click', '.button-list-edit', function(elem) {

        Loader()
        window.location = '/app/'+ elem.target.dataset.module +'/'+ elem.target.dataset.id +'/edit/'

    })


    // List Delete Button
    __on('body', 'click', '.button-list-del', function(elem) {

        modalConfirm('danger', ADMIN_NAME, 'icon-check-circle', 'Apagar Registro', 'Deseja realmente apagar este item? Não é possível reverter sua ação!', 'actionDel(\''+ elem.target.id +'\');', true, '', 'Apagar');

    })


    function actionDel (buttonId) {

        let button = __select('#'+ buttonId)

        let form = __select('#delete-form')

        form.action = '/app/'+ button.dataset.module +'/'+ button.dataset.id

        form.submit()

    }

    // Delete Attachment Confirm
    __on('body', 'click', '.button-delete-attachment', (elem) => {

        var button = elem.target
        var module = button.dataset.module
        var field = button.dataset.field
        var id = button.dataset.id

        modalConfirm('danger', ADMIN_NAME, 'icon-check-circle', 'Apagar Arquivo', 'Deseja realmente apagar este arquivo? Não é possível reverter sua ação!', 'actionDelAttachment(\''+ module +'\',\''+ id +'\',\''+ field +'\');', true, '', 'Apagar');



    })

    // Action Attachment Del
    function actionDelAttachment(module, id, field) {

        modalClose();

        var form = __select('form#delete-form')
        form.action = '/app/'+ module +'/attachment/'+ id
        form.querySelector('#field').value = field;

        Loader()

        form.submit()

    }

    // Form Tab
	var tabOpen = '';

    __on('#form-tabs', 'click', '.form-tab', function(elem) {

        var target = elem.target.dataset.target

        if(!elem.target.classList.contains('active')) {

            // Url Changes
            tabOpen = elem.target.dataset.target

            Param = getUrlVars();
			changeUrl(Param['site_url']+ ((tabOpen != 'main') ? '&tab='+ tabOpen : ''));

            // Tab Button
            __select('#form-tabs .form-tab.active').classList.remove('active')
            elem.target.classList.add('active')

            // Tab Content
            __select('.form-tab-content.active').classList.remove('active')
            __select('#tab-'+ target).classList.add('active')

        }

    })

	function openTab (TAB) {
		__select('.form-tab[data-target='+ TAB +']').click();
	};


    // Button Back Form
    __on('#form-buttons', 'click', '#btn-form-back', function(elem) {

        modalConfirm('info', '', 'icon-times-circle', 'Deseja realmente sair?', 'Não será possível recuperar os dados informados ou não salvos!', 'callbackBack()', true, 'warning', 'Sim, sair!')

    })

    function callbackBack () {

        window.location = '/app/'+ __select('#btn-form-back').dataset.module

    }


    // Button Save Form
    __on('#form-buttons', 'click', '#btn-form-save', function(elem) {

        elem.preventDefault()

        modalConfirm('success', ADMIN_NAME, 'icon-check-circle', 'Gravar registro', 'Deseja realmente gravar o registro com os dados informados?', 'actionSave(\'no\');', true, '', 'Gravar');

    })

    __on('#form-buttons', 'click', '#btn-form-save-continue', function(elem) {

        elem.preventDefault()

        modalConfirm('success', ADMIN_NAME, 'icon-check-circle', 'Gravar registro', 'Deseja realmente gravar o registro com os dados informados e seguir editando?', 'actionSave(\'edit\');', true, '', 'Gravar');

    })

    __on('#form-buttons', 'click', '#btn-form-save-add', function(elem) {

        elem.preventDefault()

        modalConfirm('success', ADMIN_NAME, 'icon-check-circle', 'Gravar registro', 'Deseja realmente gravar os dados informados e incluir um novo?', 'actionSave(\'create\');', true, '', 'Gravar');

    })

    function actionSave (_return) {

        modalClose();

        __select('#_return').value = _return;

        Loader()

        __select('#module-form').submit()


    }

    __on('#module-form', 'keydown', '.form-control', (e) => {

        if (e.key == "Enter") {

            if(__exists(__select('#btn-form-save'))) {

                __select('#btn-form-save').click()

            }
            else if(__exists(__select('#btn-form-save-continue'))) {

                __select('#btn-form-save-continue').click()

            }

            e.preventDefault();

        }

    })


    // Delete Button Form
    __on('#form-buttons', 'click', '#btn-form-del', function(elem) {

        modalConfirm('danger', ADMIN_NAME, 'icon-check-circle', 'Apagar Registro', 'Deseja realmente apagar este item? Não é possível reverter sua ação!', 'actionDelForm(\''+ elem.target.id +'\');', true, '', 'Apagar');

    })

    function actionDelForm (buttonId) {

        modalClose()

        let button = __select('#'+ buttonId)

        let form = __select('#delete-form')

        form.action = '/app/'+ button.dataset.module +'/'+ button.dataset.id

        Loader()

        form.submit()

    }

    __selectAll('.password-edit').forEach((elem) => {

        elem.addEventListener('keyup', (e) => {

            elem.classList.add('required')

        });

    })


    // Switch Items
    __selectAll('.switch-toggle').forEach((elem) => {

        var parentElem = elem.parentNode;

        elem.addEventListener('change', function(el) {

            var infoText = parentElem.getElementsByClassName('.switch-info')

            if(infoText.length > 0) {

                var status = elem.checked
                var txt_off = elem.dataset.txtoff
                var txt_on = elem.dataset.txton
                infoText.innerHTML((status) ? txt_on : txt_off)

            }

        })


	})

    /**
     * List Switch
     */
 	__on('body', 'change', '.list-switch', (elem) => {

        var Route = elem.target.dataset.route
		var Id = elem.target.dataset.id
		var Status = (elem.target.checked) ? elem.target.dataset.selected : elem.target.dataset.unselected

		var jsonData = {
            'id': Id,
            'status': Status
        }

		__put([ Route ], jsonData).then((response) => {

            console.log(response)

            if(response.success) {

                notify('success', 'Modificação salva!')

            }
            else {

                modalAlert('danger', ADMIN_NAME, 'Ocorreram erros!', response['error-message'])

            }

        })

	});


    // Button Generate Slug
    __on('body', 'click', '.btn-generate', (elem) => {

        var originName = elem.target.dataset.origin
        let originField = __select('#' + originName)

        var targetName = elem.target.dataset.target
        let targetField = __select('#' + targetName)

        targetField.value = originField.value.replace(/[\s]/gi, '-')
        targetField.value = targetField.value.toLowerCase()
        targetField.value = targetField.value.replace(/[^a-z0-9--]/gi, '')

    })


    // Count Chars
    __on('.form-group', 'input', '.count', (elem) => {

        let input = elem.target
        let inputLimit = input.getAttribute('maxLength')
        let inputValueLength = input.value.length

        input.parentNode.parentNode.querySelector('.count-chars').innerHTML = (inputValueLength > inputLimit) ? '<span class="color-danger">' + inputValueLength + '</span>' : inputValueLength

    })


