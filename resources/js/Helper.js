import store from "./src/store";

class Helper {
    getUser(){
        if (store.state.settings.user){
            return true
        }else if (store.state.settings.accessToken){
            // делаем запрос на аунтификацию user
        }else {
            return false
        }
    }
    getUserRole(){
        if (store.state.settings.user){
            return store.state.settings.user.role.id
        }
        return 1

    }
    isAccess(role){
        console.log(role)
        console.log(store.state.settings.user.role.id)
        if (store.state.settings.user && store.state.settings.user.role.id >= role){
            return true
        }
        return false
    }


}

export default Helper
