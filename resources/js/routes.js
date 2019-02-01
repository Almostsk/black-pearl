import Home from './components/Home.vue';
import Login from './components/Login.vue';

export const routes = [
    { 
        path: '/', 
        component: Home, 
        name: 'Home',
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
];