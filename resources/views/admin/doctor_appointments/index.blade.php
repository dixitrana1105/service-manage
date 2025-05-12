@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0"><i class="fas fa-user-md me-2"></i>&nbsp;Doctor Appointments</h2>
            <a href="{{ route('admin.doctor-appointments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Doctor</th>
                        <th>Doctor-Image</th>
                        <th>Designation</th>
                        <th>Patient</th>
                        <th>Visit Date</th>
                        <th>Status</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $row)
                        <tr>
                            <td>{{ $row->doctor_name }}</td>
                            <td>
                                <img src="{{ asset($row->doctor_image) }}" alt="Doctor Image" width="60" height="60"
                                    class="rounded-circle mb-1"><br>
                                <small class="text-muted"><strong>Path :-</strong>{{ $row->doctor_image }}</small>
                            </td>
                            <td>{{ $row->doctor_designation }}</td>
                            <td>{{ $row->patient_name }}</td>
                            <td>{{ $row->appointment_date }}</td>
                            <td>
                                <button
                                    class="badge border-0 bg-{{ $row->status === 'confirmed' ? 'success' : ($row->status === 'pending' ? 'warning text-dark' : 'secondary') }}"
                                    data-bs-toggle="modal" data-bs-target="#statusModal" data-id="{{ $row->id }}"
                                    data-status="{{ $row->status }}">
                                    {{ ucfirst($row->status) }}
                                </button>
                                <!-- Change Status Button -->
                                <!-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#statusModal{{ $row->id }}">
                                                    Change Status
                                                </button><br>
                                                {{ $row->status }} -->
                            </td>
                            <td>
                                <a href="{{ route('admin.doctor-appointments.edit', $row->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.doctor-appointments.destroy', $row->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Change Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('doctor_appointments.changeStatus') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Change Appointment Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="appointment" id="modalAppointmentId">
                        <div class="mb-3">
                            <label for="modalStatus" class="form-label">Select Status</label>
                            <select class="form-select" name="status" id="modalStatus" required>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Status</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection