<?php

return [
    /* |--------------------------------------------------------------------------
    | Ollama API Configuration
    |--------------------------------------------------------------------------
    |
    | This section contains the configuration for the Ollama API integration.
    | You can set your API key and organization ID here. Make sure to keep
    | your API key secure and do not expose it in public repositories.
    |
    | You can set these values in your .env file.
    |   | Example:
    |   | OLLAMA_API_BASE_URL=http://localhost:11434
    |   | OLLAMA_DEFAULT_MODEL=llama3.2
    */               

    'ollama_api_base_url' => env('OLLAMA_API_BASE_URL', null),
    'ollama_default_model' => env('OLLAMA_DEFAULT_MODEL', null),
];