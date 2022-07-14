export default class Gate{

    constructor(user){
        this.user=user;
    }
    isSuperAdmin(){
        return this.user.role=="SuperAdmin";
    }
    isAdmin(){
        return this.user.role=="Admin";
    }
    isChef(){
        return this.user.role=="Chef";
    }
    isAgent(){
        return this.user.role=="Agent";
    }
    isInvite(){
        return this.user.role=="Invite";
    }
    authId(){
        return this.user.id;
    }

}
