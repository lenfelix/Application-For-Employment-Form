import { createRouter, createWebHistory } from 'vue-router'
import FormView from '../views/Form.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'form',
      component: FormView
    },
  ]
})

export default router
