function Validation() {
    this.is_username = function (username) {
        let partten = /^[A-Za-z0-9_\.]{6,32}$/;
        if(partten.test(username)) return true;
        return false;
    }
    this.is_password = function (password) {
        let partten = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$%^&*_!]{6,}$/;
        if(partten.test(password)) return true;
        return false;
    }
}

export default Validation;