<div>
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </a>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('admin') }}/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()?->name }}" />
                        <span class="text-dark">{{ auth()->user()?->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a x-data class="dropdown-item" href="#" @click="
                            Swal.fire({
                                title: 'Are you sure?',
                                text: '',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch('{{ route('auth.destroy') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(() => {
                                        window.location.href = '/login'
                                    })
                                }
                            })
                        "><i class="fa fa-sign-out"></i> Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
