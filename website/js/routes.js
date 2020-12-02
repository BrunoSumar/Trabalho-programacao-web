var routes = [{
        name: 'root',
        path: '/',
        file: 'index.html'
    },
    {
        name: 'myBookmarks',
        path: '/mybookmarks',
        file: 'mybookmarks.html'
    }
];

router = new Router(routes);
router.addRoute('name', '/mybookmark', 'teste');
// console.log(router.init());
// console.log(router);