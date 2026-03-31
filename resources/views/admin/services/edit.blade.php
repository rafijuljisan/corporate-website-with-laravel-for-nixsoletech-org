<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit Service</h6>
                                    <p class="text-sm mb-0">Update the details for this service.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('services.update', $service) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="title" class="form-label font-weight-bold">Service Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $service->title) }}" required>
                                    @error('title') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label font-weight-bold">Description</label>
                                    <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $service->description) }}</textarea>
                                    @error('description') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label font-weight-bold">Icon Class (Optional)</label>
                                    <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon', $service->icon) }}">
                                    @error('icon') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-check form-switch mb-4 mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active (Visible on public website)</label>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('services.index') }}" class="btn btn-white me-2">Cancel</a>
                                    <button type="submit" class="btn btn-dark">Update Service</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>