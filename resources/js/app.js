import './bootstrap';
import '../css/app.css'

import { createApp } from "vue"
import App from './App.vue'
import '../css/index.css'

const adminAppElement = document.querySelector('#app');
if (adminAppElement) {
    createApp(App).mount(adminAppElement)
}
