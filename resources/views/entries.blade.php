<div class="table-container">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>Address Line 3</th>
            <th>City</th>
            <th>Country</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        @foreach ($entries as $consignment)
            <td>{{ $consignment }}</td>
        @endforeach
        </tr>
        </tbody>
    </table>
</div>
