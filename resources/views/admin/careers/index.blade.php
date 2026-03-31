<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                            <span class="text-sm">{{ session('success') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Careers / Job Postings</h6>
                                    <p class="text-sm">Manage open vacancies for your company.</p>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('careers.create') }}" class="btn btn-sm btn-dark">Add New Job</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Job Title</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Deadline</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Status</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($careers as $job)
                                            <tr>
                                                <td><p class="text-sm font-weight-semibold mb-0 px-3">{{ $job->title }}</p></td>
                                                <td><p class="text-sm mb-0">{{ $job->deadline ? $job->deadline->format('d M Y') : 'Open' }}</p></td>
                                                <td>
                                                    <span class="badge badge-sm {{ $job->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $job->is_active ? 'Active' : 'Hidden' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('careers.destroy', $job) }}" method="POST" onsubmit="return confirm('Delete this job?');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-danger text-xs border-0 bg-transparent p-0">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-4">No job postings found.</td></tr>
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