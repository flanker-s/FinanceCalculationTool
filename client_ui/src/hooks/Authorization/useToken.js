
function useToken() {
    const getToken = () => {
        return sessionStorage.getItem('auth_token') ?? localStorage.getItem('auth_token')
    }
    const setToken = (token, isLongTerm) => {
        if(isLongTerm){
            localStorage.setItem('auth_token', token)
        } else {
            sessionStorage.setItem('auth_token', token)
        }
    }
    return {
        getToken,
        setToken
    }
}

export default useToken