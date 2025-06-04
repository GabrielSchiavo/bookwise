<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;
use ArdaGnsrn\Ollama\Ollama;
use App\Models\Book;
use Illuminate\Http\Request;

class GenerativeAiController extends Controller
{
    public function showSynopsis(Request $request)
    {
        $book = Book::find($request->id);

        // Se for uma requisição AJAX (quando clicar no botão), retorna apenas a sinopse
        if ($request->ajax()) {
            return response()->json([
                'synopsis' => $this->generateSynopsis($book)
            ]);
        }

        // Se for acesso normal, mostra a página com a primeira sinopse
        // $synopsisResponse = $this->generateSynopsis($book);

        return view('generative-ai', [
            'book' => $book,
            'initialSynopsis' => null,
        ]);
    }

    protected function generateSynopsis(Book $book)
    {
        $title = $book->title;
        $author = $book->author;
        $volume = $book->volume;

        $prompt = "Forneça-me uma breve sinopse do livro '$title', volume $volume escrito por $author.";

        $client = Ollama::client(config('ollama.ollama_api_base_url'));

        $response = $client->chat()->create([
            'model' => config('ollama.ollama_default_model'),
            // 'options' => [
            //     'num_predict' => 200,
            // ],
            'messages' => [
                ['role' => 'system', 'content' => 'You are a book expert assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return $response->message->content;
    }
}
