app = typeof app !== 'undefined' ? app : {};

app.main = (function () {
    "use strict";

    var self;

    return {
        init: function () {
            self = this;

            var form = document.getElementById('calculatorForm');

            if (!form) {
                return;
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                //self.submitExpression(this);
                self.submitExpressionWJsonp(this);
            });
        },

        /**
         * Send forms content to backend
         * @param {HTMLElement} form
         */
        submitExpression: function (form) {
            var request = new XMLHttpRequest(),
                expression = encodeURIComponent(form.expression.value),
                url = form.action + '?expression=' + expression;

            request.open('GET', url, true);

            request.onload = function() {
                if (this.status >= 200 && this.status < 400) {
                    var response = JSON.parse(this.response);
                    self.renderEvaluationResult(response.result);
                }
            };

            request.onerror = function() {
                alert('Something went wrong. Please, try again later.');
            };

            request.send();
        },

        /**
         * Send forms content to backend using jsonp
         * @param {HTMLElement} form
         */
        submitExpressionWJsonp: function (form) {
            var expression = encodeURIComponent(form.expression.value),
                callbackFunctionName = 'cb_' + Date.now(),
                script = document.createElement('script');

            window[callbackFunctionName] = function (response) {
                self.renderEvaluationResult(response.result);
                delete window[callbackFunctionName];
            };
            script.src = form.action + '?expression=' + expression + '&callback=' + callbackFunctionName;
            document.head.appendChild(script);
            script.parentNode.removeChild(script);
        },

        /**
         * Renders a result of an evaluation
         * @param {string} result
         */
        renderEvaluationResult: function (result) {
            document.getElementById('resultWrapper').innerHTML = result;
            document.getElementById('resultPanel').style.display = '';
        }
    }
})();

app.main.init();