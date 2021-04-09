import Vue from 'vue'
import VueRouter from 'vue-router'
import authentication from "@/router/middleware/authentication";

const Home = () => import('../Views/Home')
const LandingPage = () => import('../Views/Home/LandingPage')
const About = () => import('../Views/Home/About')
const Contact = () => import('../Views/Home/Contact')
const Login = () => import('../Views/Login')
const ResetPassword = () => import('../Views/ResetPassword')
const ForgetPassword = () => import('../Views/ForgetPassword')
const Register = () => import('../Views/Register')
const Dashboard = () => import('../Views/Dashboard')
const ProfilePage = () => import('../Views/ProfilePage')
const OrderHistory = () => import('../Views/OrderHistory')
const Ticket = () => import('../Views/Ticket')
const Track = () => import('../Views/Track')
const Cancelled = () => import('../Views/CancelledOrder')
const Verification = () => import('../Views/Verification')

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    component: Home,
    children: [
      {
        path: '/',
        component: LandingPage,
        name: 'landing'
      },
      {
        path: '/about',
        component: About,
        name: 'about'
      },
      {
        path: '/contact',
        component: Contact,
        name: 'contact'
      }
    ]
  },
  {
    path: '/login',
    component: Login,
    name: 'login'
  },
  {
    path: '/reset',
    component: ResetPassword,
    name: 'reset'
  },
  {
    path: '/register',
    component: Register,
    name: 'register'
  },
  {
    path: '/dashboard',
    component: Dashboard,
    name: 'dashboard',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/reset/:token',
    component: ForgetPassword,
    name: 'token-reset'
  },
  {
    path: '/profile',
    component: ProfilePage,
    name: 'profile',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/history',
    component: OrderHistory,
    name: 'history',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/ticket',
    component: Ticket,
    name: 'ticket',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/track',
    component: Track,
    name: 'track',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/cancelled',
    component: Cancelled,
    name: 'cancelled',
    meta: {
      requireAuth: true
    }
  },
  {
    path: '/verification',
    component: Verification,
    name: 'verification',
    meta: {
      requireAuth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  // base: process.env.BASE_URL,
  routes
})
router.beforeEach(authentication);
export default router
