using Microsoft.AspNetCore.Mvc;
using OrderService.Application;
using OrderService.Application.Commands;
using OrderService.Application.Dto;
using OrderService.Application.Queries;
using OrderService.Infrastructure;

var builder = WebApplication.CreateBuilder(args);

builder.Services.AddApplication();
builder.Services.AddInfrastructure();

var app = builder.Build();

app.MapPost("/orders", ([FromBody]CreateOrderCommand command, CreateOrderCommand.Handler handler) =>
    handler.Handle(command));

app.MapGet("/orders/{id}", (string id, GetOrderByIdQuery.Handler handler) =>
    handler.Handle(new GetOrderByIdQuery(id)));

app.Run();
