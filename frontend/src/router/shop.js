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
  {
    path: '/customer/edit/:id',
    name: 'shop.customer.edit',
    component: () => import('@/views/shop/customer/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit customer',
      breadcrumb: [
        {
          text: 'Customer',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/supplier',
    name: 'shop.supplier',
    component: () => import('@/views/shop/supplier/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Suppliers',
      breadcrumb: [
        {
          text: 'Supplier list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/supplier/create',
    name: 'shop.supplier.create',
    component: () => import('@/views/shop/supplier/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create supplier',
      breadcrumb: [
        {
          text: 'Supplier',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
  {
    path: '/supplier/edit/:id',
    name: 'shop.supplier.edit',
    component: () => import('@/views/shop/supplier/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit supplier',
      breadcrumb: [
        {
          text: 'Supplier',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/purchase',
    name: 'shop.purchase',
    component: () => import('@/views/shop/purchase/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Purchases',
      breadcrumb: [
        {
          text: 'purchase list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/purchase/create',
    name: 'shop.purchase.create',
    component: () => import('@/views/shop/purchase/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create purchase',
      breadcrumb: [
        {
          text: 'purchase',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
  {
    path: '/purchase/edit/:id',
    name: 'shop.purchase.edit',
    component: () => import('@/views/shop/purchase/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit purchase',
      breadcrumb: [
        {
          text: 'purchase',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
]
