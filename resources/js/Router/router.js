import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Parallex from '../components/Parallex'
import Login from '../components/login/Login'
import Signup from '../components/login/Signup'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/Read'
import CreateQuestion from '../components/forum/CreateQuestion'
import Logout from '../components/login/Logout'
import CreateCategory from '../components/category/CreateCategory'



const routes = [
    { path: '/', component: Parallex },
    { path: '/login', component: Login },
    { path: '/logout', component: Logout},
    { path: '/signup', component: Signup },
    { path: '/category', component:  CreateCategory},
    { path: '/forum', component: Forum, name:'forum'},    
    { path: '/ask', component: CreateQuestion},
    { path: '/question/:slug', component: Read, name:'read'},

  ]
  
const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history',
})

export default router;