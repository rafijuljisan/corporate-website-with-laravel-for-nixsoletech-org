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
                                    <h6 class="font-weight-semibold text-lg mb-0">Hero Sliders</h6>
                                    <p class="text-sm">Manage the homepage hero slider images and content.</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('sliders.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M12 4.5v15m7.5-7.5h-15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Add Slide</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7" style="width:60px;">Order</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Preview</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Title / Subtitle</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sliders as $slider)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="text-sm font-weight-semibold text-secondary">{{ $slider->order }}</span>
                                                </td>
                                                <td>
                                                    <div class="px-2 py-1">
                                                        <img src="{{ $slider->image_url }}"
                                                             alt="{{ $slider->title }}"
                                                             style="width:90px;height:52px;object-fit:cover;border-radius:8px;border:1px solid #eee;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-2 py-1">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">{{ $slider->title }}</h6>
                                                        @if($slider->subtitle)
                                                            <p class="text-xs text-secondary mb-0">{{ Str::limit($slider->subtitle, 50) }}</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($slider->is_active)
                                                        <span class="badge badge-sm border border-success text-success bg-success">Active</span>
                                                    @else
                                                        <span class="badge badge-sm border border-secondary text-secondary">Hidden</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm d-flex align-items-center gap-2 py-3">
                                                    <a href="{{ route('sliders.edit', $slider) }}" class="text-secondary font-weight-bold text-xs">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('sliders.destroy', $slider) }}" method="POST"
                                                          onsubmit="return confirm('Delete this slide?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-sm text-secondary">
                                                    No slides yet. Click <strong>Add Slide</strong> to create one.
                                                </td>
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