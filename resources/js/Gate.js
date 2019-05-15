export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.roles === 'admin';
    }

    isUser() {
        return this.user.roles === 'user';
    }

}

