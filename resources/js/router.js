import VueRouter from "vue-router"
import vue from "vue"

vue.use(VueRouter);
const IndexView = () => import('./views/IndexView.vue')

const routes = [
  {
    path: '/',
    component: IndexView
  }
]


export default new VueRouter({
  mode: "history",
  routes
});