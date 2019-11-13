export default [
    /**======================= SETTING  */
    { path: '/users', name: 'users-index', component: require('./components/users/Index.vue').default },
    { path: '/users/create', name: 'users-add', component: require('./components/users/Create.vue').default },
    { path: '/users/:id', name: 'users-view', component: require('./components/users/View.vue').default },
    { path: '/role', name: 'role-index', component: require('./components/role/RoleIndex.vue').default },
    { path: '/role/create', name: 'role-add', component: require('./components/role/RoleCreate.vue').default },
    { path: '/role/:id', name: 'role-view', component: require('./components/role/RoleEdit.vue').default },
    { path: '/role/detail/:id', name: 'role-detail', component: require('./components/role/RoleDetail.vue').default },
    { path: '/permission', name: 'permission-index', component: require('./components/permission/index.vue').default },
    { path: '/permission/create', name: 'permission-add', component: require('./components/permission/create.vue').default },
    { path: '/permission/:id', name: 'permission-view', component: require('./components/permission/edit.vue').default },
    { path: '/profile', name: 'profileIndex', component: require('./components/Profile.vue').default },
    { path: '/password', name: 'password', component: require('./components/Password.vue').default },
    { path:'/', name:'homeIndex', component: require('./components/home.vue').default },
    { path: '/user/:id/hakakses', name:'hasAksesUser', component: require('./components/users/hakakses.vue').default},

    { path: '/instansi', name:'Instansi', component: require('./components/instansi/index.vue').default},
    /**======================= END SETTING */

    /**======================= CMS */
    { path: '/category', name: 'categoryIndex', component: require('./components/cms/category/index.vue').default },
    { path: '/add-category', name: 'categoryCreate', component: require('./components/cms/category/create.vue').default },
    { path: '/all-post', name: 'postIndex', component: require('./components/cms/post/index.vue').default },
    { path: '/post/create', name: 'postCreate', component: require('./components/cms/post/create.vue').default },
    { path: '/post/:id/edit', name: 'postEdit', component: require('./components/cms/post/edit.vue').default },
    { path: '/headline', name: 'headlineIndex', component: require('./components/cms/headline/index.vue').default },
    { path: '/headline/create', name: 'headlineCreate', component: require('./components/cms/headline/create.vue').default },
    { path: '/headline/:id/edit', name: 'headlineEdit',component: require('./components/cms/headline/edit.vue').default },
    { path: '/info', name: 'infoIndex', component: require('./components/cms/info.vue').default },
    { path: '/event', name: 'eventIndex', component: require('./components/cms/event/index.vue').default },
    { path: '/event/create', name: 'eventCreate', component: require('./components/cms/event/create.vue').default },
    { path: '/event/:id/edit', name: 'eventEdit', component: require('./components/cms/event/edit.vue').default },
    { path: '/gallery', name: 'galleryIndex', component: require('./components/cms/gallery/index.vue').default },
    { path: '/testimoni', name: 'testimoniIndex', component: require('./components/cms/testimoni/index.vue').default },
    { path: '/testimoni/create', name: 'testimoniCreate', component: require('./components/cms/testimoni/create.vue').default },
    { path: '/testimoni/:id/edit', name: 'testimoniEdit', component: require('./components/cms/testimoni/edit.vue').default },
    /**======================= END CMS */
]