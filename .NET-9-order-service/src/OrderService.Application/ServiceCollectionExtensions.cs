using Microsoft.Extensions.DependencyInjection;
using OrderService.Application.Commands;
using OrderService.Application.Queries;

namespace OrderService.Application;

public static class ServiceCollectionExtensions
{
    public static IServiceCollection AddApplication(this IServiceCollection services)
    {
        services.AddSingleton<CreateOrderCommand.Handler>();
        services.AddSingleton<GetOrderByIdQuery.Handler>();
        return services;
    }
}
