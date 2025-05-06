@extends('admin.layouts.app')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <div class="icon-text-container d-flex align-items-center">
                        <i class="fas fa-envelope-open-text" style="font-size: 2rem; margin-right: 10px;"></i>
                        <h1 class="mb-0">Subscribers</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subscriber List</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    @if($subscribers->isEmpty())
                        <!-- No Subscribers Found Message -->
                        <div class="alert alert-warning text-center">No subscribers found</div>
                    @else
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th class="text-center">Email</th>
                                    <th>Subscribed At</th>
                                    <!-- <th>Day of Subscribed</th> -->
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscribers as $subscriber)
                                    @php
                                        $email = $subscriber->email;
                                        $domain = substr(strrchr($email, "@"), 1); // Get domain after '@'
                                        $iconClass = 'fas fa-envelope'; // Default icon
                                        $loginLink = '#'; // Default no link
                                        $emailSubject = rawurlencode('Regarding your subscription on Service Management');

                                        if (str_contains($domain, 'gmail.com')) {
                                            $iconClass = 'fab fa-google';
                                            $loginLink = 'https://mail.google.com/';
                                        } elseif (str_contains($domain, 'outlook.com') || str_contains($domain, 'live.com')) {
                                            $iconClass = 'fab fa-microsoft';
                                            $loginLink = 'https://outlook.live.com/';
                                        } elseif (str_contains($domain, 'hotmail.com')) {
                                            $iconClass = 'fas fa-fire';
                                            $loginLink = 'https://outlook.live.com/owa/';
                                        } elseif (str_contains($domain, 'yahoo.com')) {
                                            $iconClass = 'fab fa-yahoo';
                                            $loginLink = 'https://mail.yahoo.com/';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $subscriber->id }}</td>
                                        <td class="text-center">
                                            <a href="mailto:{{ $subscriber->email }}?subject={{ $emailSubject }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="{{ $iconClass }}"></i>&nbsp; &nbsp;{{ $subscriber->email }}
                                            </a>
                                            {{-- Optionally add a separate login link button if needed --}}
                                            {{-- <a href="{{ $loginLink }}" target="_blank" class="btn btn-sm btn-secondary ms-1">
                                                Go to Mail
                                            </a> --}}
                                        </td>
                                        <td>{{ $subscriber->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>


                        </table>
                    @endif
                </div>

                <div class="card-footer clearfix text-center">
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection