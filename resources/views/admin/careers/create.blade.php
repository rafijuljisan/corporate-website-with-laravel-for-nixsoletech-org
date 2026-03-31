<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12 col-xl-10 m-auto">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Post a New Job</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('careers.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    {{-- Basic Info --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Job Title *</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Vacancy</label>
                                        <input type="text" name="vacancy" class="form-control" placeholder="e.g. 2, or 'Not Specific'">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Application Deadline</label>
                                        <input type="date" name="deadline" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Employment Status</label>
                                        <input type="text" name="employment_status" class="form-control" placeholder="e.g. Full-time">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Workplace</label>
                                        <input type="text" name="workplace" class="form-control" placeholder="e.g. Work at office">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Job Location</label>
                                        <input type="text" name="job_location" class="form-control" placeholder="e.g. Dhaka (Mirpur)">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Salary</label>
                                        <input type="text" name="salary" class="form-control" placeholder="e.g. Negotiable">
                                    </div>
                                    <div class="col-md-6 pt-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                            <label class="form-check-label">Publish to public site immediately</label>
                                        </div>
                                    </div>

                                    {{-- Text Areas --}}
                                    <div class="col-12"><hr></div>
                                    
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Job Context</label>
                                        <textarea name="job_context" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Job Responsibilities (Use dash/bullets)</label>
                                        <textarea name="job_responsibilities" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Educational Requirements</label>
                                        <textarea name="educational_requirements" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Experience Requirements</label>
                                        <textarea name="experience_requirements" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Additional Requirements</label>
                                        <textarea name="additional_requirements" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Compensation & Other Benefits</label>
                                        <textarea name="compensation_benefits" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="col-12 mt-4 text-end">
                                        <a href="{{ route('careers.index') }}" class="btn btn-white me-2">Cancel</a>
                                        <button type="submit" class="btn btn-dark">Save & Post Job</button>
                                    </div>
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