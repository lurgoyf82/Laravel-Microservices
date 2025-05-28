using OrderService.Domain.Entities;

namespace OrderService.Domain.Interfaces;

public interface IOrderRepository
{
    Task<Order?> GetByIdAsync(string id);
    Task AddAsync(Order order);
}
