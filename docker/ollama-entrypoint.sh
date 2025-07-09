#!/bin/bash

# Start Ollama server in background
ollama serve &

# Wait for server to be ready
sleep 10

# Pull llama3.2 model
ollama pull llama3.2

# Keep container running
wait