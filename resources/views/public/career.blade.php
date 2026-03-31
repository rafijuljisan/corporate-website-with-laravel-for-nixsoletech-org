@extends('layouts.public')

@section('content')
    {{-- ══ HERO SECTION (COMPACT OPTION 1) ══ --}}
    <div class="bg-light py-4 mb-5 border-bottom position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }}; opacity: 0.03;"></div>
        <div class="container text-center position-relative">
            <h1 class="fw-bold h2 mb-2">Life at {{ $settings->site_name ?? 'Nixsoletech' }}</h1>
            <p class="text-muted mx-auto mb-0" style="max-width: 800px; font-size: 1.05rem;">
                At Nixsoletech, every job is a scope of individual development. Employees are working dedicatedly in the organization since long in different business concerns from Construction, Trading, Logistics, Export-Import, Supplier & It Products and Technology etc., according to their area of passion or interest.
            </p>
        </div>
    </div>

    <div class="container mb-5 pb-5">
        
        {{-- ══ CULTURE SECTION ══ --}}
        <div class="row g-5 mb-5 pb-4 border-bottom">
            <div class="col-md-6">
                <h3 class="fw-bold mb-4 d-flex align-items-center"><i class="bi bi-stars me-2 text-warning"></i> Why Join Us?</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent px-0 text-muted border-0 mb-2 d-flex"><i class="bi bi-check2-circle text-success me-3 mt-1"></i> Make a positive impact in the society with dedication in increasing the reach of international standards across the Country.</li>
                    <li class="list-group-item bg-transparent px-0 text-muted border-0 mb-2 d-flex"><i class="bi bi-check2-circle text-success me-3 mt-1"></i> Work in an environment that prioritizes creativity, speed, and high performance.</li>
                    <li class="list-group-item bg-transparent px-0 text-muted border-0 mb-2 d-flex"><i class="bi bi-check2-circle text-success me-3 mt-1"></i> Be part of a company that promotes and embodies equality, safety, and diversity.</li>
                    <li class="list-group-item bg-transparent px-0 text-muted border-0 mb-2 d-flex"><i class="bi bi-check2-circle text-success me-3 mt-1"></i> Experience the rewarding career development you’re seeking.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold mb-4 d-flex align-items-center"><i class="bi bi-building-heart me-2" style="color: {{ $settings->primary_color ?? '#0d6efd' }};"></i> Work Culture</h3>
                <div class="d-flex flex-wrap gap-2">
                    @foreach(['Freedom and responsibility', 'Performance oriented', 'Continuous improvement', 'Open for creativity and innovation', 'Operational Transparency', 'Excellent work ethos'] as $culture)
                        <span class="badge bg-light text-dark border p-2 px-3 fw-normal" style="font-size: 0.95rem;">{{ $culture }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══ JOB OPENINGS ACCORDION ══ --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold">Current Opportunities</h2>
            <p class="text-muted">Join our team of professionals and add value through continuous improvement.</p>
        </div>

        @if($jobs->count() > 0)
            <div class="accordion" id="jobsAccordion">
                @foreach($jobs as $job)
                    <div class="accordion-item mb-3 border rounded-3 shadow-sm overflow-hidden">
                        <h2 class="accordion-header" id="heading{{ $job->id }}">
                            <button class="accordion-button collapsed bg-white fw-bold fs-5 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $job->id }}">
                                {{ $job->title }}
                                @if($job->deadline)
                                    <span class="badge bg-danger ms-3 fs-6 fw-normal">Deadline: {{ $job->deadline->format('d M Y') }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="collapse{{ $job->id }}" class="accordion-collapse collapse" data-bs-parent="#jobsAccordion">
                            <div class="accordion-body bg-light p-4 p-md-5">
                                
                                {{-- Top Meta Info --}}
                                <div class="row g-3 mb-4 pb-4 border-bottom">
                                    <div class="col-sm-6 col-md-3"><strong>Vacancy:</strong><br> <span class="text-muted">{{ $job->vacancy ?? 'Not specific' }}</span></div>
                                    <div class="col-sm-6 col-md-3"><strong>Employment Status:</strong><br> <span class="text-muted">{{ $job->employment_status ?? 'N/A' }}</span></div>
                                    <div class="col-sm-6 col-md-3"><strong>Workplace:</strong><br> <span class="text-muted">{{ $job->workplace ?? 'N/A' }}</span></div>
                                    <div class="col-sm-6 col-md-3"><strong>Location:</strong><br> <span class="text-muted">{{ $job->job_location ?? 'N/A' }}</span></div>
                                </div>

                                {{-- Main Body Info --}}
                                @if($job->job_context)
                                    <h6 class="fw-bold text-dark mt-4">Job Context</h6>
                                    <p class="text-muted mb-4">{!! nl2br(e($job->job_context)) !!}</p>
                                @endif

                                @if($job->job_responsibilities)
                                    <h6 class="fw-bold text-dark mt-4">Job Responsibilities</h6>
                                    <div class="text-muted mb-4 ps-3" style="border-left: 3px solid {{ $settings->primary_color ?? '#0d6efd' }};">{!! nl2br(e($job->job_responsibilities)) !!}</div>
                                @endif

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        @if($job->educational_requirements)
                                            <h6 class="fw-bold text-dark">Educational Requirements</h6>
                                            <p class="text-muted mb-4">{!! nl2br(e($job->educational_requirements)) !!}</p>
                                        @endif
                                        @if($job->experience_requirements)
                                            <h6 class="fw-bold text-dark">Experience Requirements</h6>
                                            <p class="text-muted mb-4">{!! nl2br(e($job->experience_requirements)) !!}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($job->additional_requirements)
                                            <h6 class="fw-bold text-dark">Additional Requirements</h6>
                                            <p class="text-muted mb-4">{!! nl2br(e($job->additional_requirements)) !!}</p>
                                        @endif
                                        <h6 class="fw-bold text-dark">Salary & Benefits</h6>
                                        <p class="text-muted mb-1"><strong>Salary:</strong> {{ $job->salary ?? 'Negotiable' }}</p>
                                        @if($job->compensation_benefits)
                                            <p class="text-muted mt-2">{!! nl2br(e($job->compensation_benefits)) !!}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4 text-center text-md-start">
                                    <a href="{{ route('contact') }}?subject={{ urlencode('Application for ' . $job->title) }}" class="btn text-white px-5 py-2 fw-bold" style="background-color: {{ $settings->primary_color ?? '#0d6efd' }};">Apply Now</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 bg-light rounded-4 border">
                <i class="bi bi-briefcase fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h5 class="text-muted">No vacancies available right now.</h5>
                <p class="text-muted mb-0">Please check back later or follow us on social media for updates.</p>
            </div>
        @endif

    </div>
@endsection