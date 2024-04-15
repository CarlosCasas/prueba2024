#!/bin/bash

# Build the Docker image using the Dockerfile
docker-compose build

# Run the Docker containers defined in the docker-compose.yml file
docker-compose up -d
