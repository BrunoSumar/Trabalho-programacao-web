class Router {
    constructor(routes) {
        this.routes = routes;
    }

    addRoute(name, path, file) {
        if (!name || !path || !file) throw new Error('Name or path are empty');
        if (typeof name !== "string" || typeof path !== "string" || typeof file !== "string") throw new TypeError('Typeof name and path must be a string');
        this.routes.forEach(route => {
            if (route.path === path) throw new Error(`The path ${route.name} already exists`);
        })
        const route = {
            name: name,
            path: path,
            file: file
        }
        this.routes.push(route);
    }

    init() {
        return this.routes.find(route => {
            let path = window.location.pathname;
            if ('/UFF/Trabalho-programacao-web1/website' + route.path === path) {
                return true;
            }
            return false;
        })
    }

}