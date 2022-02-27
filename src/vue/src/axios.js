import axios from "axios";

axios.defaults.baseURL = "nginx:9000/api";

axios.defaults.headers.common['Authorization'] = (localStorage.getItem("user") !== null) ? "Bearer "+(JSON.parse(localStorage.getItem("user"))).token : null;
axios.defaults.headers.post["Content-Type"] = "application/json";

axios.interceptors.response.use((response) => response, function (error) {
    if(error.response.status == 401 && error.response.data.message == "Not authenticated"){
        localStorage.clear();
        console.log('====================================');
        console.log(error);
        console.log('====================================');
        // window.location.href = "/admin/login"
    }
    return Promise.reject(error);
  });

export default axios;
