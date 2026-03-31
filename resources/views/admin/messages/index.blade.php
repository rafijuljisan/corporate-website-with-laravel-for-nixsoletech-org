<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
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
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Inbox</h6>
                                    <p class="text-sm mb-0">Read messages sent from your public contact form.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Sender</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Subject</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Message</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Received</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($messages as $msg)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $msg->name }}</h6>
                                                            <p class="text-sm text-secondary mb-0">{{ $msg->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">{{ $msg->subject }}</p>
                                                </td>
                                                <td style="max-width: 300px; white-space: normal;">
                                                    <p class="text-sm text-secondary mb-0">{{ $msg->message }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-secondary mb-0">{{ $msg->created_at->format('M d, Y h:i A') }}</p>
                                                </td>
                                                <td class="text-sm">
                                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?');">
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
                                                <td colspan="5" class="text-center py-4 text-sm">Your inbox is empty.</td>
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