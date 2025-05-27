@extends('layouts.app')
@section('content')
<div class="container">
    <h2>{{ isset($company) ? 'Edit' : 'Add' }} Company</h2>
    <form method="POST" enctype="multipart/form-data"
        action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}">
        @csrf
        @if(isset($company)) @method('PUT') @endif

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Company Type</label>
            <select name="company_type" class="form-control">
                <option value="">Select Type</option>
                @foreach(['A Type', 'B Type', 'C Type'] as $type)
                <option value="{{ $type }}" {{ (old('company_type', $company->company_type ?? '') == $type) ? 'selected'
                    : '' }}>{{ $type }}</option>
                @endforeach
            </select>
            @error('company_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Gender</label><br>
            @foreach(['Male', 'Female', 'Other'] as $gender)
            <label><input type="radio" name="gender" value="{{ $gender }}" {{ old('gender', $company->gender ?? '') ==
                $gender ? 'checked' : '' }}> {{ $gender }}</label>
            @endforeach
            @error('gender') <br><small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Interests</label><br>
            @foreach(['Tech', 'Marketing', 'HR'] as $interest)
            <label><input type="checkbox" name="interests[]" value="{{ $interest }}" {{ in_array($interest,
                    old('interests', $company->interests ?? [])) ? 'checked' : '' }}> {{ $interest }}</label>
            @endforeach
            @error('interests') <br><small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Dependent dropdown placeholder --}}
        <div class="form-group">
            <label>Department (changes by gender - JS logic)</label>
            <select name="department" class="form-control" id="department-dropdown">
                <option value="">Choose Gender First</option>
            </select>
        </div>

        <div class="form-group">
            <label>Company Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror

            @if(!empty($company->image))
            <div class="mt-2">
                <img src="{{ asset('storage/' . $company->image) }}" width="100">
            </div>
            @endif
        </div>


        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script>
    // Simple JS demo logic for dependent dropdown
    document.querySelectorAll('input[name="gender"]').forEach(el => {
        el.addEventListener('change', function () {
            const dept = document.getElementById('department-dropdown');
            dept.innerHTML = '';

            let options = {
                'Male': ['Engineering', 'IT'],
                'Female': ['HR', 'Marketing'],
                'Other': ['Design', 'Admin']
            }[this.value] || [];

            options.forEach(opt => {
                dept.innerHTML += `<option value="${opt}">${opt}</option>`;
            });
        });
    });
</script>
@endsection
