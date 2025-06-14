$(document).ready(function() {
    tarteaucitron.init({
        "privacyUrl": "", /* Privacy policy url */
        "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */
        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
        "cookieName": "tarteaucitron", /* Cookie name */
        "orientation": "bottom", /* Banner position (top - bottom) */
        "groupServices": false, /* Group services by category */
        "serviceDefaultState": "wait", /* Default state (true - wait - false) */
        "showAlertSmall": false, /* Show the small banner on bottom right */
        "cookieslist": true, /* Show the cookie list */
        "closePopup": false, /* Show a close X on the banner */
        "showIcon": false, /* Show cookie icon to manage cookies */
        "iconPosition": "BottomRight", /* BottomRight, BottomLeft, TopRight and TopLeft */
        "adblocker": false, /* Show a Warning if an adblocker is detected */
        "DenyAllCta" : true, /* Show the deny all button */
        "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
        "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */
        "removeCredit": false, /* Remove credit link */
        "moreInfoLink": false, /* Show more info link */
        "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
        "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */
        "readmoreLink": "", /* Change the default readmore link */
        "mandatory": true, /* Show a message about mandatory cookies */
        "mandatoryCta": true /* Show the disabled accept button when mandatory on */
    });
});