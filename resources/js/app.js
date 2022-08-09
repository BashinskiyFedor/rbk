/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createWebHistory } from 'vue-router'

import App from './components/App.vue'
import createRouter from './router';

const router = createRouter(createWebHistory());
createApp(App).use(router).mount('#app');
// createApp(ExampleComponent).mount('#app');
