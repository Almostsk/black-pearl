import Page404 from './components/404.vue';
import IEpage from './components/IEpage.vue';
import Home from './components/Home.vue';
import Cabinet from './components/Cabinet.vue';
import Gallery from './components/Gallery.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Feedback from './components/Feedback.vue';
import RulesPopup from './components/RulesPopup.vue';
import Rules from './components/Rules.vue';
import Winners from './components/Winners.vue';

export const routes = [
    { 
        path: '*', 
        component: Page404, 
        name: '404',
    },
    { 
        path: '/browser-support', 
        component: IEpage, 
        name: 'browser',
    },
    { 
        path: '/', 
        component: Home, 
        name: 'Home',
        meta:{
            web:true
        } 
    },
    { 
        path: '/cabinet', 
        component: Cabinet, 
        name: 'Cabinet',
        meta:{
            web:true
        } 
    },
    { 
        path: '/gallery', 
        component: Gallery, 
        name: 'Gallery',
        props: true,
        meta:{
            web:true
        } 
    },
    { 
        path: '/winners', 
        component: Winners, 
        name: 'Winners',
        meta:{
            web:true
        } 
    },
    { 
        path: '/registration', 
        component: Register, 
        name: 'Register',
        meta:{
            web:true
        } 
    },
    { 
        path: '/login', 
        component: Login, 
        name: 'Login',
        meta:{
            web:true
        } 
    },
    { 
        path: '/feedback', 
        component: Feedback, 
        name: 'Feedback',
        meta:{
            web:true
        } 
    },
    { 
        path: '/rules-popup', 
        component: RulesPopup, 
        name: 'RulesPopup',
        meta:{
            web:true
        } 
    },
    { 
        path: '/rules', 
        component: Rules, 
        name: 'Rules',
        meta:{
            web:true
        } 
    },
];