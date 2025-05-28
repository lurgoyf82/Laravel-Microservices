using OrderService.Domain.Entities;

namespace OrderService.Application.Dto;

public static class OrderMappingExtensions
{
    public static OrderDto ToDto(this Order order) => new()
    {
        Id = order.Id,
        UserId = order.UserId,
        Items = order.Items.Select(i => new OrderItemDto(i.ProductId, i.Quantity)).ToList(),
        Total = order.Total,
        Status = order.Status
    };
}
