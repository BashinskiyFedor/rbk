import {createRouter} from 'vue-router'
import NewsComponent from './components/NewsComponent.vue';
import ExampleComponent from './components/ExampleComponent.vue';

const routes = [
  {
    path: '/back',
    name: 'home',
    component: ExampleComponent
  },
  {
    path: '/back/news/:id',
    name: 'news',
    component: NewsComponent,
    props: (route) => ({ id: Number(route.params.id), news: JSON.parse(route.params.news) }),
  }
]

export default function (history) {
  return createRouter({
    history,
    routes
  })
}
