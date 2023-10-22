<template>

    <div class="p-3 bg-light fw-bold mb-4">
        Settings
    </div>

    <div class="d-flex align-items-center mb-4">
        <a href="javascript:void(0)" class="btn btn-dark me-3" @click="changePasswordModal">
            Change Password
        </a>
        <a href="javascript:void(0)" class="btn btn-dark" @click="editPasswordModal">
            Edit Profile
        </a>
    </div>

    <form class="col-12 p-3 border bg-white" v-if="tab === 1">
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="text" name="current_password" class="form-control shadow-none border-secondary-subtle" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="text" name="new_password" class="form-control shadow-none border-secondary-subtle" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="text" name="confirm_password" class="form-control shadow-none border-secondary-subtle" required>
        </div>
        <button type="submit" class="btn btn-dark">Update Password</button>
    </form>

    <form class="col-12 p-3 border bg-white" v-if="tab === 2">
        <div class="mb-3">
            <div class="d-flex justify-content-center mb-3">
                <div class="user-avatar">
                    <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar.png">
                </div>
            </div>
            <div class="text-center">
                <label for="update-photo" class="btn btn-outline-danger px-4 py-2">
                    <input id="update-photo" type="file" name="" class="d-none">
                    <i class="bi bi-repeat me-2"></i>
                    replace Photo
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="full_name" class="form-label">Name</label>
            <input type="text" name="full_name" class="form-control shadow-none border-secondary-subtle" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control shadow-none border-secondary-subtle" required>
        </div>
        <button type="submit" class="btn btn-dark">Update Profile</button>
    </form>

</template>

<script>

export default {

    data(){

        return{
            tab: 1,
        }

    },

    mounted() {



    },

    methods: {

        changePasswordModal(){
            this.tab = 1;
        },

        editPasswordModal(){
            this.tab = 2;
        }

    }

}

</script>
