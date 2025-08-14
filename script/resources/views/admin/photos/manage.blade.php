@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Manage Photos') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <form method="GET" action="{{ route('admin.photos.manage') }}" class="form-inline">
                            <label for="typeFilter" class="my-1 mr-2">Filter by Type:</label>
                            <select name="type" id="typeFilter" class="custom-select my-1 mr-sm-2">
                                <option value="">All</option>
                                <option value="single" {{ request('type') == 'single' ? 'selected' : '' }}>Single Photos</option>
                                <option value="carousel" {{ request('type') == 'carousel' ? 'selected' : '' }}>Carousel Photos</option>
                            </select>

                            <label for="statusFilter" class="my-1 mr-2">Filter by Status:</label>
                            <select name="status" id="statusFilter" class="custom-select my-1 mr-sm-2">
                                <option value="">All</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>

                            <button type="submit" class="btn btn-primary my-1">Apply Filters</button>
                        </form>
                    </div>

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Preview</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($photos as $photo)
                                <tr>
                                    <td>{{ $photo->id }}</td>
                                    <td>{{ $photo->title }}</td>
                                    <td>{{ ucfirst($photo->photo_type) }}</td>
                                    <td>
                                        @if($photo->photo_type == 'single' && $photo->file_path)
                                            <img src="{{ asset($photo->file_path) }}" alt="Single Photo" width="100">
                                        @elseif($photo->photo_type == 'carousel' && $photo->photoItems->isNotEmpty())
                                            <div id="carousel-{{ $photo->id }}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($photo->photoItems as $index => $item)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <img src="{{ asset($item->file_path) }}" class="d-block w-100" alt="Carousel Photo" width="100">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carousel-{{ $photo->id }}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-{{ $photo->id }}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $photo->is_approved ? 'success' : 'warning' }}">
                                            {{ $photo->is_approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td>{{ $photo->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.photos.edit', $photo->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('admin.photos.toggleApproval', $photo->id) }}" class="btn btn-sm btn-{{ $photo->is_approved ? 'warning' : 'success' }}">
                                            {{ $photo->is_approved ? 'Unapprove' : 'Approve' }}
                                        </a>
                                        <a href="{{ route('admin.photos.destroy', $photo->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No photos found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $photos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
