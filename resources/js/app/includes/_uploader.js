
    var Upload_Files = function (parentElement, module) {
        Upload_Files.prototype.form = parentElement
        Upload_Files.prototype.mod = module
    }

    Upload_Files.prototype.getType = function(file) { return file.type; }

    Upload_Files.prototype.getSize = function(file) { return file.size; }

    Upload_Files.prototype.getName = function(file) { return file.name; }

    Upload_Files.prototype.progressHandling = function (event) {

        var FORM = Upload_Files.prototype.form;

        var percent = 0;
        var position = event.loaded || event.position;
        var total = event.total;
        var progress_bar_id = __select('#'+ FORM +' .progress-wrp');

        if (event.lengthComputable) {
            percent = Math.ceil(position / total * 100);
        }

        if(progress_bar_id.classList.contains('hidden')) { progress_bar_id.style.display = block; }

        __select('#'+ FORM +' .progress-wrp .progress-bar').style.width = percent + '%';

    }

    Upload_Files.prototype.doUpload = function (formData, keepEditing = 0, id = 0) {

        let formSelector = Upload_Files.prototype.form;
        let that = this;
        let y = 0;

        if(__exists(__select(formSelector +' input[type="file"]'))) {

            var prepareFiles = new Promise((resolve, reject) => {

                var setType = 0;
                var inputFiles = __selectAll(formSelector + ' .form-upload-box');

                if(__select(formSelector).classList.contains('form-upload-box')) {
                    inputFiles = __selectAll(formSelector)
                }

                inputFiles.forEach((el) => {

                    var elem = el.querySelector('input[type="file"]')

                    for(var i=0; i< elem.files.length; i++) {

                        formData.append(elem.getAttribute('name') + ((elem.files.length > 1) ? '_'+ i : ''), elem.files[i], elem.files[i].name)

                        if(setType === 0) {

                            if(typeof elem.dataset.dyn !== 'undefined' && elem.dataset.dyn !== '') {

                                elem.dataset.dyn.split(',').forEach((dynEl) => {

                                    var dynField = __select('#'+ dynEl)
                                    var dynIndex = dynField.dataset.index

                                    formData.append(dynIndex, encode(dynField.value));

                                })

                                setType = 1;

                            }
                        }

                        if((i+1) == elem.files.length) resolve()

                    }

                })

            })

            prepareFiles.then(() => {

                var oReq = new XMLHttpRequest()

                oReq.addEventListener("progress", updateProgress, false)
                oReq.addEventListener("load", transferComplete, false)
                oReq.addEventListener("error", transferFailed, false)
                oReq.addEventListener("abort", transferCanceled, false)

                oReq.open("POST", '/admin/api/upload.php', true)

                oReq.setRequestHeader("Authcode", (getCookie('NvAuthCode') ?? ''))

                oReq.send(formData)

                function updateProgress (oEvent) {

                    if (oEvent.lengthComputable) {
                        var percentComplete = oEvent.loaded / oEvent.total
                    }
                    else {

                    }

                }

                function transferComplete(evt) {

                    var RESPONSE = JSON.parse(evt.target.response, true)

                    if(RESPONSE.result == 'success') {

                        let errors = false

                        if(typeof RESPONSE['file-errors'] !== 'undefined' && RESPONSE['file-errors'] > 0) {

                            alert('Ocorreram erro(s) no upload do(s) arquivo(s) '+ RESPONSE['file-errors-info'])

                        }

                        if(keepEditing === 0 && !errors) {

                            window.location = '/admin/'+ Upload_Files.prototype.mod

                        }
                        else if(keepEditing === 1) {

                            window.location = '/admin/'+ Upload_Files.prototype.mod +'/edit/'+ id

                        }
                        else if(keepEditing === 2) {

                            listFiles(Upload_Files.prototype.form, RESPONSE)

                        }
                        else if(keepEditing === 3) {

                            return { result: 'upload-partial' }

                        }

                    }
                    else {

                        closeLoader()

                        modalAlert('danger', 'Upload de Arquivo(s)', 'Ocorreu um erro!', 'Por favor informe a mensagem abaixo ao suporte:<br><br>'+ RESPONSE.message)
                    }


                }

                function transferFailed(evt) {
                    alert("Um erro ocorreu durante a transferência do arquivo.");
                }

                function transferCanceled(evt) {
                    alert("A transferência foi cancelada pelo usuário.");
                }

            })

        }
        else {

            modalAlert('danger', 'Upload de Arquivos', 'Ocorreu um erro!', 'Por favor atualize a página e caso o erro persista, informe o módulo em que identificou o problema e o código (NFIPT)')

        }

    }


    // Uploader - Change Input
    if(__exists(__select('.form-upload-input'))) {

        __selectAll('.form-upload-input').forEach((elem) => {

            elem.addEventListener('change', function (e) {

                var fileinput =  e.target

                var textinput =  fileinput.parentNode.querySelector('.label-placeholder')

                var div = fileinput.parentNode

                var file = fileinput.files[0]
                var upload, formData, numb
                var UploadStatus = true
                var num_files = fileinput.files.length
                var multiple = fileinput.getAttribute('multiple')
                var defaultText = textinput.innerHTML;

                if(multiple === 'multiple') {

                    var numb = 0
                    var max = fileinput.getAttribute('limit')
                    var limit = fileinput.dataset.limit

                    if(num_files > parseInt(max)) {
                        modalAlert('danger', 'Upload de Arquivo(s)', 'Número de Arquivos Excedido', 'Você deve selecionar no <strong>máximo '+ limit +' arquivo(s)</strong>, tente novamente.')
                    }
                    else {

                        for(var i=0; i<num_files; i++) {

                            numb = fileinput.files[i].size/1024/1024;
                            numb = numb.toFixed(2);

                            if(numb > parseFloat(limit)) {
                                fileinput.value = '';
                                UploadStatus = false;
                                textinput.innerHTML = 'Selecione o(s) arquivos';
                                modalAlert('danger', 'Upload de Arquivo(s)', 'Tamanho de Arquivo(s) Excedido', 'Nenhum arquivo pode exceder <strong>'+ fileinput.dataset.limit +' MB</strong>, selecione-os novamente.');
                                break;
                                return false;
                            }

                        }

                        textinput.innerHTML = num_files+' arquivo(s) selecionado(s)';

                    }

                }
                else {

                    textinput.innerHTML = fileinput.value

                    numb = file.size/1024/1024
                    numb = numb.toFixed(2)

                    if(numb > parseFloat(fileinput.dataset.limit)) {

                        fileinput.value = ''
                        UploadStatus = false
                        textinput.innerHTML = defaultText
                        modalAlert('danger', 'Upload de Arquivo(s)', 'Tamanho de Arquivo(s) Excedido!', 'Nenhum arquivo pode exceder <strong>'+ fileinput.dataset.limit +' MB</strong>, selecione-os novamente.')

                        return false

                    }

                }

                if(UploadStatus) {

                    div.querySelectorAll('.button').forEach((btn) => {

                        btn.style.display = 'block'

                    })

                }
                else {

                    if(__exists(__select('.btn-remover'))) { div.querySelector('.btn-remover').style.display = 'block' }

                }

            })

        })

    }


    // Uploader - Remove Files from list
    __on('.form-upload-box', 'click', '.btn-remover', (elem) => {

        var father = elem.target.closest('.form-upload-box')
        var fileinput = father.querySelector('input.form-upload-input')
        var textinput = father.querySelector('.form-upload-label .label-placeholder')

        fileinput.value = ''

        textinput.innerHTML = textinput.dataset.placeholder

        father.querySelectorAll('.form-upload-label .button').forEach((elem) => {
            elem.style.display = 'none';
        });

    });
