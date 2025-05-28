# .NET 9 Order Service

This service demonstrates a basic C# 12 / .NET 9 microservice implementing a simple CQRS pattern. It mirrors the endpoints of the Laravel order service so the two can be swapped without consumers noticing the difference.

## Endpoints

- `POST /orders` – create a new order
- `GET /orders/{id}` – return a specific order

The request and response payloads follow the JSON schemas defined in `../contracts/order`.

The application keeps orders in memory for demonstration purposes and exposes minimal CQRS command/query handlers.
