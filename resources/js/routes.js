export default [
    /**======================= SETTING  */
    { path: '/users', name: 'users-index', component: require('./components/users/index.vue').default },
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
    { path:'/', name:'homeIndex', component: require('./components/Home.vue').default },
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
    { path: '/menu', name: 'menuIndex', component: require('./components/cms/menu/index.vue').default },
    { path: '/page', name: 'pageIndex', component: require('./components/cms/page/index.vue').default },
    { path: '/page/create', name: 'pageCreate', component: require('./components/cms/page/create.vue').default },
    { path: '/page/:id/edit', name: 'pageEdit', component: require('./components/cms/page/edit.vue').default },
    { path: '/promo', name:'promoIndex', component: require('./components/cms/promo/index.vue').default},
    { path: '/promo/create', name:'promoCreate', component: require('./components/cms/promo/create.vue').default},
    { path: '/promo/:id/edit', name:'promoEdit', component: require('./components/cms/promo/edit.vue').default},
    { path: '/newsletter', name:'newsletterIndex', component: require('./components/cms/newsletter/index.vue').default},
    { path: '/newsletter/create', name:'newsletterCreate', component: require('./components/cms/newsletter/create.vue').default},
    { path: '/newsletter/:id/edit', name:'newsletterEdit', component: require('./components/cms/newsletter/edit.vue').default},

     { path : '/main-slider', name:'mainSliderIndex', component: require('./components/cms/mainslider/index.vue').default},
     { path: '/subscribes', name:'subscribesIndex', component: require('./components/cms/subcribes/index.vue').default},
     { path: '/messages', name:'messagesIndex', component: require('./components/cms/messages/index.vue').default},
    /**======================= END CMS */


    /**======================= FOUNDER DAN TEACHER */
    { path: '/founder', name:'founderIndex', component: require('./components/founder/list.vue').default},
    { path: '/founder/create', name: 'founderCreate', component: require('./components/founder/create.vue').default},
    { path: '/founder/:id/edit', name: 'founder-view', component: require('./components/founder/edit.vue').default},

    /**======================= TEACHER */
    { path: '/pengurus', name:'teacherIndex', component: require('./components/teacher/list.vue').default},
    { path: '/pengurus/create', name:'teacherCreate', component: require('./components/teacher/create.vue').default},
    { path: '/pengurus/:id/edit', name:'teacher-view', component: require('./components/teacher/edit.vue').default},

    /**======================= JABATAN */
    { path: '/jabatan', name:'jabatanIndex', component: require('./components/jabatan/index.vue').default},

    /**======================= POSISI */
    { path: '/posisi', name:'posisiIndex', component: require('./components/posisi/index.vue').default},
    { path: '/posisi/create', name:'posisiCreate', component: require('./components/posisi/create.vue').default},
    { path: '/posisi/:id/view', name:'posisi-view', component: require('./components/posisi/edit.vue').default},    

    /**======================= CALENDAR ACADEMIC */
    { path: '/calendar-academics', name:'calendarIndex', component: require('./components/calendars/index.vue').default},
    { path: '/calendar/create', name:'calendarCreate', component: require('./components/calendars/create.vue').default},
    { path: '/calendar/:id/edit', name:'calendarEdit', component: require('./components/calendars/edit.vue').default},

    /**======================= OUR PROGRAM */
    { path: '/our-program', name:'ourprogramIndex', component: require('./components/program/index.vue').default},
    { path: '/program/create', name:'programCreate', component: require('./components/program/create.vue').default},
    { path: '/program/:id/edit', name: 'programEdit', component: require('./components/program/edit.vue').default },

]