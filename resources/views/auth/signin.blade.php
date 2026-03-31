<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent text-center">
                                    <h3 class="font-weight-black text-dark display-6">Welcome back</h3>
                                    <p class="mb-0">Sign in to your admin dashboard.</p>
                                </div>
                                <div class="text-center mt-3">
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @error('message')
                                        <div class="alert alert-danger text-sm text-white" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start" method="POST" action="sign-in">
                                        @csrf
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            {{-- Secure: Starts blank, only remembers if validation fails --}}
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email address"
                                                value="{{ old('email') }}"
                                                aria-label="Email" aria-describedby="email-addon" required autofocus>
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            {{-- Secure: Never pre-fills --}}
                                            <input type="password" id="password" name="password"
                                                class="form-control" placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon" required>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-check-info text-left mb-0">
                                                <input class="form-check-input" type="checkbox" name="remember" value="1"
                                                    id="flexCheckDefault">
                                                <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">
                                                    Remember for 14 days
                                                </label>
                                            </div>
                                            <a href="{{ route('password.request') }}"
                                                class="text-xs font-weight-bold ms-auto">Forgot password?</a>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- Sign up section completely removed for production security --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('../assets/img/image-sign-in.jpg')">
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">Nixsoletech Admin Portal</h2>
                                        <h6 class="text-dark text-sm mt-5">Copyright © {{ date('Y') }} Nixsoletech. All Rights Reserved.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>