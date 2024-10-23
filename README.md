# E-Commerce API

## Overview

This is a simple e-commerce API built with Laravel. It supports product listings, order placements, and includes functionality for searching products. The API is designed to provide a seamless experience for developers integrating e-commerce functionalities into their applications.

## Table of Contents

- [API Endpoints](#api-endpoints)
  - [Products](#products)
  - [Orders](#orders)
- [Searching for Products](#searching-for-products)
- [Testing](#testing)

## API Endpoints

### Products

#### List Products
- **Endpoint**: `GET /api/products`
- **Description**: Retrieve a paginated list of products.
- **Response**: JSON object containing products data.
- **Example Response**:
    ```json
    {
      "data": [
        {
          "id": 1,
          "name": "Product Name",
          "price": 100.00,
          "stock": 10
        },
        ...
      ],
      "current_page": 1,
      "last_page": 5,
      "per_page": 10,
      "total": 50
    }
    ```

#### Create Product
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
- **Example Response**:
    ```json
    {
      "id": 1,
      "name": "Product Name",
      "price": 100.00,
      "stock": 10
    }
    ```

### Orders

#### Place Order
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
- **Example Response**:
    ```json
    {
      "order_id": 123,
      "status": "confirmed",
      "total": 250.00
    }
    ```

## Searching for Products

### Search Products
- **Endpoint**: `GET /api/products/search`
- **Description**: Search for products by name or other criteria.
- **Query Parameters**:
  - `q` (string): The search term to filter products.
  - `page` (int): The page number for pagination (optional).
  - `per_page` (int): Number of products per page (optional).
- **Example Request**:
    ```
    GET /api/products/search?q=shoe&page=1&per_page=10
    ```
- **Response**: JSON object containing filtered products data.
- **Example Response**:
    ```json
    {
      "data": [
        {
          "id": 2,
          "name": "Running Shoe",
          "price": 80.00,
          "stock": 50
        },
        {
          "id": 3,
          "name": "Casual Shoe",
          "price": 60.00,
          "stock": 30
        }
      ],
      "current_page": 1,
      "last_page": 1,
      "per_page": 10,
      "total": 2
    }
    ```

## Testing

To run tests, use the following command:

```bash
php artisan test
