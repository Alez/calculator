(function () {
    var form = document.getElementById('calculatorForm');

    if (!form) {
        return;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var request = new XMLHttpRequest(),
            expression = encodeURIComponent(form.expression.value),
            url = form.action + '?expression=' + expression;

        request.open('GET', url, true);

        request.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                var response = JSON.parse(this.response);
                
                document.getElementById('resultWrapper').innerHTML = response.result;
                document.getElementById('resultPanel').style.display = '';
            }
        };

        request.onerror = function() {
            // There was a connection error of some sort
        };

        request.send();
    });
})();

