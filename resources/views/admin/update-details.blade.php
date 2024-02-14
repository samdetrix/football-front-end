@extends('layouts.main')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Update User Details</h4>



                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control"
                                            placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" class="form-control"
                                            placeholder="Enter your phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" id="status" disabled class="form-control"
                                            placeholder="Enter your status">
                                    </div>

                                    <!-- Update button -->
                                    <button class="btn btn-primary" type="button" id="updateUserBtn">Update</button>
                                </form>


                            </div>
                            <!-- end card-body-->
                        </div>
                        <!-- end card -->
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
                                            // Populate form with user data
                                            document.getElementById('name').value = data.data.name;
                                            document.getElementById('email').value = data.data.email;
                                            document.getElementById('phone').value = data.data.phone;
                                            document.getElementById('status').value = data.data.status;
                                        })
                                        .catch(error => {
                                            console.error('Error fetching user data:', error);
                                        });

                                    document.getElementById('updateUserBtn').addEventListener('click', function() {
                                        const updateUrl = `http://127.0.0.1:8000/api/auth/update/${userId}`;

                                        // Prepare the update payload
                                        const updateData = {
                                            name: document.getElementById('name').value,
                                            email: document.getElementById('email').value,
                                            phone: document.getElementById('phone').value,
                                        };

                                        fetch(updateUrl, {
                                                method: 'PUT',
                                                headers: {
                                                    'Authorization': `Bearer ${token}`,
                                                    'Content-Type': 'application/json',
                                                },
                                                body: JSON.stringify(updateData),
                                            })
                                            .then(response => response.json())
                                            .then(updateResponse => {
                                                console.log('Update Response:', updateResponse);

                                                if (updateResponse.status === 'success') {
                                                    alert('User data updated successfully!');
                                                    window.location.href = '{{ route('profile') }}';
                                                } else {
                                                    alert('Error updating user data: ' + updateResponse.message);
                                                }
                                            })
                                            .catch(updateError => {
                                                console.error('Error updating user data:', updateError);
                                            });
                                    });
                                }
                            });
                        </script>
                    @endsection
