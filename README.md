# E-commerce API

A Laravel-based e-commerce API with JWT authentication, shopping cart, order management, and payment integration.

## Features

- JWT Authentication
- Role-based access (Admin/User)
- Product management
- Shopping cart functionality
- Order processing
- Mock payment integration
- Pagination
- Input validation

## Setup Instructions

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan key:generate`
5. Run `php artisan jwt:secret`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Run `php artisan serve`

## API Endpoints

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Login user
- `POST /api/logout` - Logout user
- `POST /api/refresh` - Refresh JWT token
- `GET /api/profile` - Get user profile

### Products
- `GET /api/products` - Get all products (public)
- `GET /api/products/{id}` - Get a specific product (public)
- `POST /api/products` - Create a new product (admin only)
- `PUT /api/products/{id}` - Update a product (admin only)
- `DELETE /api/products/{id}` - Delete a product (admin only)

### Cart
- `GET /api/cart` - Get user's cart
- `POST /api/cart` - Add item to cart
- `PUT /api/cart/{id}` - Update cart item quantity
- `DELETE /api/cart/{id}` - Remove item from cart
- `DELETE /api/cart` - Clear cart

### Orders
- `GET /api/orders` - Get user's orders (admin gets all orders)
- `POST /api/orders` - Create a new order
- `GET /api/orders/{id}` - Get a specific order
- `PUT /api/orders/{id}/status` - Update order status (admin only)

### Payments
- `POST /api/payments` - Process payment for an order
- `POST /api/payments/{id}/refund` - Process refund (admin only)

## Test Credentials

Admin:
- Email: admin@example.com
- Password: password

User:
- Email: user@example.com
- Password: password
