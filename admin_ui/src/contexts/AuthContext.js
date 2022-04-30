import {createContext, useState} from "react"
import {api} from "../connections/ApiConnection"

const AuthContext = createContext()

export const AuthProvider = ({children}) => {
    const [status, setStatus] = useState('checking')
    const [user, setUser] = useState(null)
    const [stayLoggedIn, setStayLoggedIn] = useState(false)

    const auth = () => {
        const token = sessionStorage.getItem('auth_token') ?? localStorage.getItem('auth_token')

        api.get('/user', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
            .then(({data}) => {
                setStatus('authenticated')
                setUser(data.data)
            })
            .catch((err) => {
                setStatus('unauthenticated')
            })
    }

    const logIn = (email, password, errorCallback) => {

        api.post('/login',
            {
                email: email,
                password: password
            },
            {
                headers: {
                    Accept: 'application/json',
                }
            }).then(({data}) => {
                if(stayLoggedIn){
                    localStorage.setItem('auth_token', data.access_token)
                } else {
                    sessionStorage.setItem('auth_token', data.access_token)
                }
            setUser(data.user)
            setStatus('authenticated')
        }).catch(error => errorCallback(error))
    }

    const logOut = () => {
        localStorage.clear()
        sessionStorage.clear()
        setStatus('unauthenticated')
    }

    return (
        <AuthContext.Provider value={{
            auth,
            logIn,
            logOut,
            setStayLoggedIn,
            status,
            user,
        }}>
            {children}
        </AuthContext.Provider>
    )
}

export default AuthContext