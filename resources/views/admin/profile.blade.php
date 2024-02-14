@extends('layouts.main')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">My Profile </h4>



                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Action</h4>
                                <!-- Bootstrap buttons for actions -->
                                <a href="{{ route('change-password') }}" class="btn btn-info">Change Password </a>
                                <a href="{{ route('update_user') }}" class="btn btn-success">Update Details</a>

                                <button class="btn btn-danger" id="deleteAccountBtn">Delete Account</button>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                        {{-- uodate modal --}}
                        <div class="modal fade" id="updateDetailsModal" tabindex="-1"
                            aria-labelledby="updateDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateDetailsModalLabel">Update User Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateDetailsForm">
                                            <div class="mb-3">
                                                <label for="updateName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="updateName"
                                                    value="Current Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="updateEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="updateEmail"
                                                    value="Current Email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="updatePhone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="updatePhone"
                                                    value="Current Phone">
                                            </div>


                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row-->
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userId = localStorage.getItem('userId');
            const token = localStorage.getItem('token');

            if (userId && token) {
                const apiUrl = `http://127.0.0.1:8000/api/auth/fetch-user/${userId}`;

                fetch(apiUrl, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        const profileCard = document.querySelector('.card');
                        profileCard.innerHTML = `
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/User_icon-cp.svg/828px-User_icon-cp.svg.pnge" alt="User Image" class="rounded-circle" width="100">
                        <div class="card-body">
                            <h4 class="card-title">My Profile </h4>
                            
                            <ul class="list-unstyled">
                                <li><i class="fas fa-user"></i> <strong>Name:</strong> ${data.data.name}</li>
                                <li><i class="fas fa-envelope"></i> <strong>Email:</strong> ${data.data.email}</li>
                                <li><i class="fas fa-phone"></i> <strong>Phone:</strong> ${data.data.phone}</li>
                                <li><i class="fas fa-info-circle"></i> <strong>Status:</strong> ${data.data.status}</li>
                            </ul>
                        </div>
                    `;
                    })
                    .catch(error => {
                        console.error('Error fetching user data:', error);
                    });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userId = localStorage.getItem('userId');
            const token = localStorage.getItem('token');

            if (userId && token) {
                document.getElementById('deleteAccountBtn').addEventListener('click', function() {
                    const confirmation = confirm(
                        'Are you sure you want to delete your account? This action is irreversible.');

                    if (confirmation) {
                        const deleteUrl = `http://127.0.0.1:8000/api/auth/delete/${userId}`;

                        fetch(deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'Authorization': `Bearer ${token}`,
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(deleteResponse => {
                                console.log('Delete Response:', deleteResponse);

                                if (deleteResponse.status === 'success') {
                                    alert(
                                        'Your account has been scheduled for deletion. Log in again within the next 30 days to cancel.');
                                    window.location.href = '{{ route('sign.in') }}';
                                } else {
                                    alert('Error deleting user account: ' + deleteResponse.message);
                                }
                            })
                            .catch(deleteError => {
                                console.error('Error deleting user account:', deleteError);
                            });
                    }
                });
            }
        });
    </script>
@endsection
