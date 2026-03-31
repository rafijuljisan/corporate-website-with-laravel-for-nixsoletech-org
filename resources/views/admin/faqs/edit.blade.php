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
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit FAQ</h6>
                                    <p class="text-sm mb-0">Update this frequently asked question.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('faqs.update', $faq) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="question" class="form-label font-weight-bold">Question</label>
                                    <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                                    @error('question') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="answer" class="form-label font-weight-bold">Answer</label>
                                    <textarea name="answer" id="answer" rows="5" class="form-control" required>{{ old('answer', $faq->answer) }}</textarea>
                                    @error('answer') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-check form-switch mb-4 mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active (Visible on public website)</label>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('faqs.index') }}" class="btn btn-white me-2">Cancel</a>
                                    <button type="submit" class="btn btn-dark">Update FAQ</button>
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