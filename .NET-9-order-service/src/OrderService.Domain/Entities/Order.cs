using OrderService.Domain.Entities;

namespace OrderService.Domain.Entities;

public class Order
{
    public string Id { get; set; } = Guid.NewGuid().ToString();
    public string UserId { get; set; } = string.Empty;
    public List<OrderItem> Items { get; set; } = new();
    public decimal Total { get; set; }
    public string Status { get; set; } = "pending";
}
