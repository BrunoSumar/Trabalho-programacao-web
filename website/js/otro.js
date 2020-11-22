const about = 'about';
const home = 'home';
const routes = {
    '/': home,
    '/about': about
};
const rootDiv = document.getElementById('opa');


window.onload = () => {
    rootDiv.innerHTML = routes[window.location.pathname]
}

function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            rootDiv.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "/website/a.html", true);
    xhttp.send();
}

const onNavigate = (pathname) => {
    window.history.pushState({}, pathname, window.location.origin + '/website' + pathname);
    // window.history.pushState({}, pathname, window.location.href + pathname);
    loadDoc();
    console.log('home');
}












// Optional



class Router {

    constructor() {
        this.routes = [];
    }

    get(uri, callback) {
        if (!uri || !callback) throw new Error('uri or callback must be given');
        if (typeof uri !== "string") throw new TypeError('typeof uri must be a string');
        if (typeof callback !== "function") throw new TypeError('typeof callback must be a function');
        this.routes.forEach(route => {
            if (route.uri === uri) throw new Error(`the path ${route.uri} already exists`);
        })

        // Step 5 - add route to the array of routes
        const route = {
            uri, // in javascript, this is the same as uri: uri, callback: callback, avoids repition
            callback
        }
        this.routes.push(route);
    }

    init() {
        this.routes.some(route => {

            let regEx = new RegExp(`^${route.uri}$`); // i'll explain this conversion to regular expression below
            let path = window.location.pathname;

            if (path.match(regEx)) {
                // our route logic is true, return the corresponding callback

                let req = {
                    path
                } // i'll also explain this code below
                return route.callback.call(this, req);
            }
        })
    }
}

const router = new Router();
router.get('/about-me', function(req) {
    console.log(req.path); // outputs /about-me to the console
});
router.init();
window.onload = () => {
    router.innerHTML = routes[window.location.pathname]
}
console.log(router);
