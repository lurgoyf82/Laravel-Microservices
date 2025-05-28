using OrderService.Application.Dto;
using OrderService.Domain.Entities;
using OrderService.Domain.Interfaces;

namespace OrderService.Application.Queries;

public record GetOrderByIdQuery(string Id)
{
    public class Handler
    {
        private readonly IOrderRepository _repository;

        public Handler(IOrderRepository repository)
        {
            _repository = repository;
        }

        public async Task<OrderDto?> Handle(GetOrderByIdQuery query)
        {
            var order = await _repository.GetByIdAsync(query.Id);
            return order?.ToDto();
        }
    }
}
