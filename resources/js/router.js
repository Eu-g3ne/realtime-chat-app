import VueRouter from "vue-router"
import vue from "vue"

vue.use(VueRouter);
const IndexView = () => import('./views/IndexView.vue')
const ThreadView = () => import('./views/ThreadView.vue')

const routes = [
  {
    path: '/',
    component: IndexView,
    name:'index',
    children:[{
      path:'thread/:id',
      name: 'thread',
      component: ThreadView,
      props(route) {
        const props = { ...route.params }
        props.id = +props.id
        return props
      },
    }],
  }
]


export default new VueRouter({
  mode: "history",
  routes
});