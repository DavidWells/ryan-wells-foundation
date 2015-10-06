/**
 * # _inbound UTILS
 *
 * This file contains all of the utility functions used by analytics
 *
 * @author David Wells <david@inboundnow.com>
 * @version 0.0.1
 */
var _inboundUtils = (function(_inbound) {

    var storageSupported;

    _inbound.Utils = {
        init: function() {

            this.polyFills();
            this.checkLocalStorage();
            this.SetUID();
            this.storeReferralData();

        },
        /*! http://stackoverflow.com/questions/951791/javascript-global-error-handling */
        /* Polyfills for missing browser functionality */
        polyFills: function() {
            /* Console.log fix for old browsers */
            if (!window.console) {
                window.console = {};
            }
            var m = [
                "log", "info", "warn", "error", "debug", "trace", "dir", "group",
                "groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
                "dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
            ];
            // define undefined methods as noops to prevent errors
            for (var i = 0; i < m.length; i++) {
                if (!window.console[m[i]]) {
                    window.console[m[i]] = function() {};
                }
            }
            /* Event trigger polyfill for IE9 and 10
            (function() {
                function CustomEvent(event, params) {
                    params = params || {
                        bubbles: false,
                        cancelable: false,
                        detail: undefined
                    };
                    var evt = document.createEvent('CustomEvent');
                    evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
                    return evt;
                }

                CustomEvent.prototype = window.Event.prototype;

                window.CustomEvent = CustomEvent;
            })();*/
            /* custom event for ie8+ https://gist.github.com/WebReflection/6693661 */
            try{new CustomEvent('?');}catch(o_O){
              /*!(C) Andrea Giammarchi -- WTFPL License*/
              this.CustomEvent = function(
                eventName,
                defaultInitDict
              ){

                // the infamous substitute
                function CustomEvent(type, eventInitDict) {
                  var event = document.createEvent(eventName);
                  if (type !== null) {
                    initCustomEvent.call(
                      event,
                      type,
                      (eventInitDict || (
                        // if falsy we can just use defaults
                        eventInitDict = defaultInitDict
                      )).bubbles,
                      eventInitDict.cancelable,
                      eventInitDict.detail
                    );
                  } else {
                    // no need to put the expando property otherwise
                    // since an event cannot be initialized twice
                    // previous case is the most common one anyway
                    // but if we end up here ... there it goes
                    event.initCustomEvent = initCustomEvent;
                  }
                  return event;
                }

                // borrowed or attached at runtime
                function initCustomEvent(
                  type, bubbles, cancelable, detail
                ) {
                  this['init' + eventName](type, bubbles, cancelable, detail);
                  'detail' in this || (this.detail = detail);
                }

                // that's it
                return CustomEvent;
              }(
                // is this IE9 or IE10 ?
                // where CustomEvent is there
                // but not usable as construtor ?
                this.CustomEvent ?
                  // use the CustomEvent interface in such case
                  'CustomEvent' : 'Event',
                  // otherwise the common compatible one
                {
                  bubbles: false,
                  cancelable: false,
                  detail: null
                }
              );
            }
            /* querySelectorAll polyfill for ie7+ */
            if (!document.querySelectorAll) {
              document.querySelectorAll = function (selectors) {
                var style = document.createElement('style'), elements = [], element;
                document.documentElement.firstChild.appendChild(style);
                document._qsa = [];

                style.styleSheet.cssText = selectors + '{x-qsa:expression(document._qsa && document._qsa.push(this))}';
                window.scrollBy(0, 0);
                style.parentNode.removeChild(style);

                while (document._qsa.length) {
                  element = document._qsa.shift();
                  element.style.removeAttribute('x-qsa');
                  elements.push(element);
                }
                document._qsa = null;
                return elements;
              };
            }

            if (!document.querySelector) {
              document.querySelector = function (selectors) {
                var elements = document.querySelectorAll(selectors);
                return (elements.length) ? elements[0] : null;
              };
            }
            /* Innertext shim for firefox https://github.com/duckinator/innerText-polyfill/blob/master/innertext.js */
            if ( (!('innerText' in document.createElement('a'))) && ('getSelection' in window) ) {
                HTMLElement.prototype.__defineGetter__("innerText", function() {
                    var selection = window.getSelection(),
                        ranges    = [],
                        str;

                    // Save existing selections.
                    for (var i = 0; i < selection.rangeCount; i++) {
                        ranges[i] = selection.getRangeAt(i);
                    }

                    // Deselect everything.
                    selection.removeAllRanges();

                    // Select `el` and all child nodes.
                    // 'this' is the element .innerText got called on
                    selection.selectAllChildren(this);

                    // Get the string representation of the selected nodes.
                    str = selection.toString();

                    // Deselect everything. Again.
                    selection.removeAllRanges();

                    // Restore all formerly existing selections.
                    for (var i = 0; i < ranges.length; i++) {
                        selection.addRange(ranges[i]);
                    }

                    // Oh look, this is what we wanted.
                    // String representation of the element, close to as rendered.
                    return str;
                })
            }
        },
        /**
         * Create cookie
         *
         * ```js
         * // Creates cookie for 10 days
         * _inbound.utils.createCookie( 'cookie_name', 'value', 10 );
         * ```
         *
         * @param  {string} name        Name of cookie
         * @param  {string} value       Value of cookie
         * @param  {string} days        Length of storage
         */
        createCookie: function(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toGMTString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        },
        /**
         * Read cookie value
         *
         * ```js
         * var cookie = _inbound.utils.readCookie( 'cookie_name' );
         * console.log(cookie); // cookie value
         * ```
         * @param  {string} name name of cookie
         * @return {string}      value of cookie
         */
        readCookie: function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(nameEQ) === 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return null;
        },
        /**
         * Erase cookie
         *
         * ```js
         * // usage:
         * _inbound.utils.eraseCookie( 'cookie_name' );
         * // deletes 'cookie_name' value
         * ```
         * @param  {string} name name of cookie
         * @return {string}      value of cookie
         */
        eraseCookie: function(name) {
            this.createCookie(name, "", -1);
        },
        /* Get All Cookies */
        getAllCookies: function() {
            var cookies = {};
            if (document.cookie && document.cookie !== '') {
                var split = document.cookie.split(';');
                for (var i = 0; i < split.length; i++) {
                    var name_value = split[i].split("=");
                    name_value[0] = name_value[0].replace(/^ /, '');
                    cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
                }
            }
            _inbound.totalStorage('inbound_cookies', cookies); // store cookie data
            return cookies;
        },
        /* Grab URL params and save */
        setUrlParams: function() {
            var urlParams = {};

            (function() {
                var e,
                    d = function(s) {
                        return decodeURIComponent(s).replace(/\+/g, " ");
                    },
                    q = window.location.search.substring(1),
                    r = /([^&=]+)=?([^&]*)/g;

                while (e = r.exec(q)) {
                    if (e[1].indexOf("[") == "-1")
                        urlParams[d(e[1])] = d(e[2]);
                    else {
                        var b1 = e[1].indexOf("["),
                            aN = e[1].slice(b1 + 1, e[1].indexOf("]", b1)),
                            pN = d(e[1].slice(0, b1));

                        if (typeof urlParams[pN] != "object")
                            urlParams[d(pN)] = {},
                            urlParams[d(pN)].length = 0;

                        if (aN)
                            urlParams[d(pN)][d(aN)] = d(e[2]);
                        else
                            Array.prototype.push.call(urlParams[d(pN)], d(e[2]));

                    }
                }
            })();

            /* Set Param Cookies */
            for (var k in urlParams) {
                if (typeof urlParams[k] == "object") {
                    for (var k2 in urlParams[k])
                        this.createCookie(k2, urlParams[k][k2], 30);
                } else {
                    this.createCookie(k, urlParams[k], 30);
                }
            }
            /* Set Param LocalStorage */
            if (storageSupported) {
                var pastParams = _inbound.totalStorage('inbound_url_params') || {};
                var params = this.mergeObjs(pastParams, urlParams);
                _inbound.totalStorage('inbound_url_params', params); // store cookie data
            }

            var options = {'option1': 'yo', 'option2': 'woooo'};

            _inbound.trigger('url_parameters', urlParams, options);

        },
        getAllUrlParams: function() {
            var get_params = {};
            if (storageSupported) {
                var get_params = _inbound.totalStorage('inbound_url_params');
            }
            return get_params;
        },
        /* Get url param */
        getParameterVal: function(name, string) {
            return (RegExp(name + '=' + '(.+?)(&|$)').exec(string)||[,false])[1];
        },
        // Check local storage
        // provate browsing safari fix https://github.com/marcuswestin/store.js/issues/42#issuecomment-25274685
        checkLocalStorage: function() {
            if ('localStorage' in window) {
                try {
                    ls = (typeof window.localStorage === 'undefined') ? undefined : window.localStorage;
                    if (typeof ls == 'undefined' || typeof window.JSON == 'undefined') {
                        storageSupported = false;
                    } else {
                        storageSupported = true;
                    }

                } catch (err) {
                    storageSupported = false;
                }
            }
            return storageSupported;
            /* http://spin.atomicobject.com/2013/01/23/ios-private-browsing-localstorage/
            var hasStorage;
            hasStorage = function() {
              var mod, result;
              try {
                mod = new Date;
                localStorage.setItem(mod, mod.toString());
                result = localStorage.getItem(mod) === mod.toString();
                localStorage.removeItem(mod);
                return result;
              } catch (_error) {}
            };
             */
        },
        // http://stackoverflow.com/questions/4391575/how-to-find-the-size-of-localstorage
        showLocalStorageSize: function() {
              function stringSizeBytes(str) {
                return str.length * 2;
              }

              function toMB(bytes) {
                return bytes / 1024 / 1024;
              }

              function toSize(key) {
                return {
                  name: key,
                  size: stringSizeBytes(localStorage[key])
                };
              }

              function toSizeMB(info) {
                info.size = toMB(info.size).toFixed(2) + ' MB';
                return info;
              }

              var sizes = Object.keys(localStorage).map(toSize).map(toSizeMB);

              //console.table(sizes);
        },
        /* Add days to datetime */
        addDays: function(myDate, days) {
            return new Date(myDate.getTime() + days * 24 * 60 * 60 * 1000);
        },
        GetDate: function() {
            var timeNow = new Date(),
                d = timeNow.getDate(),
                dPre = (d < 10) ? "0" : "",
                y = timeNow.getFullYear(),
                h = timeNow.getHours(),
                hPre = (h < 10) ? "0" : "",
                min = timeNow.getMinutes(),
                minPre = (min < 10) ? "0" : "",
                sec = timeNow.getSeconds(),
                secPre = (sec < 10) ? "0" : "",
                m = timeNow.getMonth() + 1,
                mPre = (m < 10) ? "0" : "";

            var datetime = y + '/' + mPre+m + "/" + dPre+d + " " + hPre+h + ":" + minPre+min + ":" + secPre+sec;
            /* format 2014/11/13 18:22:02 */
            return datetime;
        },
        /* Set Expiration Date of Session Logging. LEGACY Not in Use */
        SetSessionTimeout: function() {
            var session = this.readCookie("lead_session_expire");
            //console.log(session_check);
            if (!session) {
                //_inbound.trigger('session_start'); // trigger 'inbound_analytics_session_start'
            } else {
                //_inbound.trigger('session_resume'); // trigger 'inbound_analytics_session_active'
            }
            var d = new Date();
            d.setTime(d.getTime() + 30 * 60 * 1000);

            this.createCookie("lead_session_expire", true, d, true); // Set cookie on page load

        },
        storeReferralData: function() {
            //console.log(expire_time);
            var d = new Date(),
            referrer = document.referrer || "Direct Traffic",
            referrer_cookie = _inbound.Utils.readCookie("inbound_referral_site"),
            original_src = _inbound.totalStorage('inbound_original_referral');

            d.setTime(d.getTime() + 30 * 60 * 1000);

            if (!referrer_cookie) {
                this.createCookie("inbound_referral_site", referrer, d, true);
            }
            if (!original_src) {
                _inbound.totalStorage('inbound_original_referral', original_src);
            }
        },
        CreateUID: function(length) {
            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split(''),
                str = '';
            if (!length) {
                length = Math.floor(Math.random() * chars.length);
            }
            for (var i = 0; i < length; i++) {
                str += chars[Math.floor(Math.random() * chars.length)];
            }
            return str;
        },
        SetUID: function(leadUID) {
            /* Set Lead UID */
            if (!this.readCookie("wp_lead_uid")) {
                var wp_lead_uid = leadUID || this.CreateUID(35);
                this.createCookie("wp_lead_uid", wp_lead_uid);
            }
        },
        /* Count number of session visits */
        countProperties: function(obj) {
            var count = 0;
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop))
                    ++count;
            }
            return count;
        },
        mergeObjs: function(obj1, obj2) {
            var obj3 = {};
            for (var attrname in obj1) {
                obj3[attrname] = obj1[attrname];
            }
            for (var attrname in obj2) {
                obj3[attrname] = obj2[attrname];
            }
            return obj3;
        },
        hasClass: function(className, el) {
            var hasClass = false;
            if ('classList' in document.documentElement) {
                var hasClass = el.classList.contains(className);
            } else {
                var hasClass = new RegExp('(^|\\s)' + className + '(\\s|$)').test(el.className); /* IE Polyfill */
            }
            return hasClass;
        },
        addClass: function(className, elem) {
            if ('classList' in document.documentElement) {
                elem.classList.add(className);
            } else {
                if (!this.hasClass(elem, className)) {
                    elem.className += (elem.className ? ' ' : '') + className;
                }
            }
        },
        removeClass: function(className, elem) {
            if ('classList' in document.documentElement) {

                elem.classList.remove(className);
            } else {
                if (this.hasClass(elem, className)) {
                    elem.className = elem.className.replace(new RegExp('(^|\\s)*' + className + '(\\s|$)*', 'g'), '');
                }
            }
        },
        removeElement: function (el) {
           el.parentNode.removeChild(el);
        },
        trim: function(s) {
            s = s.replace(/(^\s*)|(\s*$)/gi, "");
            s = s.replace(/[ ]{2,}/gi, " ");
            s = s.replace(/\n /, "\n");
            return s;
        },
        ajaxPolyFill: function() {
            if (typeof XMLHttpRequest !== 'undefined') {
                return new XMLHttpRequest();
            }
            var versions = [
                "MSXML2.XmlHttp.5.0",
                "MSXML2.XmlHttp.4.0",
                "MSXML2.XmlHttp.3.0",
                "MSXML2.XmlHttp.2.0",
                "Microsoft.XmlHttp"
            ];

            var xhr;
            for (var i = 0; i < versions.length; i++) {
                try {
                    xhr = new ActiveXObject(versions[i]);
                    break;
                } catch (e) {}
            }
            return xhr;
        },
        ajaxSendData: function(url, callback, method, data, sync) {
            var x = this.ajaxPolyFill();
            /* timeout for safari idiocy */
            setTimeout(function() {
              x.open(method, url, true);
              x.onreadystatechange = function() {
                  if (x.readyState == 4) {
                      callback(x.responseText)
                  }
              };
              if (method == 'POST') {
                  x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              }
              x.send(data);
            }, 100);
        },
        ajaxGet: function(url, data, callback, sync) {
            var query = [];
            for (var key in data) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
            this.ajaxSendData(url + '?' + query.join('&'), callback, 'GET', null, sync)
        },
        ajaxPost: function(url, data, callback, sync) {
            var query = [];
            for (var key in data) {
                query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
            this.ajaxSendData(url, callback, 'POST', query.join('&'), sync)
        },
        makeRequest: function(url, data) {
            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                httpRequest = new XMLHttpRequest();
            } else if (window.ActiveXObject) { // IE
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {}
                }
            }

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = _inbound.LeadsAPI.alertContents;
            httpRequest.open('GET', url);
            httpRequest.send(data);
        },
        domReady: function(win, fn) {

            var done = false,
                top = true,

                doc = win.document,
                root = doc.documentElement,

                add = doc.addEventListener ? 'addEventListener' : 'attachEvent',
                rem = doc.addEventListener ? 'removeEventListener' : 'detachEvent',
                pre = doc.addEventListener ? '' : 'on',

                init = function(e) {
                    if (e.type == 'readystatechange' && doc.readyState != 'complete') return;
                    (e.type == 'load' ? win : doc)[rem](pre + e.type, init, false);
                    if (!done && (done = true)) fn.call(win, e.type || e);
                },

                poll = function() {
                    try {
                        root.doScroll('left');
                    } catch (e) {
                        setTimeout(poll, 50);
                        return;
                    }
                    init('poll');
                };

            if (doc.readyState == 'complete') fn.call(win, 'lazy');
            else {
                if (doc.createEventObject && root.doScroll) {
                    try {
                        top = !win.frameElement;
                    } catch (e) {}
                    if (top) poll();
                }
                doc[add](pre + 'DOMContentLoaded', init, false);
                doc[add](pre + 'readystatechange', init, false);
                win[add](pre + 'load', init, false);
            }

        },
        /* Cross-browser event listening  */
        addListener: function(element, eventName, listener) {
            if(!element){
                return;
            }
            //console.log(eventName);
            //console.log(listener);
            if (element.addEventListener) {
                element.addEventListener(eventName, listener, false);
            } else if (element.attachEvent) {
                element.attachEvent("on" + eventName, listener);
            } else {
                element['on' + eventName] = listener;
            }
        },
        removeListener: function(element, eventName, listener) {

            if (element.removeEventListener) {
                element.removeEventListener(eventName, listener, false);
            } else if (element.detachEvent) {
                element.detachEvent("on" + eventName, listener);
            } else {
                element["on" + eventName] = null;
            }
        },
        /*
         * Throttle function borrowed from:
         * Underscore.js 1.5.2
         * http://underscorejs.org
         * (c) 2009-2013 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
         * Underscore may be freely distributed under the MIT license.
         */
        throttle: function (func, wait) {
          var context, args, result;
          var timeout = null;
          var previous = 0;
          var later = function() {
            previous = new Date;
            timeout = null;
            result = func.apply(context, args);
          };
          return function() {
            var now = new Date;
            if (!previous) previous = now;
            var remaining = wait - (now - previous);
            context = this;
            args = arguments;
            if (remaining <= 0) {
              clearTimeout(timeout);
              timeout = null;
              previous = now;
              result = func.apply(context, args);
            } else if (!timeout) {
              timeout = setTimeout(later, remaining);
            }
            return result;
          };
        },
        /*
         * Determine which version of GA is being used
         * "ga", "_gaq", and "dataLayer" are the possible globals
         */
        checkTypeofGA: function() {
          if (typeof ga === "function") {
            universalGA = true;
          }

          if (typeof _gaq !== "undefined" && typeof _gaq.push === "function") {
            classicGA = true;
          }

          if (typeof dataLayer !== "undefined" && typeof dataLayer.push === "function") {
            googleTagManager = true;
          }

        }
    };

    return _inbound;

})(_inbound || {});