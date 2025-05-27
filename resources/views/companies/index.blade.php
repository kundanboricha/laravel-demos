@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Companies</h2>

    <!-- 🔍 Search + Type Filter -->
    <form method="GET" action="{{ route('companies.index') }}" class="form-inline mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search name or email..."
            value="{{ request('search') }}">

        <select name="company_type" class="form-control mx-2">
            <option value="">All Types</option>
            @foreach(['A Type', 'B Type', 'C Type'] as $type)
            <option value="{{ $type }}" {{ request('company_type')==$type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('companies.index') }}" class="btn btn-default">Reset</a>
    </form>

    <!-- 📋 Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach([
                'name' => 'Name',
                'email' => 'Email',
                'company_type' => 'Type'
                ] as $field => $label)
                <th>
                    <a href="{{ route('companies.index', array_merge(request()->query(), [
                            'sort_by' => $field,
                            'sort_order' => request('sort_order') === 'asc' && request('sort_by') === $field ? 'desc' : 'asc'
                        ])) }}">
                        {{ $label }}
                        @if(request('sort_by') === $field)
                        <small>{{ request('sort_order') === 'asc' ? '▲' : '▼' }}</small>
                        @endif
                    </a>
                </th>
                @endforeach
                <th>Gender</th>
                <th>Interests</th>
                <th>Image</th> <!-- ✅ Image column -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->company_type }}</td>
                <td>{{ $company->gender }}</td>
                <td>{{ implode(', ', $company->interests ?? []) }}</td>
                <td>
                    @if($company->image)
                    <img src="{{ asset('storage/' . $company->image) }}" width="60" height="60"
                        style="object-fit: cover;">
                    @else
                    <small>No image</small>
                    @endif
                </td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                        style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No companies found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 📄 Pagination -->
    <div class="mt-3">
        {{ $companies->links() }}
    </div>
</div>
@endsection
