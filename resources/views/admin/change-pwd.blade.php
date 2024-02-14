@extends('layouts.main')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Change Password</h4>



                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <form>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="currentPassword">Current Password</label>
                                                    <input type="password" id="currentPassword" class="form-control" placeholder="Enter your current password">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="newPassword">New Password</label>
                                                    <input type="password" id="newPassword" class="form-control" placeholder="Enter your new password">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Update button -->
                                        <button class="btn btn-primary" type="button" id="changePasswordBtn">Change Password</button>
                                    </form>
                            </div>
                        </div>
                    @endsection
                    @section('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const userId = localStorage.getItem('userId');
                            const token = localStorage.getItem('token');
                    
                            if (userId && token) {
                                document.getElementById('changePasswordBtn').addEventListener('click', function () {
                                    const changePasswordUrl = `http://127.0.0.1:8000/api/auth/change-password`;
                    
                                    const changePasswordData = {
                                        current_password: document.getElementById('currentPassword').value,
                                        new_password: document.getElementById('newPassword').value,
                                    };
                    
                                    fetch(changePasswordUrl, {
                                        method: 'POST',
                                        headers: {
                                            'Authorization': `Bearer ${token}`,
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify(changePasswordData),
                                    })
                                        .then(response => response.json())
                                        .then(changePasswordResponse => {
                                            console.log('Change Password Response:', changePasswordResponse);
                    
                                            if (changePasswordResponse.status === 'success') {
                                                alert('Password changed successfully!');
                                                window.location.href = '{{ route('sign.in') }}';
                                            } else {
                                                alert('Error changing password: ' + changePasswordResponse.message);
                                            }
                                        })
                                        .catch(changePasswordError => {
                                            console.error('Error changing password:', changePasswordError);
                                        });
                                });
                            }
                        });
                    </script>
                    @endsection
