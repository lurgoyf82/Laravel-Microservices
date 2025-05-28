using System.Text.Json.Serialization;
using OrderService.Application.Dto;
using OrderService.Domain.Entities;
using OrderService.Domain.Interfaces;

namespace OrderService.Application.Commands;

public record CreateOrderCommand(
    [property: JsonPropertyName("user_id")] string UserId,
    [property: JsonPropertyName("items")] List<OrderItemDto> Items,
    [property: JsonPropertyName("total")] decimal Total)
{
    public class Handler
    {
        private readonly IOrderRepository _repository;

        public Handler(IOrderRepository repository)
        {
            _repository = repository;
        }

        public async Task<OrderDto> Handle(CreateOrderCommand command)
        {
            var order = new Order
            {
                UserId = command.UserId,
                Items = command.Items.Select(i => new OrderItem(i.ProductId, i.Quantity)).ToList(),
                Total = command.Total,
                Status = "pending"
            };
            await _repository.AddAsync(order);
            return order.ToDto();
        }
    }
}
