@extends('layouts.main')

@section('container')
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
    <div class="container mb-4 text-center">
        <h1>{{ $title }}</h1>
    </div>
    <div class="filter d-flex justify-content-between">

        {{-- DROPDOWN  --}}
        <div class="dropdown">
            <div class="bg-light rounded shadow-sm mb-4" style="padding: 12px">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                    style="color:black">
                    Type Rectifier
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/home?type=TTC">TTC</a></li>
                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>
                    <li><a class="dropdown-item" href="/home?type=Inner">Inner</a></li>
                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>
                    <li><a class="dropdown-item" href="/home?type=Outer">Outer</a></li>
                </ul>
            </div>
        </div>

        {{-- SEARCH  --}}
        <div class="p-1 bg-light rounded shadow-sm mb-4">
            <form action="/home" method="GET">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="form-control border-0 bg-light">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- CONTENT  --}}
    <main>
        <div class="row">
            @if ($rectifiers->count())
                @foreach ($rectifiers as $rectifier)
                    <div id="recti-list" class="col-sm-3 mb-3 mb-sm-0">
                        <div class="data-card">
                            <div class="d-flex flex-row justify-content-end mb-2">
                                <a href="javascript:void(0)" class="edit-recti me-3" data-bs-toggle="modal"
                                    data-id="{{ $rectifier->ip_recti }}" data-bs-target="#modalRecti">
                                    <span class="link-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </span>
                                </a>
                                <a href="javascript:void(0)" class="delete-recti" data-bs-toggle="modal"
                                    data-id="{{ $rectifier->ip_recti }}" data-bs-target="#modalRecti">
                                    <span class="link-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <h3>{{ $rectifier->name }}</h3>
                            <h4>{{ $rectifier->ip_recti }}</h4>
                            <h6>Voltage : {{ $rectifier->dataRectifiers->last()->voltage }}</h6>
                            <h6>Current : {{ $rectifier->dataRectifiers->last()->current }}</h6>
                            <h6>Temperature : {{ $rectifier->dataRectifiers->last()->temp }}</h6>
                            <p>Site : {{ $rectifier->site_name }}</p>
                            <p>RTPO : {{ $rectifier->rtpo }}</p>
                            <p>NSA : {{ $rectifier->nsa }}</p>
                            <p>Type : {{ $rectifier->type }}</p>
                            <div class="d-flex flex-row">
                                <div class="col-6">
                                    <a href="javascript:void(0)" class="detail-btn" data-bs-toggle="modal"
                                        data-id="{{ $rectifier->ip_recti }}" data-bs-target="#modalRecti">
                                        <div>
                                            <span class="link-text">
                                                Details
                                                <svg width="25" height="16" viewBox="0 0 25 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z"
                                                        fill="#753BBD" />
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0)" class="realtime-btn" data-bs-toggle="modal"
                                        data-id="{{ $rectifier->ip_recti }}" data-bs-target="#modalRecti">
                                        <span class="link-text">
                                            Realtime
                                            <svg width="25" height="16" viewBox="0 0 25 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z"
                                                    fill="#753BBD" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="text-center fs-3">No Rectifier found.</h3>
            @endif

            {{-- MODALS  --}}
            <div class="modal fade" id="modalRecti" data-bs-backdrop="static" tabindex="-1"
                aria-labelledby="modalRecti" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                    <div class="modal-content" style="background-image: url('/img/memphis-bg.jpg');">
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end">
            {{ $rectifiers->links() }}
        </div>
    </main>

    <script>
        // TOAST
        @if (session()->has('loginSuccess'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('loginSuccess') }}'
            })
        @endif

        @if (session()->has('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'Rectifier Added Successfully',
                showConfirmButton: false,
                timer: 2000
            })
        @endif

        @if (session()->has('edit-success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'Rectifier Edited Successfully',
                showConfirmButton: false,
                timer: 2000
            })
        @endif

        @if (session()->has('delete-success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'Rectifier Deleted Successfully',
                showConfirmButton: false,
                timer: 2000
            })
        @endif

        // AJAX MODAL realtime
        $(".realtime-btn").click(function() {
            const ip_recti = $(this).attr("data-id");

            try {
                $.ajax({
                    url: "rectifier/realtime/" + ip_recti,
                    type: "GET",
                    success: function(data) {
                        $(".modal-content").html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (error) {
                console.log(error);
            }
        });

        // AJAX MODAL DETAIL
        $(".detail-btn").click(function() {
            const ip_recti = $(this).attr("data-id");

            try {
                $.ajax({
                    url: "rectifier/detail/" + ip_recti,
                    type: "GET",
                    success: function(data) {
                        $(".modal-content").html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (error) {
                console.log(error);
            }
        });

        // Edit Modal
        $(".edit-recti").click(function() {
            const ip_recti = $(this).attr("data-id");

            try {
                $.ajax({
                    url: "edit/" + ip_recti,
                    type: "GET",
                    success: function(data) {
                        $(".modal-content").html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (error) {
                console.log(error);
            }
        });

        // Delete Modal
        $(".delete-recti").click(function() {
            const ip_recti = $(this).attr("data-id");

            try {
                $.ajax({
                    url: "delete/" + ip_recti,
                    type: "GET",
                    success: function(data) {
                        $(".modal-content").html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            } catch (error) {
                console.log(error);
            }
        });
    </script>
@endsection
