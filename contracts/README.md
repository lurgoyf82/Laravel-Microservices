# Shared Service Contracts

This folder stores all cross-service data contracts used in the microservice architecture.
The contracts are defined using JSON Schema so that services written in any
language can share the same message format.

## Structure

Each top level directory groups the schemas for a domain. Inside a domain folder
there are `request` and `response` subfolders containing the payload definitions
used when communicating with that service.

For example the `user` folder contains:

```
contracts/
└── user/
    ├── request/   # payloads accepted from other services
    └── response/  # payloads emitted by the user service
```

## Usage

Services should validate incoming data against these schemas and generate
outgoing messages that conform to them. Storing the contracts in a dedicated
folder makes it easy to keep them version controlled and shareable across
projects.

The `contracts` directory is **not** a service on its own. It simply lives at the
root so that every microservice can mount or copy the schemas during its build
phase.
