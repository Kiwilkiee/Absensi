<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<div class="container">
    <div class="header">
        <span class="back-button" > <a href="/dashboard"><ion-icon name="arrow-back-outline"></a></ion-icon></span>
        <h1>Profile</h1>
        <span></span> <!-- Empty space for alignment -->
    </div>
        
    </div>
    <div class="profile-container">
        <div class="avatar-profile">
            <img id="avatar-profile" src="https://imgv3.fotor.com/images/blog-cover-image/10-profile-picture-ideas-to-make-you-stand-out.jpg" alt="Avatar"> <!-- Avatar URL from localStorage -->
            <div class="edit-avatar">
                <ion-icon name="pencil-outline"></ion-icon>
            </div>
        </div>
        <div class="data-profile">
            <div class="profile-name">
                <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                <span id="user-name" class="underline"></span>
                <span class="edit-icon"><ion-icon name="pencil-outline"></ion-icon></span>
            </div>
            <div class="profile-email">
                
                <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                <span id="user-email" class="underline"></span>
                <span class="edit-icon"><ion-icon name="pencil-outline"></ion-icon></span>
            </div>
            <div class="profile-password">
                <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                <span id="user-roles" class="underline"></span>
                <span class="edit-icon"><ion-icon name="pencil-outline"></ion-icon></span>
            </div>
            <div class="profile-position">
                <span class="icon"><ion-icon name="briefcase-outline"></ion-icon></span>
                <span id="user-role" class="underline"></span>
                {{-- <span class="edit-icon"><ion-icon name="pencil-outline"></ion-icon></span> --}}
            </div>
        </div>
        <button class="button-logout" onclick="handelLogout()">Logout</button>
    </div>
</div>



<!-- Modal for Name -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">Edit Nama </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editNameForm">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNameInput" name="name" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <!-- Modal for Role -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRoleForm">
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <input type="text" class="form-control" id="editRoleInput" name="role" value="role">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal for Email -->
<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmailForm">
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmailInput" name="email" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Password -->
<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPasswordForm">
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPasswordInput" name="password" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Ionicons -->
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@6.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@6.0.0/dist/ionicons/ionicons.js"></script>
<!-- JavaScript to handle localStorage data -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="{{ asset('asset/js/profile.js') }}"></script>

<script>
    function handelLogout() {
        localStorage.clear()
        window.location.href = '/';
    }


</script>
</body>
</html>
