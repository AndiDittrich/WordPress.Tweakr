// Tweakr Piwik Analytics Tracking Code with OPT-OUT Button
(function(_window, _document, host, piwikParams){
    // get optout button
    var optoutButton = _document.getElementById('tweakr-piwik-optout');
    
    var buttonDisabled = function(){
        optoutButton.innerHTML = optoutButton.getAttribute('data-text-disabled');
        optoutButton.className = 'tweakr-piwik-out';
    };

    // opt-out cookie not set ?
    if (_document.cookie.indexOf('tweakr-piwik-optout=') == -1){
        // opt-out button visible on current page ?
        if (optoutButton){
            // listen to onclick event
            optoutButton.addEventListener('click', function(evt){
                evt.preventDefault();

                // create expire date NOW() + 10 Years
                var expire = new Date();
                expire.setTime(expire.getTime() + 1000 * 60 * 60 * 24 * 365 * 10);

                // set cookie
                _document.cookie = 'tweakr-piwik-optout=1;path=/;expires=' + expire.toGMTString() + ';';

                // trigger disabled action
                buttonDisabled();
            }); 
        }

        // PIWIK Tracking Code
        _window._paq = piwikParams;
        _window._paq.push(['setTrackerUrl', host + 'piwik.php']);
        (function(){
            var g=_document.createElement('script'), s=_document.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=host + 'piwik.js'; s.parentNode.insertBefore(g,s);
        })();

    // cookie set
    }else{
        // change button text
        if (optoutButton){
            buttonDisabled();
        }
    }

// initialize
})(window, document);