<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Add Gallery Image</h6>
                            <p class="text-sm mb-3">Upload a new image to your public gallery.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Image File <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                    @error('image') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Title / Caption (Optional)</label>
                                    <input type="text" name="title" class="form-control" placeholder="e.g., Annual Tech Conference">
                                    @error('title') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-check form-switch mb-4 mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">Active (Visible on public website)</label>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('galleries.index') }}" class="btn btn-white me-2">Cancel</a>
                                    <button type="submit" class="btn btn-dark">Upload Image</button>
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