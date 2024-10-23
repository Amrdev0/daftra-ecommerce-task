# E-Commerce API

## Overview

This is a simple e-commerce API built with Laravel. It supports product listings and order placements.

## API Endpoints

### Products

- **List Products**
  - **Endpoint**: `GET /api/products`
  - **Description**: Retrieve a paginated list of products.
  - **Response**: JSON object containing products data.

- **Create Product**
  - **Endpoint**: `POST /api/products`
  - **Request Body**:
    ```json
    {
      "name": "Product Name",
      "price": 100.00,
      "stock": 10
    }
    ```
  - **Response**: JSON object of the created product.

### Orders

- **Place Order**
  - **Endpoint**: `POST /api/orders`
  - **Request Body**:
    ```json
    {
      "products": [
        {
          "product_id": 1,
          "quantity": 2
        },
        {
          "product_id": 2,
          "quantity": 1
        }
      ]
    }
    ```
  - **Response**: JSON object with order confirmation.

## Testing

To run tests, use the following command:

```bash
php artisan test
