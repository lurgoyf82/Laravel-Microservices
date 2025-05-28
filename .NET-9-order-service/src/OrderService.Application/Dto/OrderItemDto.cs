using System.Text.Json.Serialization;

namespace OrderService.Application.Dto;

public record OrderItemDto(
    [property: JsonPropertyName("product_id")] string ProductId,
    [property: JsonPropertyName("quantity")] int Quantity);
