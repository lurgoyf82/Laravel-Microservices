using OrderService.Domain.Entities;
using OrderService.Domain.Interfaces;

namespace OrderService.Infrastructure.Repositories;

public class InMemoryOrderRepository : IOrderRepository
{
    private readonly List<Order> _orders = new();

    public Task<Order?> GetByIdAsync(string id)
    {
        return Task.FromResult(_orders.FirstOrDefault(o => o.Id == id));
    }

    public Task AddAsync(Order order)
    {
        _orders.Add(order);
        return Task.CompletedTask;
    }
}
