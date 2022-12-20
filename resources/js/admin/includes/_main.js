
    /*
    * Dom Load
    */
    __load = function(fnc) {
        document.addEventListener("DOMContentLoaded", function() { fnc });
    }


    /*
    * Verify if Exists
    */

    __exists = function(elem, returnElem = false) {

        if(typeof elem !== 'undefined' && elem !== false && elem !== null) {

           return (returnElem) ? elem : true

        }

        return (returnElem) ? null : false

    }

    /*
    * Query Selectors
    */

    __select = function ( selector ) {

        if(__exists(document.querySelector(selector))) {

            return document.querySelector(selector)

        }

    }

    __selectAll = function ( selector ) {

        return document.querySelectorAll(selector)

    }

    /*
    * Get Element By Id
    * Return Element
    */

    __getById = function ( id ) {
        return document.getElementById(id)

    }

    /*
    * Get Elements By Name
    * Return Object List
    */

    __getByName = function ( name ) {
        return document.getElementsByName(name);
    }

    /*
    * Get Elements By Class Name
    * Return Object List
    */

    __getByClass = function ( className ) {
        return document.getElementsByClassName(className);
    }

    /*
    * Get Elements By Tag Name
    * Return Object List
    */

    __getByTag = function ( tag ) {
        return document.getElementsByTagName(tag);
    }

    /*
    * Hide Element on DOM
    */

    __hide = function(selector, all = false) {

        if(!all) {
            var element = __select(selector)
            element.style.display = 'none'
        }
        else {
            var elements = __selectAll(selector)

            elements.forEach((element) => {
                element.style.display = 'none'
            })
        }

    }

    /*
    * Remove Element from DOM
    */

    __remove = function(selector, all = false) {

        if(!all) {

            var element = __select(selector)

            if(element !== undefined && element !== null) {
                element.parentNode.removeChild(element)
            }
        }
        else {

            var elements = __selectAll(selector)

            if(elements.length > 0) {

                elements.forEach((element) => {
                    element.parentNode.removeChild(element)
                })

            }

        }

    }

    /*
    * Insert Element Before Selector
    */

    __before = function(content, selector) {
        var target = (typeof selector === 'string') ? __select(selector) : selector
        target.insertAdjacentHTML('beforebegin', content)
    }

    /*
    * Insert Element after Selector
    */

    __after = function(content, selector) {
        var target = (typeof selector === 'string') ? __select(selector) : selector
        target.insertAdjacentHTML('afterend', content)
    }

    /*
    * Insert Element After first child of Element
    */

    __prepend = function(content, selector) {
        var target = (typeof selector === 'string') ? __select(selector) : selector
        target.insertAdjacentHTML('afterbegin', content)
    }

    /*
    * Insert Element after last child of Element
    */

    __append = function(content, selector) {
        var target = (typeof selector === 'string') ? __select(selector) : selector
        target.insertAdjacentHTML('beforeend', content)
    }

    /*
    * Insert event function
    */
    __on = function (selector, event, childSelector, handler) {

        var is = function(el, selector) {
          return (el.matches || el.matchesSelector || el.msMatchesSelector || el.mozMatchesSelector || el.webkitMatchesSelector || el.oMatchesSelector).call(el, selector);
        };

        var elements = document.querySelectorAll(selector);
        [].forEach.call(elements, function(el, i){
            el.addEventListener(event, function(e) {
                if (is(e.target, childSelector)) {
                    handler(e);
                }
            });
        });
    }

    /*
    * Slide Up Element
    */

    slideUp = function(target, duration=500, callback = null) {

        if(typeof target.length === 'undefined') {

            target.style.transitionProperty = 'height, margin, padding';
            target.style.transitionDuration = duration + 'ms';
            target.style.boxSizing = 'border-box';
            target.style.height = target.offsetHeight + 'px';
            target.offsetHeight;
            target.style.overflow = 'hidden';
            target.style.height = 0;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            window.setTimeout( () => {
                target.style.display = 'none';
                target.style.removeProperty('height');
                target.style.removeProperty('padding-top');
                target.style.removeProperty('padding-bottom');
                target.style.removeProperty('margin-top');
                target.style.removeProperty('margin-bottom');
                target.style.removeProperty('overflow');
                target.style.removeProperty('transition-duration');
                target.style.removeProperty('transition-property');
                //alert("!");

                if(callback !== null) { callback() }

            }, duration);

        }
        else {

            target.forEach((elem) => {

                elem.style.transitionProperty = 'height, margin, padding';
                elem.style.transitionDuration = duration + 'ms';
                elem.style.boxSizing = 'border-box';
                elem.style.height = elem.offsetHeight + 'px';
                elem.offsetHeight;
                elem.style.overflow = 'hidden';
                elem.style.height = 0;
                elem.style.paddingTop = 0;
                elem.style.paddingBottom = 0;
                elem.style.marginTop = 0;
                elem.style.marginBottom = 0;
                window.setTimeout( () => {
                    elem.style.display = 'none';
                    elem.style.removeProperty('height');
                    elem.style.removeProperty('padding-top');
                    elem.style.removeProperty('padding-bottom');
                    elem.style.removeProperty('margin-top');
                    elem.style.removeProperty('margin-bottom');
                    elem.style.removeProperty('overflow');
                    elem.style.removeProperty('transition-duration');
                    elem.style.removeProperty('transition-property');
                    //alert("!");

                    if(callback !== null) { callback() }

                }, duration);

            })

        }

    }

    /*
    * Slide Down Element
    */

    slideDown = function(target, duration=500, callback = null) {

        if(typeof target.length === 'undefined') {

            target.style.removeProperty('display');
            let display = window.getComputedStyle(target).display;
            if (display === 'none') display = 'block';
            target.style.display = display;
            let height = target.offsetHeight;
            target.style.overflow = 'hidden';
            target.style.height = 0;
            target.style.paddingTop = 0;
            target.style.paddingBottom = 0;
            target.style.marginTop = 0;
            target.style.marginBottom = 0;
            target.offsetHeight;
            target.style.boxSizing = 'border-box';
            target.style.transitionProperty = "height, margin, padding";
            target.style.transitionDuration = duration + 'ms';
            target.style.height = height + 'px';
            target.style.removeProperty('padding-top');
            target.style.removeProperty('padding-bottom');
            target.style.removeProperty('margin-top');
            target.style.removeProperty('margin-bottom');
            window.setTimeout( () => {

            target.style.removeProperty('height');
            target.style.removeProperty('overflow');
            target.style.removeProperty('transition-duration');
            target.style.removeProperty('transition-property');

                if(callback !== null) { callback() }

            }, duration);

        }
        else {

            target.forEach((elem) => {

                elem.style.removeProperty('display');
                let display = window.getComputedStyle(elem).display;
                if (display === 'none') display = 'block';
                elem.style.display = display;
                let height = elem.offsetHeight;
                elem.style.overflow = 'hidden';
                elem.style.height = 0;
                elem.style.paddingTop = 0;
                elem.style.paddingBottom = 0;
                elem.style.marginTop = 0;
                elem.style.marginBottom = 0;
                elem.offsetHeight;
                elem.style.boxSizing = 'border-box';
                elem.style.transitionProperty = "height, margin, padding";
                elem.style.transitionDuration = duration + 'ms';
                elem.style.height = height + 'px';
                elem.style.removeProperty('padding-top');
                elem.style.removeProperty('padding-bottom');
                elem.style.removeProperty('margin-top');
                elem.style.removeProperty('margin-bottom');
                window.setTimeout( () => {

                    elem.style.removeProperty('height');
                    elem.style.removeProperty('overflow');
                    elem.style.removeProperty('transition-duration');
                    elem.style.removeProperty('transition-property');

                    if(callback !== null) { callback() }

                }, duration);

            })

        }
    }

    /*
    * Slide Toggle Element
    */

    slideToggle = (target, duration = 500) => {
        if (window.getComputedStyle(target).display === 'none') {
          return slideDown(target, duration);
        } else {
          return slideUp(target, duration);
        }
    }

    /*
    * Fade Effects
    */

    !function(){"use strict";var e={linear:function(e){return e},quadratic:function(e){return Math.pow(e,2)},swing:function(e){return.5-Math.cos(e*Math.PI)/2},circ:function(e){return 1-Math.sin(Math.acos(e))},bounce:function(e){for(var t=0,n=1;;t+=n,n/=2)if(e>=(7-4*t)/11)return-Math.pow((11-6*t-11*e)/4,2)+Math.pow(n,2)}};function t(t,n,o,i,a){var r,c;if(t){if(r=i.name.replace("_",""),c=parseInt(t),isNaN(c))throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter 1 ('duration') is not an number.')"));if(c<0)throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter 1 ('duration') is not a valid number.')"))}if(n){if(r=i.name.replace("_",""),c=parseFloat(n),isNaN(c))throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter 2 ('opacity') is not an number.')"));if(c<0||c>1)throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter 2 ('opacity') is not a valid number.')"))}if(o){if(r=i.name.replace("_",""),c=o,"string"!=typeof o)throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter ('easing') is not an string.')"));if("function"!=typeof e[c])throw new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter ('easing') is not a valid easing function.')"))}if(a&&"function"!=typeof a)throw r=i.name.replace("_",""),new TypeError("Failed to execute '".concat(r,"' on 'Element': parameter ('complete') is not an function.')"));var l=function(e,t,n,o){var i;return function a(r){i||(i=r);var c=r-i,l=Math.min(c/e,1);n(t(l)),c>=e?o&&o():window.requestAnimationFrame(a)}}(t=window.matchMedia("(prefers-reduced-motion: reduce)").matches?1:parseInt(t),e[o],i,a);window.requestAnimationFrame(l)}window.Element.prototype.fadeIn=function(){var e=this,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:250,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"linear",i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,a=parseFloat(window.getComputedStyle(this).opacity),r=1,c=function(t){e.style.opacity=a+(r-a)*t};1!==a&&t(n,r,o,c,i)},window.Element.prototype.fadeOut=function(){var e=this,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:250,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"linear",i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,a=parseFloat(window.getComputedStyle(this).opacity),r=0,c=function(t){e.style.opacity=a-a*t};0!==a&&t(n,r,o,c,i)},window.Element.prototype.fadeToggle=function(){var e=this,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:250,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"linear",i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null,a=parseFloat(window.getComputedStyle(this).opacity),r=a<.5?1:0,c=function(t){e.style.opacity=a<.5?a+(r-a)*t:a-a*t};t(n,r,o,c,i)},window.Element.prototype.fadeTo=function(){var e=this,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:250,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:NaN,i=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"linear",a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,r=parseFloat(window.getComputedStyle(this).opacity),c=parseFloat(o),l=function(t){e.style.opacity=r+(c-r)*t};r!==c&&t(n,c,i,l,a)}}();


    /*
    * Regular Expressions
    */

    var ERemail = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/)
    var ERnan   = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/)
    var ERphone  = new RegExp(/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/)
    var ERdate  = new RegExp(/^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$/)
    var ERname = new RegExp(/^((\b[A-zÀ-ú']{1,40}\b)\s*){2,}$/)
    var ERcpf = new RegExp(/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/)
    var ERcnpfj = new RegExp(/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/)

    /*
    * Mask Events
    */

    function execMask (o, f) { o.value = f(o.value); }
    function mask (o,f){ execMask(o, f); }

    maskDate = function (v) { v=v.replace(/\D/g,''); v=v.replace(/(\d{2})(\d)/,'$1/$2'); v=v.replace(/(\d{2})(\d)/,'$1/$2'); v=v.replace(/(\d{2})(\d{2})$/,'$1$2'); return v; }
    maskDateMin = function (v) { v=v.replace(/\D/g,''); v=v.replace(/(\d{2})(\d)/,'$1/$2'); v=v.replace(/(\d{2})(\d)/,'$1/$2'); return v; }
    maskHour = function (v) { v=v.replace(/\D/g,''); v=v.replace(/(\d{2})(\d)/,'$1:$2'); v=v.replace(/(\d{2})(\d)/,'$1:$2'); return v; }
    maskPhone = function(v) { v=v.replace(/\D/g, ''); if(v.length == 10) { v=v.replace(/^(\d\d)(\d)/g, '($1) $2'); v=v.replace(/(\d{4})(\d)/,'$1-$2'); return v; } else { v=v.replace(/^(\d\d)(\d)/g, '($1) $2'); v=v.replace(/(\d{5})(\d)/,'$1-$2'); return v; } }
    maskZipcode = function (v) { v=v.replace(/\D/g, ''); v=v.replace(/(\d{2})(\d)/,'$1.$2'); v=v.replace(/(\d{3})(\d)/,'$1-$2'); return v; }
    maskCPF = function (v){ v=v.replace(/\D/g, ''); v=v.replace(/(\d{3})(\d)/,'$1.$2'); v=v.replace(/(\d{3})(\d)/,'$1.$2'); v=v.replace(/(\d{3})(\d{1,2})$/,'$1-$2'); return v; }
    maskCNPJ = function (v){	v=v.replace(/\D/g,""); v=v.replace(/^(\d{2})(\d)/,"$1.$2"); v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3"); v=v.replace(/\.(\d{3})(\d)/,".$1/$2"); v=v.replace(/(\d{4})(\d)/,"$1-$2"); return v }
    maskPercent = function (v){ v=v.replace(/\D/g,''); v=v.replace(/(\d{2})(\d{2})$/,'$1.$2'); return v; }
    maskLetters = function (v) { return v.replace(/\d/g,''); }
    maskLettersUpperCase = function (v){ v=v.toUpperCase(); return v.replace(/\d/g,''); }
    maskLettersLowerCase = function (v){ v=v.toLowerCase(); return v.replace(/\d/g,''); }
    maskUpperCase = function (v){ return v.toUpperCase(); }
    maskLowerCase = function (v){ return  v.toLowerCase(); }
    maskCreditCard = function(v){ v=v.replace(/\D/g, ''); v=v.replace(/^(\d{4})(\d)/g,'$1 $2'); v=v.replace(/^(\d{4})\s(\d{4})(\d)/g,'$1 $2 $3'); v=v.replace(/^(\d{4})\s(\d{4})\s(\d{4})(\d)/g, '$1 $2 $3 $4'); return v; }
    maskNames = function(v) {
        let d = v.split(' ');
        let t = '';

        for(var i = 0; i < d.length; i++) {
            if(d[i].length > 2 && d[i] !== 'dos' && d[i] !== 'das' && d[i] !== 'los' && d[i] !== 'las') {
                t += ((t != '') ? ' ' : '') + d[i].charAt(0).toUpperCase() + d[i].slice(1).toLowerCase()
            }
            else {
                t += ((t != '') ? ' ' : '') + d[i]
            }
        }

        return t
    }

    trim = function (stringToTrim) { return stringToTrim.replace(/^\s+|\s+$/g,'') }
    ltrim = function (stringToTrim) { return stringToTrim.replace(/^\s+/,'') }
    rtrim = function (stringToTrim) { return stringToTrim.replace(/\s+$/,'') }
    supertrim = function (StringToTrim){ return( StringToTrim.replace( /^\s+|\s+$/gi, '' ).replace( /\s{2,}/gi, ' ' ) ) }

    /*
    * Money Format
    */

    formatMoney = function(element) {
        var v = element.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(".", ",");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
        element.value = v;
    }

    /*
    * Convert new lines to linebreaks
    */
    nl2br = (str, is_xhtml) => {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }

    /*
    * Lazy Load
    */

    lazyLoad = function() {

        var _images = __selectAll("img.lazy")

        var imgOptions = {
            threshold: 0.2
        };

        const imgObserver = new IntersectionObserver((entries, imgObserver) => {

            entries.forEach((entry) => {

                if (!entry.isIntersecting) return

                const _img = entry.target

                _img.src = _img.getAttribute('data-src')
                _img.classList.remove('lazy')
                _img.removeAttribute('data-src')

                imgObserver.unobserve(entry.target)

            });

        }, imgOptions)

        _images.forEach((_img) => {
            imgObserver.observe(_img);
        })

    }

    lazyStyles = function() {

        var _items = __selectAll(".lazy-style")

        var itemObserver = new IntersectionObserver((entries, itemObserver) => {

            entries.forEach((entry) => {

                if (!entry.isIntersecting) return

                var _item = entry.target

                _item.setAttribute('style', _item.getAttribute('data-style'))
                _item.classList.remove('lazy-style')
                _item.removeAttribute('data-style')

                itemObserver.unobserve(entry.target)

            })

        }, {})

        _items.forEach((_item) => {
            itemObserver.observe(_item);
        })

    }

    /*
    * Preloader Functions
    */

    Loader = function (msg = '') {
        if(__exists(__select('.preloader'))) {

            __select('.preloader div').innerHTML = msg

            elem = __select('.preloader')
            elem.style['z-index'] = 5000
            elem.fadeTo(250, 1)
        }
    }

    closeLoader = function () {

        if(__exists(__select('.preloader'))) {

            elem = __select('.preloader');

            if(__exists(elem)) {
                elem.fadeOut()
                elem.style['z-index'] = '-1'
            }

        }

        __select('body').classList.remove('lock-body')

    }

    /*
    * Capitailze First
    */

    capitalizeFirstLetter = ([ first, ...rest ], locale = navigator.language) => first.toLocaleUpperCase(locale) + rest.join('')

    /*
    * Date Controls
    */

    validateDate = function (data) {

        reg = /[^\d\/\.]/gi
        var date = data.replace(reg,'')

        if (date && date.length == 10) {

            var year = data.substr(6)
            var month = data.substr(3,2)
            var day = data.substr(0,2)

            var M30 = ['04','06','09','11']
            var v_month = /(0[1-9])|(1[0-2])/.test(month)
            var v_year = /(19[1-9]\d)|(20\d\d)|2100/.test(year)
            var rexpr = new RegExp(month)
            var fev29 = year % 4? 28: 29

            if (v_month && v_year) {

                if (month == '02') { return (day >= 1 && day <= fev29) }
                else if (rexpr.test(M30)) { return /((0[1-9])|([1-2]\d)|30)/.test(day) }
                else { return /((0[1-9])|([1-2]\d)|3[0-1])/.test(day) }

            }

        }

        return false

    }

    getAge = function (birthDate) {
        return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e+10);
    }

    legalAge = function (birthDate) {

        var borndate = birthDate.split("/")
        var _borndate = new Date(parseInt(borndate[2], 10),
        parseInt(borndate[1], 10) - 1,
        parseInt(borndate[0], 10))

        var diff = Date.now() -  _borndate.getTime()
        var age = new Date(diff)

        return (Math.abs(age.getUTCFullYear() - 1970) >= 18)

    }

    /*
    * Validation Fields
    */

    validateCNPJ = function (cnpj) { cnpj = cnpj.replace(/[^\d]+/g,'');if(cnpj == '') { return false; } if(cnpj.length < 14) { return false; } if (cnpj == '00000000000000' || cnpj == '11111111111111' || cnpj == '22222222222222' || cnpj == '33333333333333' || cnpj == '44444444444444' || cnpj == '55555555555555' || cnpj == '66666666666666' || cnpj == '77777777777777' || cnpj == '88888888888888' || cnpj == '99999999999999') { return false; } var tamanho = cnpj.length - 2; var numeros = cnpj.substring(0,tamanho); var digitos = cnpj.substring(tamanho); var soma = 0; var pos = tamanho - 7; for (i = tamanho; i >= 1; i--) { soma += numeros.charAt(tamanho - i) * pos--; if (pos < 2) { pos = 9; } } var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11; if (resultado != digitos.charAt(0)) { return false; } tamanho = tamanho + 1; numeros = cnpj.substring(0,tamanho); soma = 0; pos = tamanho - 7; for (i = tamanho; i >= 1; i--) { soma += numeros.charAt(tamanho - i) * pos--; if (pos < 2) { pos = 9; } } var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11; if (resultado != digitos.charAt(1)) { return false; } return true; };

    validateCPF = function (NUM) { var cpf = NUM.replace('.', ''); var cpf = cpf.replace('.', ''); var cpf = cpf.replace('-', ''); var i; var s = cpf;  var erro_cpf; var c = s.substr(0,9); var dv = s.substr(9,2); var d1 = 0; for (i = 0; i < 9; i++) { 	d1 += c.charAt(i)*(10-i); } if (d1 == 0) { 	var erro_cpf = 0; } d1 = 11 - (d1 % 11); if (d1 > 9) { d1 = 0;} if (dv.charAt(0) != d1) { var erro_cpf = 0; } d1 *= 2; for (i = 0; i < 9; i++) { d1 += c.charAt(i)*(11-i); } d1 = 11 - (d1 % 11); if (d1 > 9)  { d1 = 0; } if (dv.charAt(1) != d1) 	{ 	var erro_cpf = 0; } if(erro_cpf == 0) { return(false); } else { 	return(true);	 } };

    /*
    * Math Items
    */

    randomInt = function(min, max) { return min + Math.floor((max - min) * Math.random()) }

    randomFloat = function(min, max) { return min + (max - min) * Math.random() }

    /*
    * URL Functions
    */

    changeUrl = function (url) {
        window.history.pushState('', '', url)
    }

    strToURL = function (str) {

        return str.toLowerCase().trim()
        .replace(/[áàãâä]/g, 'a')
        .replace(/[éè?êë]/g, 'e')
        .replace(/[íìiîï]/g, 'i')
        .replace(/[óòõôö]/g, 'o')
        .replace(/[úùuûü]/g, 'u')
        .replace(/ç/g, 'c')
        .replace(/(\ |_)+/, ' ')
        .replace(/(^-+|-+$)/, '')
        .replace(/[^a-z0-9]+/g,'-')

    }

    mountUrlVars = function (vars) {

        var url_params = ''

        for(key in vars){
            url_params +=  '&'+ key +'='+ vars[key]
        }

        return url_params

    }

    getUrlVars =  function () {

        var vars = {}
        var url = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, '')
        var site_url = url
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value
        })

        var retorno = {}
        retorno.site_url = site_url
        retorno.vars = vars

        return retorno

    }

    __on('body', 'keypress', 'input.url', (e) => {

        var e = e || window.event;
        var key = e.charCode;
        if (key === undefined)
            key = e.keyCode;

        //maiusculas, minusculas, números e traço
        if ((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key >= 48 && key <= 57) || (key == 45) || (key == 32))
            return true;

        //Não imprime letra
        if (key == 0)
            return true;

        return false;

    })

    __on('body', 'keyup', 'input.url', (e) => {

        var txt = e.target
        txt.value = txt.value.replace(/[\s]/gi, '-')
        txt.value = txt.value.toLowerCase()
        txt.value = txt.value.replace(/[^a-z0-9--]/gi, '')

        return true

    })


    /*******************************************************************
    * Refresh Page
    *******************************************************************/

    refreshPage = function () {
        window.location.reload()
    }


    /*****************************************
     * Delay Redirect Function
     ******************************************/

    delayLocation = function(URL, TIME) {

        setTimeout(function() {
            window.location = URL
        }, TIME)

    }


    /*****************************************
     External links
    ******************************************/

    __selectAll('.external').forEach((elem) => {

        elem.target.addEventListener('click', (e) => {

            e.preventDefault()

            if(typeof e.dataset.href !== undefined && e.target.dataset.href !== '') {

                window.open(e.target.dataset.href)

            }
            else {

                window.open(e.target.dataset.href)

            }

        })

    })


    /*****************************************
     * Maxlength Control
     ******************************************/

    __selectAll('input.form-control:not([maxlength=""])').forEach((elem) => {

        var field = elem;

        "keyup keypress".split(" ").forEach((e) => {

            field.addEventListener(e, function(y) {

                if(typeof field.getAttribute("maxlength") !== undefined && field.getAttribute("maxlength")) {

                    var maxLength = field.getAttribute("maxlength")

                    if(field.value.length >= maxLength) {

                        if(y.keyCode == 8 || y.keyCode == 46 || y.keyCode == 37 || y.keyCode == 38 || y.keyCode == 39 || y.keyCode == 40) {

                            return true

                        }
                        else {

                            y.preventDefault()
                            return false

                        }

                    }

                }

            })

        })

    })


    /*****************************************
     * Count Chars
     ******************************************/

    CountCharacters = function (target, val, limit) {

        var len = val.length

        if(len > limit) { len = '<strong style=\"color:#FF0000;\">'+ len + '</strong>' }

        target.html(len)

    }


    /*
    * Encrypt / Decript
    */

    function Encrypt(str) {
        if (!str) str = "";
        str = (str == "undefined" || str == "null") ? "" : str;
        try {
            var key = 146;
            var pos = 0;
            ostr = '';
            while (pos < str.length) {
                ostr = ostr + String.fromCharCode(str.charCodeAt(pos) ^ key);
                pos += 1;
            }

            return ostr;
        } catch (ex) {
            return '';
        }
    }

    function Decrypt(str) {
        if (!str) str = "";
        str = (str == "undefined" || str == "null") ? "" : str;
        try {
            var key = 146;
            var pos = 0;
            ostr = '';
            while (pos < str.length) {
                ostr = ostr + String.fromCharCode(key ^ str.charCodeAt(pos));
                pos += 1;
            }

            return ostr;
        } catch (ex) {
            return '';
        }
    }

    function encode( content ) {

        return Base64.encode(encodeURI(content))

    }

    function decode( content ) {

        return Base64.decode(content)

    }

    const Base64 = {

        _keyStr: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=',
        encode: function(input) { var output = ''; var chr1, chr2, chr3, enc1, enc2, enc3, enc4; var i = 0; input = Base64._utf8_encode(input); while (i < input.length) { chr1 = input.charCodeAt(i++); chr2 = input.charCodeAt(i++); chr3 = input.charCodeAt(i++); enc1 = chr1 >> 2; enc2 = ((chr1 & 3) << 4) | (chr2 >> 4); enc3 = ((chr2 & 15) << 2) | (chr3 >> 6); enc4 = chr3 & 63; if (isNaN(chr2)) { enc3 = enc4 = 64; } else if (isNaN(chr3)) { enc4 = 64; } output = output + this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4); } return output; },
        decode: function(input) { var output = ''; var chr1, chr2, chr3; var enc1, enc2, enc3, enc4; var i = 0; input = input.replace(/[^A-Za-z0-9\+\/\=]/g, ''); while (i < input.length) { enc1 = this._keyStr.indexOf(input.charAt(i++)); enc2 = this._keyStr.indexOf(input.charAt(i++)); enc3 = this._keyStr.indexOf(input.charAt(i++)); enc4 = this._keyStr.indexOf(input.charAt(i++)); chr1 = (enc1 << 2) | (enc2 >> 4); chr2 = ((enc2 & 15) << 4) | (enc3 >> 2); chr3 = ((enc3 & 3) << 6) | enc4; output = output + String.fromCharCode(chr1); if (enc3 != 64) { output = output + String.fromCharCode(chr2); } if (enc4 != 64) { output = output + String.fromCharCode(chr3); } } output = Base64._utf8_decode(output); return output; },
        _utf8_encode: function(string) { string = string.replace(/\r\n/g, '\n'); var utftext = ''; for (var n = 0; n < string.length; n++) { var c = string.charCodeAt(n); if (c < 128) { utftext += String.fromCharCode(c);} else if ((c > 127) && (c < 2048)) { utftext += String.fromCharCode((c >> 6) | 192); utftext += String.fromCharCode((c & 63) | 128); } else { utftext += String.fromCharCode((c >> 12) | 224); utftext += String.fromCharCode(((c >> 6) & 63) | 128); utftext += String.fromCharCode((c & 63) | 128); } } return utftext; },
        _utf8_decode: function(utftext) { var string = ''; var i = 0; var c = c1 = c2 = 0; while (i < utftext.length) { c = utftext.charCodeAt(i); if (c < 128) { string += String.fromCharCode(c); i++; } else if ((c > 191) && (c < 224)) { c2 = utftext.charCodeAt(i + 1); string += String.fromCharCode(((c & 31) << 6) | (c2 & 63)); i += 2; } else { c2 = utftext.charCodeAt(i + 1); c3 = utftext.charCodeAt(i + 2); string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63)); i += 3; } }  return string; }

    }

    /*
    * Auto-Validations Forms
    */

    const multiSearchAnd = (text, searchWords) => (
        searchWords.every((el) => {
            return text.match(new RegExp(el,"i"))
        })
    )

    const multiSearchOr = (text, searchWords) => (
        searchWords.some((el) => {
            return text.match(new RegExp(el,"i"))
        })
    )

    const arraySearchAnd = (haystack, needle) => (

        needle.every((word) => {
            return haystack.contains(word)
        })

    )

    const arraySearchOr = (haystack, needle) => (
        needle.some((word) => {
            return haystack.contains(word)
        })
    )

