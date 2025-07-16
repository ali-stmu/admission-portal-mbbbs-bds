<div class="container mt-4">
    <h3>Edit Student</h3>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="form-group">
            <label>Name</label>
            <input type="text" wire:model.defer="student.name" class="form-control">
            @error('student.name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>CNIC</label>
            <input type="text" wire:model.defer="student.cnic" class="form-control">
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" wire:model.defer="student.mobile" class="form-control">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" wire:model.defer="student.email" class="form-control">
        </div>

        <div class="form-group">
            <label>Father Name</label>
            <input type="text" wire:model.defer="student.father_name" class="form-control">
        </div>

        <div class="form-group">
            <label>Photo</label>
            <input type="file" wire:model="photo" class="form-control">
            @if ($student->photo_path)
                <img src="{{ asset('storage/' . $student->photo_path) }}" width="100">
            @endif
        </div>

        <div class="form-group">
            <label>CNIC Copy</label>
            <input type="file" wire:model="cnic_copy" class="form-control">
            @if ($student->cnic_copy_path)
                <a href="{{ asset('storage/' . $student->cnic_copy_path) }}" target="_blank">View CNIC</a>
            @endif
        </div>

        <div class="form-group">
            <label>Passport Copy</label>
            <input type="file" wire:model="passport_copy" class="form-control">
            @if ($student->passport_copy_path)
                <a href="{{ asset('storage/' . $student->passport_copy_path) }}" target="_blank">View Passport</a>
            @endif
        </div>

        <!-- Add rest of the fields similarly -->

        <button class="btn btn-success">Update Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
