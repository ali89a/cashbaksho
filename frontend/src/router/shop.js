export default [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/Home.vue'),
    meta: {
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
