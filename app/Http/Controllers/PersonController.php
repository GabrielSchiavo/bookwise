<?php
namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    public function listData(Request $request)
    {
        if(request()->has('search')) {
            $personsList = Person::where(function($query) {
                $query->where('id', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('name_last_name', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('phone', 'ILIKE', '%' . request()->get('search', '') . '%')
                      ->orWhere('email', 'ILIKE', '%' . request()->get('search', '') . '%');

            })->get()->sortBy('id');

        } else {
            $personsList = Person::all()->sortBy('id');
        }

        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('persons', [
            'personsList' => $personsList,
            'message' => $message
        ]);
    }

    public function formData()
    {
        return view('register-persons');
    }

    public function edit(Request $request)
    {
        $person = Person::find($request->id);

        return view('register-persons', [
            'person' => $person,
        ]);
    }

    public function delete(Request $request)
    {
        $person = Person::find($request->id);
        $person->delete();

        $request->session()->put('message', 'Pessoa <span class="text-bold">ID ' . $person->id . '</span> excluida!');

        return redirect('/pessoas');
    }

    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_last_name' => 'required|min:1|max:100',
            'phone' => [
                'required',
                'min:11',
                'max:15',
                Rule::unique('persons')->ignore($request->id),
            ],
            'email' => [
                'required',
                'max:100',
                'email:rfc,dns',
                Rule::unique('persons')->ignore($request->id),
            ],
        ], [
            'required' => 'O campo <span class="text-bold">:attribute</span> é obrigatório',
            'unique' => 'Já existe uma Pessoa cadastrada com este <span class="text-bold">:attribute</span>',
            'min' => 'O campo <span class="text-bold">:attribute</span> precisa ter no mínimo :min caracteres',
            'max' => 'O campo <span class="text-bold">:attribute</span> precisa ter no máximo :max caracteres',
            'email' => 'O <span class="text-bold">:attribute</span> informado não é válido'
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($request->id != null) {
            $person = Person::find($request->id);
            $person->name_last_name = $request->name_last_name;
            $person->phone = $request->phone;
            $person->email = $request->email;
            $person->save();

            $request->session()->put('message', 'Pessoa <span class="text-bold">ID ' . $person->id . '</span> atualizada!');
        } else {
            $person = Person::create([
                'name_last_name' => $request->name_last_name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            $request->session()->put('message', 'Pessoa <span class="text-bold">ID ' . $person->id . '</span> criada!');
        }

        return redirect('/pessoas');
    }
}
