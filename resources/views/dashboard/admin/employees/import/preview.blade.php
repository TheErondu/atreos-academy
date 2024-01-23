<!-- resources/views/import/preview.blade.php -->

@if (!empty($importedUsers))
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($importedUsers as $userData)
                <tr>
                    <td>{{ $userData['name'] }}</td>
                    <td>{{ $userData['email'] }}</td>
                    <td>{{ $userData['password'] }}</td>
                    <td>{{ $userData['role'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('save.users') }}" method="post">
        @csrf
        <button type="submit">Save Users</button>
    </form>
@else
    <p>No users to preview. Please import users first.</p>
@endif
