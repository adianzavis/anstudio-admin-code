import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import tasks from './tasks';

const app = createApp(tasks);
app.use(ElementPlus);
app.mount('#app-tasks');
