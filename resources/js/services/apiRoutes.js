const apiVersion = '/api/user';

const apiRoutes = {

    // Authentication
    register: apiVersion + '/auth/register',
    login: apiVersion + '/auth/login',
    forget: apiVersion + '/auth/forget',
    reset: apiVersion + '/auth/reset',

    // Profile
    profile_details: apiVersion + '/user/details',
    profile_update: apiVersion + '/user/update',
    profile_password: apiVersion + '/user/password',
    profile_logout: apiVersion + '/user/logout',
    profile_userLog: apiVersion + '/user/list',

    // Media
    media: apiVersion + '/media/upload',

}

export default apiRoutes;
