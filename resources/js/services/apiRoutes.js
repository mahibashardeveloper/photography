const UserApiVersion = '/api/user';
const GlobalApiVersion = '/api/global';

const apiRoutes = {

    // Authentication
    register: UserApiVersion + '/auth/register',
    login: UserApiVersion + '/auth/login',
    forget: UserApiVersion + '/auth/forget',
    reset: UserApiVersion + '/auth/reset',

    // Profile
    user_details: UserApiVersion + '/profile/details',
    user_update: UserApiVersion + '/profile/update',
    user_password: UserApiVersion + '/profile/password',
    user_logout: UserApiVersion + '/profile/logout',

    // Photo
    photo_create: UserApiVersion + '/photo/create',
    photo_list: UserApiVersion + '/photo/list',
    photo_single: UserApiVersion + '/photo/single',
    photo_update: UserApiVersion + '/photo/update',
    photo_delete: UserApiVersion + '/photo/delete',

    // Media
    media: UserApiVersion + '/media/upload',

    //Global List
    global_list: GlobalApiVersion + '/photo/list',

}

export default apiRoutes;
