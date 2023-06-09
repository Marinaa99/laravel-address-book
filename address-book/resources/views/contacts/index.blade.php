<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 d-flex justify-content-center align-items-center mt-6 mb-6">
            <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#exampleModal">
                Add new contact
            </button>

            @if(count($contacts) > 0)
                <a href="{{ route('export-contacts', ['user' => Auth::user()->id]) }}" class="btn btn-primary">Export to Excel</a>
            @endif

        </div>



    @if(count($contacts) > 0)
    <div  class="mt-2">
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                        <th  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        @if ($contact->image)
                                            <img src="{{ asset($contact->image->path) }}" alt="{{ $contact->name }}" class="w-10 h-10 rounded-full" style="width: 70px; height: 70px;">
                                        @else
                                            <img src="{{ asset('storage/images/avatar.png') }}"class="w-10 h-10 rounded-full" style="width: 70px; height: 70px;">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $contact->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black-50">{{ $contact->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black-50">{{ $contact->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-black-50">
                                <div class="flex">

                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">DELETE</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="contactForm" method="POST" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="text-center mb-3">
                            <label for="formFile" class="form-label"></label>
                            <input class="form-control mt-2" type="file" id="formFile" name="image">
                        </div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</x-app-layout>

