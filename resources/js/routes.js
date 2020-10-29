let login = require('./components/auth/login.vue').default;
let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;

let create_user = require('./components/users/create.vue').default;
let all_users = require('./components/users/index.vue').default;

// Category Component
let storecategory = require('./components/categories/create.vue').default;
let category = require('./components/categories/index.vue').default;
let editcategory = require('./components/categories/edit.vue').default;

// Product Component
let storeproduct = require('./components/products/create.vue').default;
let product = require('./components/products/index.vue').default;
let editproduct = require('./components/products/edit.vue').default;

// POS Component
let pos = require('./components/pos/pos.vue').default;

// Order Component
let today_orders = require('./components/orders/orders.vue').default;
let view_order = require('./components/orders/view_order.vue').default;
let search_order = require('./components/orders/search.vue').default;

export const routes = [
    { path: '/', component: login, name:'/'},
    { path: '/logout', component: logout, name:'logout'},
    { path: '/home', component: home, name:'home'},

    { path: '/create_user', component: create_user, name:'create_user'},
    { path: '/all_users', component: all_users, name:'all_users'},

    // Category Routes
    { path: '/store-category', component: storecategory, name:'store-category'},
    { path: '/category', component: category, name:'category'},
    { path: '/edit-category/:id', component: editcategory, name:'edit-category'},

    // Product Routes
    { path: '/store-product', component: storeproduct, name:'store-product'},
    { path: '/product', component: product, name:'product'},
    { path: '/edit-product/:id', component: editproduct, name:'edit-product'},

    // POS Routes
    { path: '/pos', component: pos, name:'pos'},

    // Order Routes
    { path: '/today_orders', component: today_orders, name:'today_orders'},
    { path: '/view_order/:id', component: view_order, name:'view_order'},
    { path: '/search_order', component: search_order, name:'search_order'},

]

