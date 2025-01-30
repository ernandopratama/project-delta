<x-layouts.auth>
    <x-slot:title>
        LOGIN
    </x-slot:title>
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back!</h1>
                        <p class="lead">
                            Sign in to your account to continue
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form method="POST" action="{{ route('auth.create') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <x-acc-input type="email" model="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter your email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <x-acc-input type="password" model="password" placeholder="*****"  />
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label text-small" for="remember">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <button type="submit" class="btn btn-primary float-end">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
