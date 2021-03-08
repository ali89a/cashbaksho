export default [
  {
    path: '/login',
    name: 'user.login',
    component: () => import('@/views/Login.vue'),
    meta: {
      layout: 'full',
      guestOnly: true,
    },
  },
  {
    path: '/',
    name: 'user.homepage',
    component: () => import('@/views/Home.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Home',
      breadcrumb: [
        {
          text: 'Home',
          active: true,
        },
      ],
    },
  },
  {
    path: '/customer',
    name: 'shop.customer',
    component: () => import('@/views/shop/customer/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Customers',
      breadcrumb: [
        {
          text: 'Customer list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/customer/create',
    name: 'shop.customer.create',
    component: () => import('@/views/shop/customer/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create customer',
      breadcrumb: [
        {
          text: 'Customer',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
]
