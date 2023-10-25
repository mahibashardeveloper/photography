import {createRouter, createWebHistory} from 'vue-router';

import layout from '../layouts/layout.vue';
import home from '../pages/home.vue';
import explore from "../pages/explore.vue";
import login from '../pages/login.vue';
import register from '../pages/register.vue';
import forget from '../pages/forget.vue';
import profile from '../pages/profile.vue';
import settings from "../pages/user/settings.vue";
import portfolio from "../pages/user/portfolio.vue";
import loginHistory from "../pages/user/loginHistory.vue";

const ROOT_URL = '';

const routes = [
    {path: ROOT_URL, name: 'layout', component: layout,
        children: [
            {path: ROOT_URL + '/home', name: 'home', component: home, meta: {title: 'home'}},
            {path: ROOT_URL + '/explore', name: 'explore', component: explore, meta: {title: 'explore'}},
            {path: ROOT_URL + '/login', name: 'login', component: login, meta: {title: 'login'}},
            {path: ROOT_URL + '/register', name: 'register', component: register, meta: {title: 'register'}},
            {path: ROOT_URL + '/forget', name: 'forget', component: forget, meta: {title: 'forget'}},
            {path: ROOT_URL + '/profile', name: 'profile', component: profile,
                children: [
                    {path: ROOT_URL + '/portfolio', name: 'portfolio', component: portfolio, meta: {title: 'portfolio'}},
                    {path: ROOT_URL + '/settings', name: 'settings', component: settings, meta: {title: 'settings'}},
                    {path: ROOT_URL + '/login_history', name: 'loginHistory', component: loginHistory, meta: {title: 'login history'}},
                ]
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(), routes
})

export default router;
