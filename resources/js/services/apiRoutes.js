const apiVersion = '/api/user';

const apiRoutes = {

    // Authentication
    register: apiVersion + '/auth/register',
    login: apiVersion + '/auth/login',
    forget: apiVersion + '/auth/forget',
    reset: apiVersion + '/auth/reset',

    // Profile
    user_details: apiVersion + '/user/details',
    user_update: apiVersion + '/user/update',
    user_password: apiVersion + '/user/password',
    user_logout: apiVersion + '/user/logout',

    // Media
    media: apiVersion + '/media/upload',

}

export default apiRoutes;
