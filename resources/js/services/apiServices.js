import axios from "axios";

let headers = {};

const apiService = {
    POST: (url, param, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.post(url, param, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
            }
            if (error_code === 403) {
            }
        })
    },

    GET: (url, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.get(url, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 403) {
            }
            if (error_code === 401) {
            }
        })
    },

    UPLOAD: (url, media, callback) => {
        const MediaHeaders = {
            "Content-Type": "multipart/form-data",
        };
        axios.post(url, media, {headers: MediaHeaders}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
                console.log('Error')
            }
        })
    },

    ClearErrorHandler() {
        document.querySelector('.error-report').textContent = '';
    }

}



export default apiService;
