<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        .table-container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .table th, .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .table tr:hover {
            background-color: #f2f2f2;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Consignment Entries</h1>
                    Email {{ $encryptedEmail }} <br>
                    Password {{ $encryptedPassword }} <br>
                    <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" id="send-selected">Send Selected</button>

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
                            @foreach ($consignments as $consignment)
                                <tr>
                                    <td><input type="checkbox" class="row-checkbox"></td>
                                    <td>{{ $consignment->id }}</td>
                                    <td>{{ $consignment->company }}</td>
                                    <td>{{ $consignment->contact }}</td>
                                    <td>{{ $consignment->addressline1 }}</td>
                                    <td>{{ $consignment->addressline2 }}</td>
                                    <td>{{ $consignment->addressline3 }}</td>
                                    <td>{{ $consignment->city }}</td>
                                    <td>{{ $consignment->country }}</td>
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var encryptedUsername = @json($encryptedEmail);
        var encryptedPassword = @json($encryptedPassword);
        $(document).ready(function() {
            var selectedRows = [];
            $('#send-selected').click(function() {
                var selectedRows = [];
                $('.row-checkbox:checked').each(function() {
                    selectedRows.push($(this).closest('tr').find('td').eq(1).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(2).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(3).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(4).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(5).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(6).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(7).text());
                    selectedRows.push($(this).closest('tr').find('td').eq(8).text());

                });

                $.ajax({
                    url: '/api/consignments',
                    method: 'POST',
                    headers: {
                        'X-Encrypted-Username': encryptedUsername,
                        'X-Encrypted-Password': encryptedPassword,
                    },
                    data: JSON.stringify(selectedRows),
                    contentType: 'application/json',
                    success: function(response) {
                        $('.row-checkbox:checked').each(function() {
                            var downloadButton = $('<a>').text('Download PDF')
                                .attr('href', '/api/download-pdf/' + response.encrptedFileName)
                                .attr('target', '_blank') // Open in a new tab
                                .addClass('download-link');
                            $(this).closest('tr').find('td:last').append(downloadButton);
                        });
                    },
                    error: function(error) {
                    }
                });
            });
        });
    </script>
</x-app-layout>
