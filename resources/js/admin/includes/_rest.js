
    const __post = async ( args, callback ) => {

        return await callAPI('POST', args, callback)

    }

    const __get = async ( args, callback ) => {

        return await callAPI('GET', args, callback)

    }

    const __put = async ( args, callback ) => {

        return await callAPI('PUT', args, callback)

    }

    const __update = async ( args, callback ) => {

        return await callAPI('PUT', args, callback)

    }

    const __delete = async ( args, callback ) => {

        return await callAPI('DELETE', args, callback)

    }

    async function __httpRequest(method,  args, callback = (response) => { console.info(response); }) {

        var myHeaders = new Headers(args[1] ?? myHeaders);

        var myRequest = new Request(
            API_URL + args[0],
            {
                credentials: "same-origin",
                mode: "same-origin",
                method: method,
                headers: myHeaders,
                body: (typeof args[2] !== undefined) ? JSON.stringify(args[2]) : {}
            }
        )

        fetch(myRequest)

        .then(function (response) {

            if (!response.ok) {
                throw new Error(`Request failed with status ${response.status}`)
            }

            return response.json()

        }).then(function (data) {

            return callback(data);

        }).catch(function (error) {

            console.warn('Something went wrong.', error)

        });

    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }

    function setCookie(name, info, dateLimit = '', path = '/') {

        if(dateLimit === '') {
            const dateLimit = new Date();
            dateLimit.setHours( dateLimit.getDate() + 1 );
        }

        document.cookie = name +"="+ info +"; expires="+ dateLimit +"'; path="+ path;

    }

    const callAPI = async (method, route, postData) => {

        if(['GET', 'POST', 'PUT', 'DELETE'].includes(method)) {

            return new Promise(function (resolve, reject) {

                var xhr = new XMLHttpRequest()
                xhr.open(method, '/admin/' + route)
                xhr.setRequestHeader('Content-Type', 'application/json')
                xhr.setRequestHeader('Auth-Key', (getCookie('AuthKeyCK') ?? ''))
                xhr.setRequestHeader('Auth-Token', (getCookie('AuthTokenCK') ?? ''))
                xhr.onload = function () {

                    if (this.status >= 200 && this.status < 300) {

                        resolve(JSON.parse(xhr.response))

                    } else {

                        reject({
                            status: this.status,
                            statusText: xhr.statusText
                        })

                    }

                }

                xhr.onerror = function () {

                    reject({
                        status: this.status,
                        statusText: xhr.statusText
                    })

                };

                if(['POST', 'PUT', 'DELETE'].includes(method) && postData){

                    xhr.send(JSON.stringify(postData))

                } else {

                    xhr.send()

                }

            })

        }
        else {

            return handlerResponse({ 'result': 'error', 'message': 'Erro Método' });

        }

    }

    const callURL = async (method, url, postData, otherHeaders = {}) => {

        if(['GET', 'POST', 'PUT', 'DELETE'].includes(method)) {

            return new Promise(function (resolve, reject) {

                var xhr = new XMLHttpRequest()
                xhr.open(method, url)
                xhr.setRequestHeader('Content-Type', 'application/json')

                if(myHeaders.AuthCode !== '') {
                    xhr.setRequestHeader('Authcode', myHeaders.AuthCode)
                }

                if(otherHeaders.length > 0) {

                    otherHeaders.forEach((index, value) => xhr.setRequestHeader(index, value))

                }

                xhr.onload = function () {

                    if (this.status >= 200 && this.status < 300) {

                        resolve(JSON.parse(xhr.response))

                    } else {

                        reject({
                            status: this.status,
                            statusText: xhr.statusText
                        })

                    }

                }

                xhr.onerror = function () {

                    reject({
                        status: this.status,
                        statusText: xhr.statusText
                    })

                };

                if(['PUT', 'POST', 'DELETE'].includes(method) && postData){

                    xhr.send(JSON.stringify(postData))

                } else {

                    xhr.send()

                }

            })

        }
        else {

            return handlerResponse({ 'result': 'error', 'message': 'Erro Método' });

        }

    }

    const handlerResponse = (response) => {

        if(typeof response.body == 'undefined') {

            Toastify({ text: response.message, className: 'toastify-danger', gravity: 'bottom' }).showToast()

        }
        else {

            if(typeof response.message !== 'undefined') {

                Toastify({ text: response.message, className: 'toastify-'+ response.style, gravity: 'bottom' }).showToast()

            }

        }

        return response;

    }
