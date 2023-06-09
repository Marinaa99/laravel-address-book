<table>
    <thead>
    @php($style = 'background-color: #dbd7d7; border: 1px solid #CCC; text-align: center; font-weight: bold;')
    <tr>
        <th style="{{$style}}">Name</th>
        <th style="{{$style}}">Last Name</th>
        <th style="{{$style}}">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->last_name }}</td>
            <td>{{ $contact->email }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
