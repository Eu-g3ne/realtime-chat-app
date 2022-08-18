import VueRouter from "vue-router"
import vue from "vue"

vue.use(VueRouter);
const IndexView = () => import('./views/IndexView.vue')
const ThreadView = () => import('./views/ThreadView.vue')
const LoginView = () => import('./views/LoginView.vue')
const router = new VueRouter({
  mode: "history",
  routes: [
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
      beforeEnter:(to,from,next) => {
        if(localStorage.getItem('apiToken')) {
          next()
        } else {
          next('login')
        }
      }
    },
    {
        path: '/login',
        component: LoginView,
        name:'login',
    }
  ]
});

router.beforeEach((to,from,next) => {
  if(to.name !== 'login' || to.name !== 'register') {
    getToken();
    next();
  }
})

function getToken() {
  axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('apiToken');
}

export default router;