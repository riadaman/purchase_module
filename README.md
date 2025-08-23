# Purchase Module

A comprehensive Laravel-based purchase management system for handling suppliers, products, and purchase orders with a clean, responsive interface.

## Features

### 🏢 Supplier Management
- Create, edit, and delete suppliers
- Supplier listing with pagination and filters
- Supplier status management (Active/Inactive)
- Form validation with error handling

### 📦 Product Management
- Product CRUD operations
- Product status management
- Paginated product listings
- Search and filter capabilities

### 🛒 Purchase Order Management
- Create purchase orders with multiple items
- Dynamic product addition to orders
- Real-time total calculations
- Purchase order listing with filters (supplier, date range)
- Detailed purchase order view with print functionality
- Professional printable purchase order documents

## Technology Stack

- **Framework**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Architecture**: MVC with Helper Classes

## Installation

1. **Clone the repository**
```bash
git clone git@github.com:riadaman/purchase_module.git
cd purchase_module
```

2. **Install dependencies**
```bash
composer install
npm install && npm run build
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=purchase_module
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Start the server**
```bash
php artisan serve
```

## Database Schema

### Tables
- **users** - User authentication
- **suppliers** - Supplier information
- **products** - Product catalog
- **purchase_orders** - Purchase order headers
- **purchase_order_items** - Purchase order line items

### Key Relationships
- Purchase Order → Supplier (Many-to-One)
- Purchase Order → Purchase Order Items (One-to-Many)
- Purchase Order Item → Product (Many-to-One)

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── SupplierController.php
│   │   ├── ProductController.php
│   │   └── PurchaseOrderController.php
│   └── Requests/
│       ├── SupplierRequest.php
│       ├── ProductRequest.php
│       └── PurchaseOrderRequest.php
├── Helpers/
│   ├── SupplierHelper.php
│   ├── ProductHelper.php
│   └── PurchaseHelper.php
└── Models/
    ├── Supplier.php
    ├── Product.php
    ├── PurchaseOrder.php
    └── PurchaseOrderItem.php

resources/views/
├── suppliers/
├── products/
├── purchases/
├── partials/
└── layouts/
```

## Key Features

### 🎨 Responsive Design
- Mobile-first responsive layout
- Clean card-based UI
- Consistent styling with custom CSS
- Print-optimized layouts

### 🔍 Advanced Filtering
- Supplier-based filtering
- Date range filtering
- Pagination with filter preservation
- Search capabilities

### 📊 Business Logic
- Automatic total calculations
- Database transactions for data integrity
- Comprehensive error handling
- Form validation with custom messages

### 🖨️ Print Functionality
- Professional purchase order documents
- Print-optimized CSS
- Clean, business-ready layouts

## Usage

### Creating a Purchase Order
1. Navigate to Purchase → Purchase Order
2. Select supplier and add products dynamically
3. Set quantities and unit prices
4. System automatically calculates totals
5. Save to create purchase order

### Managing Suppliers/Products
1. Use sidebar navigation to access modules
2. Create, edit, or delete records
3. Use filters to find specific records
4. Pagination handles large datasets

## API Endpoints

### Suppliers
- `GET /suppliers` - List suppliers
- `GET /suppliers/create` - Create form
- `POST /suppliers` - Store supplier
- `GET /suppliers/{id}/edit` - Edit form
- `PUT /suppliers/{id}` - Update supplier

### Products
- `GET /products` - List products
- `GET /products/create` - Create form
- `POST /products` - Store product
- `GET /products/{id}/edit` - Edit form
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

### Purchase Orders
- `GET /purchase-orders` - List orders
- `GET /purchase-orders/create` - Create form
- `POST /purchase-orders` - Store order
- `GET /purchase-orders/{id}` - View details

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support or questions, please create an issue in the GitHub repository.