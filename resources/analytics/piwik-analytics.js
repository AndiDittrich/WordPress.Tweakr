// Tweakr Piwik Analytics Tracking Code with OPT-OUT Button
(function(_document, cookieName, host, piwikParams){
    // get optout button
    var optoutButton = _document.getElementById('tweakr-piwik-optout');
    
    var buttonDisabled = function(){
        optoutButton.innerHTML = optoutButton.getAttribute('data-text-disabled');
        optoutButton.className = 'tweakr-piwik-out';
    };

    // opt-out cookie not set ?
    if (_document.cookie.indexOf(cookieName) == -1){
        // opt-out button visible on current page ?
        if (optoutButton){
            // listen to onclick event
            optoutButton.addEventListener('click', function(evt){
                evt.preventDefault();

                // create expire date NOW() + 10 Years
                var expire = new Date();
                expire.setTime(expire.getTime() + 1000 * 60 * 60 * 24 * 365 * 10);

                // set cookie
                _document.cookie = cookieName + '1;path=/;expires=' + expire.toGMTString() + ';';

                // trigger disabled action
                buttonDisabled();
            }); 
        }

        // PIWIK Tracking Code
        // @see https://developer.piwik.org/guides/tracking-javascript-guide
        this._paq = piwikParams;
        this._paq.push(['setTrackerUrl', host + 'piwik.php']);
        (function(scriptTag){
            // create script tag
            var trackerScript = _document.createElement(scriptTag);
            trackerScript.type = 'text/javascript'; 
            trackerScript.async = true;
            trackerScript.defer = true;
            trackerScript.src= host + 'piwik.js'; 
            
            // insert script element to the top and load piwik.js
            var scriptElementAnchor = _document.getElementsByTagName(scriptTag)[0];
            scriptElementAnchor.parentNode.insertBefore(trackerScript, scriptElementAnchor);
        })('script');

    // cookie set
    }else{
        // change button text
        if (optoutButton){
            buttonDisabled();
        }
    }

// initialize - we don't call the function directly to avoid optimization of unused arguments which are added dynamicsally to the code!
}).call(window, document, 'tweakr-piwik-optout=');