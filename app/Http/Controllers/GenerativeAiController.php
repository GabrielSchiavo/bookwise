<?php

namespace App\Http\Controllers;

use ArdaGnsrn\Ollama\Ollama;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('generative-ai', [
            'message' => $message,
            'book' => $book,
            'initialSynopsis' => null,
        ]);
    }

    protected function generateSynopsis(Book $book)
    {
        set_time_limit(60); // Define timeout para 60 segundos

        $title = $book->title;
        $author = $book->author;
        $volume = $book->volume;

        $prompt = "Provide a brief synopsis of the book '{$title}', volume {$volume} written by {$author}.";

        try {
            $client = Ollama::client(config('ollama.api_base_url'));

            $response = $client->chat()->create([
                'model' => config('ollama.default_model'),
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an expert book assistant. Please answer in Portuguese.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'options' => [
                    // 'temperature' => 0.7,
                    'timeout' => config('ollama.timeout')
                ]
            ]);

            return $response->message->content;
        } catch (\Exception $e) {
            // Handle timeout specifically
            if (str_contains($e->getMessage(), 'timed out')) {
                return Redirect::back()->withInput()->withErrors('A geração da sinopse demorou muito. Tente novamente mais tarde.');
            }
            return Redirect::back()->withInput()->withErrors("Erro ao gerar sinopse: " . $e->getMessage());
        }
    }
}
