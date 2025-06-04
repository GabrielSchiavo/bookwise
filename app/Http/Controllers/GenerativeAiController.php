<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;

use App\Models\Book;
use Illuminate\Http\Request;

class GenerativeAiController extends Controller
{
    // public function getSynopsis(Request $request)
    // {
    //     $book = Book::find($request->id);
    //     $title = $book->title;
    //     $author = $book->author;
    //     $volume = $book->volume;


    //     $prompt = "Me forneça uma sinopse breve do livro '$title', volume $volume escrito por $author.";

    //     $client = \OpenAI::factory()
    //         ->withApiKey(config('app.openai_api_key'))
    //         ->withOrganization(config('app.openai_organization'))
    //         ->withHttpClient(new \GuzzleHttp\Client([
    //             'verify' => storage_path('certs/cacert.pem'),
    //         ]))
    //         ->make();

    //     $response = $client->chat()->create([
    //         'model' => 'gpt-3.5-turbo',
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'Você é um assistente especializado em livros.'],
    //             ['role' => 'user', 'content' => $prompt],
    //         ],
    //     ]);

    //     $synopsisResponse = $response->choices[0]->message->content;

    //     return view('generative-ai', [
    //         'book' => $book,
    //         'synopsisResponse' => $synopsisResponse,
    //     ]);
    // }

    public function getSynopsis(Request $request)
    {
        $book = Book::find($request->id);

        return view('generative-ai', [
            'book' => $book,
        ]);
    }
}
