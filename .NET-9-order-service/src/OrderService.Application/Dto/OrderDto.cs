using System.Text.Json.Serialization;

namespace OrderService.Application.Dto;

public class OrderDto
{
    [JsonPropertyName("id")]
    public string Id { get; set; } = string.Empty;

    [JsonPropertyName("user_id")]
    public string UserId { get; set; } = string.Empty;

    [JsonPropertyName("items")]
    public List<OrderItemDto> Items { get; set; } = new();

    [JsonPropertyName("total")]
    public decimal Total { get; set; }

    [JsonPropertyName("status")]
    public string Status { get; set; } = string.Empty;
}
