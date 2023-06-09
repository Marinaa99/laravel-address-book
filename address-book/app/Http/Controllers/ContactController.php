<?php

namespace App\Http\Controllers;

use App\Exports\ContactExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;



class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = auth()->user();
        $contacts = $user->contacts()->get();


        return view('contacts.index', compact('contacts'));
    }

    public function export()
        {
            $contacts = Auth::user();

            return Excel::download(new ContactExport($contacts->contacts), 'contacts-export.xlsx');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|min:2|max:250',
            'last_name' => 'required|min:2|max:250',
            'email' => 'required|email',
        ]);



        $contact = Contact::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'user_id' => auth()->user()->id,
        ]);
        $this->storeImage($request->file('image'), $contact);
        return redirect()->route('contacts.index');
    }

    private function storeImage($file, $contact){
        if ($file) {
            $name = $file->getClientOriginalName();
            $path = "storage/" . $file->store('images');
        } else {
            $name = '';
            $path = '';
        }
        $image = $contact->image()->create([
            'name' => $name,
            'path' => $path
        ]);

        $contact->image_id = $image->id;
        $contact->save();
    }
    public function edit(Contact $contact)
    {
        dd($contact);
        return view('contacts.update', ['contact'=>$contact]);
    }

    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:250',
            'last_name' => 'required|min:2|max:250',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $contact->update([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
        ]);

        if ($request->hasFile('image')) {
            if ($contact->image) {
                Storage::delete($contact->image->path);
                $contact->image()->delete();
            }

            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $path = "storage/" . $image->store('images');

            $contact->image()->create([
                'name' => $name,
                'path' => $path,
            ]);
        }

        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }

        if ($contact->image) {
            Storage::delete($contact->image->path);

            $contact->image->delete();
        }

        $contact->delete();

        return redirect()->route('contacts.index');
    }



}
