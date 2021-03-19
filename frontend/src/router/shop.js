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
    path: '/register',
    name: 'user.register',
    component: () => import('@/views/Register.vue'),
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
  {
    path: '/sale',
    name: 'shop.sale',
    component: () => import('@/views/shop/sale/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Sales',
      breadcrumb: [
        {
          text: 'Sales list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/sale/create',
    name: 'shop.sale.create',
    component: () => import('@/views/shop/sale/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create sale',
      breadcrumb: [
        {
          text: 'Sale',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
  {
    path: '/sale/edit/:id',
    name: 'shop.sale.edit',
    component: () => import('@/views/shop/sale/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit sale',
      breadcrumb: [
        {
          text: 'Sale',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/transaction',
    name: 'shop.transaction',
    component: () => import('@/views/shop/transaction/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Transaction',
      breadcrumb: [
        {
          text: 'Transaction list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/transaction/create',
    name: 'shop.transaction.create',
    component: () => import('@/views/shop/transaction/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create transaction',
      breadcrumb: [
        {
          text: 'transaction',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
  {
    path: '/transaction/edit/:id',
    name: 'shop.transaction.edit',
    component: () => import('@/views/shop/transaction/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit transaction',
      breadcrumb: [
        {
          text: 'transaction',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product',
    name: 'shop.product',
    component: () => import('@/views/shop/product/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'product',
      breadcrumb: [
        {
          text: 'product list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/create',
    name: 'shop.product.create',
    component: () => import('@/views/shop/product/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create product',
      breadcrumb: [
        {
          text: 'product',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
  {
    path: '/product/edit/:id',
    name: 'shop.product.edit',
    component: () => import('@/views/shop/product/Edit.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Edit product',
      breadcrumb: [
        {
          text: 'product',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/emi',
    name: 'shop.emi',
    component: () => import('@/views/shop/emi/Index.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'EMI',
      breadcrumb: [
        {
          text: 'EMI list',
          active: true,
        },
      ],
    },
  },
  {
    path: '/emi/create',
    name: 'shop.emi.create',
    component: () => import('@/views/shop/emi/Create.vue'),
    meta: {
      authOnly: true,
      pageTitle: 'Create EMI',
      breadcrumb: [
        {
          text: 'Emi',
        },
        {
          text: 'Create',
          active: true,
        },
      ],
    },
  },
]
