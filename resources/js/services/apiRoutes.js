const apiVersion = '/api/user';

const apiRoutes = {

    // Authentication
    register: apiVersion + '/auth/register',
    login: apiVersion + '/auth/login',
    forget: apiVersion + '/auth/forget',
    reset: apiVersion + '/auth/reset',

    // Profile
    user_details: apiVersion + '/profile/details',
    user_update: apiVersion + '/profile/update',
    user_password: apiVersion + '/profile/password',
    user_logout: apiVersion + '/profile/logout',

    // Media
    media: apiVersion + '/media/upload',

}

export default apiRoutes;
