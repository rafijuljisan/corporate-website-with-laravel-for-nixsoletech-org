<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                            <span class="text-sm">{{ session('success') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Gallery Images</h6>
                                    <p class="text-sm">Manage your portfolio and gallery images.</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('galleries.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--text">Upload New Image</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Image</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Title</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($galleries as $gallery)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <img src="{{ asset('storage/' . $gallery->image) }}" class="avatar avatar-sm rounded-2 me-2" alt="gallery image" style="object-fit: cover;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-semibold mb-0">{{ $gallery->title ?? 'Untitled' }}</p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm border {{ $gallery->is_active ? 'border-success text-success bg-success' : 'border-secondary text-secondary bg-secondary' }}">
                                                        {{ $gallery->is_active ? 'Active' : 'Hidden' }}
                                                    </span>
                                                </td>
                                                <td class="text-sm">
                                                    <form action="{{ route('galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Delete this image forever?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-sm">No images in gallery yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>