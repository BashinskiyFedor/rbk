import {createRouter} from 'vue-router'
import NewsComponent from './components/NewsComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: ExampleComponent
  },
  {
    path: '/news/:id',
    name: 'news',
    component: NewsComponent,
    props: (route) => ({
        id: Number(route.params.id),
        news: route.params.news ? JSON.parse(route.params.news) : null
    }),
  }
]

export default function (history) {
  return createRouter({
    history,
    routes
  })
}
