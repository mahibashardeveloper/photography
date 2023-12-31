<template>

    <div class="p-3 bg-light fw-bold mb-4">
        Settings
    </div>

    <!-- group of button section start -->
    <div class="d-flex align-items-center flex-wrap">
        <a href="javascript:void(0)" class="btn me-3 mb-4" @click="changePasswordTab" :class="{'btn-dark' : tab === 1, 'btn-outline-dark' : tab !== 1}">
            Change Password
        </a>
        <a href="javascript:void(0)" class="btn mb-4" @click="editProfileTab" :class="{'btn-dark' : tab === 2, 'btn-outline-dark' : tab !== 2}">
            Edit Profile
        </a>
    </div>
    <!-- group of button section end -->

    <!-- password change section start -->
    <form @submit.prevent="updatePassword" class="col-12 col-lg-6 p-3 border bg-white rounded-3" v-if="tab === 1">
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" v-model="passwordParam.current_password" autocomplete="off">
            <div class="error-text" v-if="error != null && error.current_password !== undefined" v-text="error.current_password[0]"></div>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" v-model="passwordParam.password" autocomplete="off">
            <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" v-model="passwordParam.password_confirmation" autocomplete="off">
            <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
        </div>
        <button type="submit" class="btn btn-outline-dark" v-if="updateProfileLoading === false">Update Password</button>
        <button type="button" class="btn btn-dark" v-if="updateProfileLoading === true">Loading...</button>
    </form>
    <!-- password change section end -->

    <!-- profile update section start -->
    <form @submit.prevent="updateProfile" class="col-12 col-lg-6 p-3 border bg-white rounded-3" v-if="tab === 2">
        <div class="mb-3">
            <div class="d-flex justify-content-center mb-3">
                <div class="user-avatar overflow-hidden" v-if="!editParam.avatar">
                    <img :src="'/images/avatar.png'" alt="profile-dummy">
                </div>
                <div class="user-avatar overflow-hidden" v-if="editParam.avatar !== null">
                    <img :src="editParam.avatar" alt="profile">
                </div>
            </div>
            <div class="text-center">
                <label for="update-photo" class="btn btn-outline-danger">
                    <input id="update-photo" type="file" name="" class="d-none" @change="attachFile($event)">
                    <i class="bi bi-repeat me-2"></i>
                    replace Photo
                </label>
                <div class="error-text" v-if="error != null && error.avatar !== undefined" v-text="error.avatar[0]"></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control" v-model="editParam.name" autocomplete="off">
            <div class="error-text" v-if="error != null && error.name !== undefined" v-text="error.name[0]"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" v-model="editParam.email" autocomplete="off">
            <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
        </div>
        <button type="submit" class="btn btn-outline-dark" v-if="updateProfileLoading === false">Update Profile</button>
        <button type="button" class="btn btn-dark" v-if="updateProfileLoading === true">Loading...</button>
    </form>
    <!-- profile update section end -->

</template>

<script>

    import apiServices from "../../services/apiServices.js";
    import apiRoutes from "../../services/apiRoutes.js";

    export default {

        data() {
            return {
                profile_data: '',
                profileDataLoading: false,
                updateProfileLoading: false,
                error: null,
                edit: false,
                editParam: {
                    name: '',
                    email: '',
                    avatar: ''
                },
                passwordParam: {
                    current_password: '',
                    password: '',
                    password_confirmation: ''
                },
                tab: 1,
            }
        },

        mounted() {
            this.getProfile()
        },

        methods: {

            /* ------------------------------------------
                change password of user in tab 1 (default)
            --------------------------------------------*/

            changePasswordTab(){
                this.tab = 1;
                this.edit = true;
                this.editParam = JSON.parse(JSON.stringify(this.profile_data));
            },

            /* ------------------------------------------
                edit profile of user in tab 2
            --------------------------------------------*/

            editProfileTab(){
                this.tab = 2;
                this.edit = true;
                this.editParam = JSON.parse(JSON.stringify(this.profile_data));
                this.editParam.avatarFilePath = this.editParam.media != null ? this.editParam.media.full_file_path : null
            },

            /* ------------------------------------------
                attach user profile image
            --------------------------------------------*/

            attachFile(event) {
                let file = event.target.files[0];
                let formData = new FormData();
                formData.append("file", file)
                formData.append("media_type", 1);
                apiServices.UPLOAD(apiRoutes.media, formData, (res) => {
                    event.target.value = '';
                    if (res.status === 200) {
                        this.editParam.avatar = res.data.full_file_path;
                    }
                })
            },

            /* ------------------------------------------
                get profile of user data in details
            --------------------------------------------*/

            getProfile() {
                this.profileDataLoading = true;
                apiServices.GET(apiRoutes.user_details, (res) => {
                    this.profileDataLoading = false;
                    if (res.status === 200) {
                        this.profile_data = res.data;
                    }
                })
            },

            /* ------------------------------------------
                update profile of user information
            --------------------------------------------*/

            updateProfile() {
                this.updateProfileLoading = true;
                this.error = null;
                apiServices.POST(apiRoutes.user_update, this.editParam, (res) => {
                    this.updateProfileLoading = false;
                    if (res.status === 200) {
                        this.getProfile();
                        this.edit = false;
                        this.$toast.success('Your Profile has been updated successfully.', { position: "top-right" });
                        window.location.reload();
                    } else {
                        this.error = res.errors;
                    }
                })
            },

            /* ------------------------------------------
                update password of user information
            --------------------------------------------*/

            updatePassword() {
                this.updateProfileLoading = true;
                this.error = null;
                apiServices.POST(apiRoutes.user_password, this.passwordParam, (res) => {
                    this.updateProfileLoading = false;
                    if (res.status === 200) {
                        this.getProfile();
                        this.edit = false;
                        this.$toast.success('Your password has been updated successfully.', { position: "top-right" });
                        this.passwordParam = {current_password: '', password: '', password_confirmation: ''};
                    } else {
                        this.error = res.errors;
                    }
                })
            },
        }

    }

</script>
