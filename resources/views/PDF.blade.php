<table class="table">
    <thead>
        <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td> {{ $user['username'] }} </td>
    </tr>
    @endforeach
    </tbody>
</table>