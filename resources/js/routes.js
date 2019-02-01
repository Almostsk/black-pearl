import Example from './components/ExampleComponent.vue';

export const routes = [
    { 
        path: '/', 
        component: Example, 
        name: 'Example',
        meta:{
            web:true
        } 
    },
];