const authentication = (to, from, next) => {
    if (localStorage.getItem("userToken") && to.meta.requireAuth) {
        next();
    } else if (localStorage.getItem("userToken") && !to.meta.requireAuth) {
        next({ name: "dashboard" });
    } else if (!localStorage.getItem("userProfile") && to.meta.requireAuth) {
        next({ name: "login" });
    } else {
        next();
    }
};

export default authentication;