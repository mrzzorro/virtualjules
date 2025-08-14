@extends('layouts.backend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Manage Videos') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <form method="GET" action="{{ route('admin.videos.manage') }}" class="form-inline">
                            <label for="typeFilter" class="my-1 mr-2">Filter by Type:</label>
                            <select name="type" id="typeFilter" class="custom-select my-1 mr-sm-2">
                                <option value="">All</option>
                                <option value="url" {{ request('type') == 'url' ? 'selected' : '' }}>URL Videos</option>
                                <option value="upload" {{ request('type') == 'upload' ? 'selected' : '' }}>Uploaded Videos</option>
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
                                <th>Thumbnail</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($videos as $video)
                                <tr>
                                    <td>{{ $video->id }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ ucfirst($video->video_type) }}</td>
                                    <td>
                                        @if($video->thumbnail_url)
                                            <img src="{{ $video->thumbnail_url }}" alt="Thumbnail" width="100">
                                        @elseif($video->file_path)
                                            <video width="100" controls><source src="{{ asset($video->file_path) }}" type="video/mp4"></video>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $video->is_approved ? 'success' : 'warning' }}">
                                            {{ $video->is_approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td>{{ $video->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('admin.videos.toggleApproval', $video->id) }}" class="btn btn-sm btn-{{ $video->is_approved ? 'warning' : 'success' }}">
                                            {{ $video->is_approved ? 'Unapprove' : 'Approve' }}
                                        </a>
                                        <a href="{{ route('admin.videos.destroy', $video->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No videos found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
