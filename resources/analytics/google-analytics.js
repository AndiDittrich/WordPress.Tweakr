// Tweakr Analytics Tracking Code with OPT-OUT Button
(function(_window, _document, trackingID, anonymizeIP){
    // get optout button
    var optoutButton = _document.getElementById('tweakr-analytics-optout');

    var buttonDisabled = function(){
        optoutButton.innerHTML = optoutButton.getAttribute('data-text-disabled');
        optoutButton.className = 'tweakr-analytics-out';
    };

    // opt-out cookie not set ?
    if (_document.cookie.indexOf('tweakr-analytics-optout=') == -1){
        // opt-out button visible on current page ?
        if (optoutButton){
            // listen to onclick event
            optoutButton.addEventListener('click', function(evt){
                evt.preventDefault();

                // create expire date NOW() + 10 Years
                var expire = new Date();
                expire.setTime(expire.getTime() + 1000 * 60 * 60 * 24 * 365 * 10);

                // set cookie
                _document.cookie = 'tweakr-analytics-optout=1;path=/;expires=' + expire.toGMTString() + ';';

                // trigger disabled action
                buttonDisabled();
            }); 
        }

        // Google Analytics Code Snippet
        // @source https://developers.google.com/analytics/devguides/collection/analyticsjs/tracking-snippet-reference
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(_window, _document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        // Google Analytics Init
        ga('create', trackingID, 'auto');
        ga('set', 'anonymizeIp', anonymizeIP);
        ga('send', 'pageview');

    // cookie set
    }else{
        // change button text
        if (optoutButton){
            buttonDisabled();
        }
    }

// initialize
})(window, document);