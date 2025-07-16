<div class="container mt-4">
    <h3>Student Management</h3>

    <input type="text" wire:model.debounce.300ms="search" class="form-control mb-3"
        placeholder="Search by name, CNIC, or application no">

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Application No</th>
                <th>CNIC</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>
                        @if ($student->photo_path)
                            <img src="{{ asset('storage/' . $student->photo_path) }}" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->application_no }}</td>
                    <td>{{ $student->cnic }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->mobile }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No students found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $students->links() }}
</div>
